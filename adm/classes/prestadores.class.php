<?php
require_once 'conexao.class.php'; // Classe para conexão com o banco de dados

class Prestador {
    private $conn; // Conexão com o banco de dados

    public function __construct(){  // underline duplo considerado um comando mágico, ou seja, tem uma carta na manga pra facilitar a programação
        $this->con = new Conexao();
    }

    // Função para adicionar um novo prestador
    public function adicionar($nome, $sobrenome, $data_nasc, $endereco, $cpf, $telefone, $email, $senha) {
        try {
            $sql = "INSERT INTO prestadores (nome, sobrenome, data_nasc, endereco, cpf, telefone, email, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$nome, $sobrenome, $data_nasc, $endereco, $cpf, $telefone, $email, $senha]);
            return true; // Retorna verdadeiro se inserido com sucesso
        } catch (PDOException $e) {
            echo "Erro ao adicionar prestador: " . $e->getMessage();
            return false; // Retorna falso em caso de erro
        }
    }

    // Função para buscar informações de um prestador pelo ID
    public function buscar($idPrestador) {
        try {
            $sql = "SELECT * FROM prestadores WHERE idPrestador = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$idPrestador]);
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna os dados do prestador como um array associativo
        } catch (PDOException $e) {
            echo "Erro ao buscar prestador: " . $e->getMessage();
            return false;
        }
    }

    // Função para editar informações de um prestador
    public function editar($nome, $sobrenome, $data_nasc, $endereco, $cpf, $telefone, $email, $senha, $idPrestador) {
        try {
            $sql = "UPDATE prestadores SET nome = ?, sobrenome = ?, data_nasc = ?, endereco = ?, cpf = ?, telefone = ?, email = ?, senha = ? WHERE idPrestador = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$nome, $sobrenome, $data_nasc, $endereco, $cpf, $telefone, $email, $senha, $idPrestador]);
            return true; // Retorna verdadeiro se atualizado com sucesso
        } catch (PDOException $e) {
            echo "Erro ao editar prestador: " . $e->getMessage();
            return false;
        }
    }

    // Função para listar todos os prestadores
    public function listar() {
        try {
            $sql = "SELECT * FROM prestadores";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os prestadores como um array de arrays associativos
        } catch (PDOException $e) {
            echo "Erro ao listar prestadores: " . $e->getMessage();
            return [];
        }
    }

    // Função para excluir um prestador pelo ID
    public function excluir($idPrestador) {
        try {
            $sql = "DELETE FROM prestadores WHERE idPrestador = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$idPrestador]);
            return true; // Retorna verdadeiro se excluído com sucesso
        } catch (PDOException $e) {
            echo "Erro ao excluir prestador: " . $e->getMessage();
            return false;
        }
    }
}
?>
