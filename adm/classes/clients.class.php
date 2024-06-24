<?php
require 'conexao.class.php';

class Cliente {
    private $idCliente;
    private $nome;
    private $sobrenome;
    private $data_nasc;
    private $endereco;
    private $qualServicoNecessita;
    private $telefone;
    private $email;
    private $senha;
    private $con;

    public function __construct() {
        $this->con = new Conexao();
    }

    private function existeEmail($email) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT idCliente FROM cliente WHERE email = :email");
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return false;
        }
    }

    public function adicionar($nome, $sobrenome, $data_nasc, $endereco, $qualServicoNecessita, $telefone, $email, $senha) {
        if ($this->existeEmail($email)) {
            return false; // Email já existe, não pode adicionar
        }

        try {
            $this->nome = $nome;
            $this->sobrenome = $sobrenome;
            $this->data_nasc = $data_nasc;
            $this->endereco = $endereco;
            $this->qualServicoNecessita = $qualServicoNecessita;
            $this->telefone = $telefone;
            $this->email = $email;
            $this->senha = $senha;

            $sql = $this->con->conectar()->prepare("INSERT INTO cliente (nome, sobrenome, data_nasc, endereco, qualServicoNecessita, telefone, email, senha)
                VALUES (:nome, :sobrenome, :data_nasc, :endereco, :qualServicoNecessita, :telefone, :email, :senha)");
            $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $sql->bindParam(":sobrenome", $this->sobrenome, PDO::PARAM_STR);
            $sql->bindParam(":data_nasc", $this->data_nasc, PDO::PARAM_STR);
            $sql->bindParam(":endereco", $this->endereco, PDO::PARAM_STR);
            $sql->bindParam(":qualServicoNecessita", $this->qualServicoNecessita, PDO::PARAM_STR);
            $sql->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
            $sql->bindParam(":email", $this->email, PDO::PARAM_STR);
            $sql->bindParam(":senha", $this->senha, PDO::PARAM_STR);

            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return false;
        }
    }

    public function listar() {
        try {
            $sql = $this->con->conectar()->prepare("SELECT idCliente, nome, sobrenome, data_nasc, endereco, qualServicoNecessita, telefone, email, senha FROM cliente");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return array();
        }
    }

    public function buscar($idCliente) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM cliente WHERE idCliente = :idCliente");
            $sql->bindValue(':idCliente', $idCliente, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return array();
        }
    }

    public function editar($nome, $sobrenome, $data_nasc, $endereco, $qualServicoNecessita, $telefone, $email, $senha, $idCliente) {
        if ($this->existeEmail($email) && $this->buscar($idCliente)['email'] !== $email) {
            return false; // Email já existe e não pertence ao cliente atual
        }

        try {
            // Criptografa a senha em MD5 se houver alteração
            if (!empty($senha)) {
                $senha = md5($senha);
            } else {
                // Mantém a senha existente se não houver alteração
                $currentInfo = $this->buscar($idCliente);
                $senha = $currentInfo['senha'];
            }
            $sql = $this->con->conectar()->prepare("UPDATE cliente SET nome = :nome, sobrenome = :sobrenome, data_nasc = :data_nasc, endereco = :endereco, qualServicoNecessita = :qualServicoNecessita, telefone = :telefone, email = :email, senha = :senha
                WHERE idCliente = :idCliente");
            $sql->bindParam(':nome', $nome, PDO::PARAM_STR);
            $sql->bindParam(':sobrenome', $sobrenome, PDO::PARAM_STR);
            $sql->bindParam(':data_nasc', $data_nasc, PDO::PARAM_STR);
            $sql->bindParam(':endereco', $endereco, PDO::PARAM_STR);
            $sql->bindParam(':qualServicoNecessita', $qualServicoNecessita, PDO::PARAM_STR);
            $sql->bindParam(':telefone', $telefone, PDO::PARAM_STR);
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->bindParam(':senha', $senha, PDO::PARAM_STR);
            $sql->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);

            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return false;
        }
    }

    public function excluir($idCliente) {
        try {
            $sql = $this->con->conectar()->prepare("DELETE FROM cliente WHERE idCliente = :idCliente");
            $sql->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
            $sql->execute();
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
        }
    }
}
?>
