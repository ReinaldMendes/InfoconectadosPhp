<?php
require 'conexao.class.php';

class Sistema {
    private $idSistema;
    private $nome;
    private $versao;
    private $descricao;
    private $con;

    public function __construct() {
        $this->con = new Conexao();
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function adicionar($nome, $versao, $descricao) {
        try {
            $this->nome = $nome;
            $this->versao = $versao;
            $this->descricao = $descricao;

            $sql = $this->con->conectar()->prepare("INSERT INTO sistema(nome, versao, descricao) VALUES(:nome, :versao, :descricao)");
            $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $sql->bindParam(":versao", $this->versao, PDO::PARAM_STR);
            $sql->bindParam(":descricao", $this->descricao, PDO::PARAM_STR);

            $sql->execute();
            return TRUE;
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }

    public function listar() {
        try {
            $sql = $this->con->conectar()->prepare("SELECT idSistema, nome, versao, descricao FROM sistema");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }

    public function buscar($id) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM sistema WHERE idSistema = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return $sql->fetch();
            } else {
                return array();
            }
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function editar($nome, $versao, $descricao, $id) {
        try {
            $sql = $this->con->conectar()->prepare("UPDATE sistema SET nome = :nome, versao = :versao, descricao = :descricao WHERE idSistema = :id");
            $sql->bindParam(':nome', $nome, PDO::PARAM_STR);
            $sql->bindParam(':versao', $versao, PDO::PARAM_STR);
            $sql->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();
            return TRUE;
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $sql = $this->con->conectar()->prepare("DELETE FROM sistema WHERE idSistema = :id");
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();
            return TRUE;
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }
}
?>
