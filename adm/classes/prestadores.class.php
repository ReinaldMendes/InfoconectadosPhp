<?php
require 'conexao.class.php';

class Prestador {
    private $idPrestador;
    private $nome;
    private $sobrenome;
    private $data_nasc;
    private $endereco;
    private $cpf;
    private $telefone;
    private $email;
    private $senha; // Novo atributo para a senha
    private $con;

    public function __construct() {
        $this->con = new Conexao();
    }

    private function existeEmail($email) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT idPrestador FROM prestadores WHERE email = :email");
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->execute();

            return $sql->rowCount() > 0;
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return false;
        }
    }

    public function adicionar($nome, $sobrenome, $data_nasc, $endereco, $cpf, $telefone, $email, $senha) {
        if ($this->existeEmail($email)) {
            return false; // Email já existe, não pode adicionar
        }

        try {
            // Criptografa a senha em MD5
            $senha = md5($senha);

            $sql = $this->con->conectar()->prepare("INSERT INTO prestadores (nome, sobrenome, data_nasc, endereco, cpf, telefone, email, senha)
                VALUES (:nome, :sobrenome, :data_nasc, :endereco, :cpf, :telefone, :email, :senha)");
            $sql->bindParam(":nome", $nome, PDO::PARAM_STR);
            $sql->bindParam(":sobrenome", $sobrenome, PDO::PARAM_STR);
            $sql->bindParam(":data_nasc", $data_nasc, PDO::PARAM_STR);
            $sql->bindParam(":endereco", $endereco, PDO::PARAM_STR);
            $sql->bindParam(":cpf", $cpf, PDO::PARAM_STR);
            $sql->bindParam(":telefone", $telefone, PDO::PARAM_STR);
            $sql->bindParam(":email", $email, PDO::PARAM_STR);
            $sql->bindParam(":senha", $senha, PDO::PARAM_STR);

            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return false;
        }
    }

    public function listar() {
        try {
            $sql = $this->con->conectar()->prepare("SELECT idPrestador, nome, sobrenome, data_nasc, endereco, cpf, telefone, email,senha FROM prestadores");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return array();
        }
    }

    public function buscar($idPrestador) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM prestadores WHERE idPrestador = :idPrestador");
            $sql->bindValue(':idPrestador', $idPrestador, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return array();
        }
    }

    public function editar($nome, $sobrenome, $data_nasc, $endereco, $cpf, $telefone, $email, $senha, $idPrestador) {
        // Verifica se o e-mail já existe para outro prestador
        if ($this->existeEmail($email) && $this->buscar($idPrestador)['email'] !== $email) {
            return false; // Email já existe e não pertence ao prestador atual
        }
    
        try {
            // Criptografa a senha em MD5 se houver alteração
            if (!empty($senha)) {
                $senha = md5($senha);
            } else {
                // Mantém a senha existente se não houver alteração
                $currentInfo = $this->buscar($idPrestador);
                $senha = $currentInfo['senha'];
            }
    
            $sql = $this->con->conectar()->prepare("UPDATE prestadores SET 
                nome = :nome, 
                sobrenome = :sobrenome, 
                data_nasc = :data_nasc, 
                endereco = :endereco, 
                cpf = :cpf, 
                telefone = :telefone, 
                email = :email, 
                senha = :senha
                WHERE idPrestador = :idPrestador");
    
            $sql->bindParam(':nome', $nome, PDO::PARAM_STR);
            $sql->bindParam(':sobrenome', $sobrenome, PDO::PARAM_STR);
            $sql->bindParam(':data_nasc', $data_nasc, PDO::PARAM_STR);
            $sql->bindParam(':endereco', $endereco, PDO::PARAM_STR);
            $sql->bindParam(':cpf', $cpf, PDO::PARAM_STR);
            $sql->bindParam(':telefone', $telefone, PDO::PARAM_STR);
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->bindParam(':senha', $senha, PDO::PARAM_STR);
            $sql->bindParam(':idPrestador', $idPrestador, PDO::PARAM_INT);
    
            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return false;
        }
    }
    

    public function excluir($idPrestador) {
        try {
            $sql = $this->con->conectar()->prepare("DELETE FROM prestadores WHERE idPrestador = :idPrestador");
            $sql->bindParam(':idPrestador', $idPrestador, PDO::PARAM_INT);
            $sql->execute();
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
        }
    }
}
?>
