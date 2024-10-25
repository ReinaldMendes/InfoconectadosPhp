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

            return $sql->rowCount() > 0;
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return false;
        }
    }

    public function adicionar($nome, $sobrenome, $data_nasc, $endereco, $qualServicoNecessita, $telefone, $email, $senha) {
        if ($this->existeEmail($email)) {
            return false;
        }

        try {
            $this->nome = $nome;
            $this->sobrenome = $sobrenome;
            $this->data_nasc = $data_nasc;
            $this->endereco = $endereco;
            $this->qualServicoNecessita = $qualServicoNecessita;
            $this->telefone = $telefone;
            $this->email = $email;
            $this->senha = password_hash($senha, PASSWORD_DEFAULT);

            $sql = $this->con->conectar()->prepare("INSERT INTO cliente (nome, sobrenome, data_nasc, endereco, qualServicoNecessita, telefone, email, senha) VALUES (:nome, :sobrenome, :data_nasc, :endereco, :qualServicoNecessita, :telefone, :email, :senha)");
            $sql->bindParam(":nome", $this->nome);
            $sql->bindParam(":sobrenome", $this->sobrenome);
            $sql->bindParam(":data_nasc", $this->data_nasc);
            $sql->bindParam(":endereco", $this->endereco);
            $sql->bindParam(":qualServicoNecessita", $this->qualServicoNecessita);
            $sql->bindParam(":telefone", $this->telefone);
            $sql->bindParam(":email", $this->email);
            $sql->bindParam(":senha", $this->senha);

            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return false;
        }
    }

    public function listar() {
        try {
            $sql = $this->con->conectar()->prepare("SELECT idCliente, nome, sobrenome, data_nasc, endereco, qualServicoNecessita, telefone, email FROM cliente");
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
            return false;
        }

        try {
            $senhaHash = !empty($senha) ? password_hash($senha, PASSWORD_DEFAULT) : $this->buscar($idCliente)['senha'];

            $sql = $this->con->conectar()->prepare("UPDATE cliente SET nome = :nome, sobrenome = :sobrenome, data_nasc = :data_nasc, endereco = :endereco, qualServicoNecessita = :qualServicoNecessita, telefone = :telefone, email = :email, senha = :senha WHERE idCliente = :idCliente");
            $sql->bindParam(':nome', $nome);
            $sql->bindParam(':sobrenome', $sobrenome);
            $sql->bindParam(':data_nasc', $data_nasc);
            $sql->bindParam(':endereco', $endereco);
            $sql->bindParam(':qualServicoNecessita', $qualServicoNecessita);
            $sql->bindParam(':telefone', $telefone);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':senha', $senhaHash);
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

    public function fazerLogin($email, $senha) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT idCliente, senha FROM cliente WHERE email = :email");
            $sql->bindValue(":email", $email);
            $sql->execute();

            $cliente = $sql->fetch(PDO::FETCH_ASSOC);
            if ($cliente && password_verify($senha, $cliente['senha'])) {
                $_SESSION["logado"] = $cliente['idCliente'];
                return true;
            }
            return false;
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return false;
        }
    }
}
?>
