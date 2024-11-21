<?php
require 'conexao.class.php';

class Avaliacao {
    private $idAvaliacao;
    private $idCliente;
    private $idPrestador;
    private $nota;
    private $comentario;
    private $data_avaliacao;
    private $con;

    public function __construct($conexao = null) {
        $this->con = $conexao ?? new Conexao();
    }

    private function logErro($mensagem) {
        error_log('ERRO: ' . $mensagem);
    }

    public function salvarAvaliacao($idCliente, $idPrestador, $nota, $comentario) {
        try {
            $this->idCliente = $idCliente;
            $this->idPrestador = $idPrestador;
            $this->nota = $nota;
            $this->comentario = $comentario;

            $sql = $this->con->conectar()->prepare("
                INSERT INTO avaliacao (idCliente, idPrestador, nota, comentario, data_avaliacao)
                VALUES (:idCliente, :idPrestador, :nota, :comentario, NOW())
            ");
            $sql->bindParam(':idCliente', $this->idCliente, PDO::PARAM_INT);
            $sql->bindParam(':idPrestador', $this->idPrestador, PDO::PARAM_INT);
            $sql->bindParam(':nota', $this->nota, PDO::PARAM_INT);
            $sql->bindParam(':comentario', $this->comentario, PDO::PARAM_STR);

            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            $this->logErro($ex->getMessage());
            return false;
        }
    }

    public function listarPorPrestador($idPrestador) {
        try {
            $sql = $this->con->conectar()->prepare("
                SELECT a.nota, a.comentario, a.data_avaliacao, c.nome AS nomeCliente, c.foto_perfil 
                FROM avaliacao a
                JOIN cliente c ON a.idCliente = c.idCliente
                WHERE a.idPrestador = :idPrestador
            ");
            $sql->bindParam(':idPrestador', $idPrestador, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            $this->logErro($ex->getMessage());
            return [];
        }
    }

    public function buscar($idAvaliacao) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM avaliacao WHERE idAvaliacao = :idAvaliacao");
            $sql->bindParam(':idAvaliacao', $idAvaliacao, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            $this->logErro($ex->getMessage());
            return [];
        }
    }

    public function editar($idAvaliacao, $dados) {
        try {
            $sets = [];
            foreach ($dados as $key => $value) {
                $sets[] = "$key = :$key";
            }
            $setString = implode(", ", $sets);

            $sql = $this->con->conectar()->prepare("
                UPDATE avaliacao 
                SET $setString 
                WHERE idAvaliacao = :idAvaliacao
            ");
            $dados['idAvaliacao'] = $idAvaliacao;
            foreach ($dados as $key => $value) {
                $sql->bindValue(":$key", $value);
            }
            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            $this->logErro($ex->getMessage());
            return false;
        }
    }

    public function excluir($idAvaliacao) {
        try {
            $sql = $this->con->conectar()->prepare("DELETE FROM avaliacao WHERE idAvaliacao = :idAvaliacao");
            $sql->bindParam(':idAvaliacao', $idAvaliacao, PDO::PARAM_INT);
            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            $this->logErro($ex->getMessage());
            return false;
        }
    }

    public function calcularMediaPrestador($idPrestador) {
        try {
            $sql = $this->con->conectar()->prepare("
                SELECT AVG(nota) AS media 
                FROM avaliacao 
                WHERE idPrestador = :idPrestador
            ");
            $sql->bindParam(':idPrestador', $idPrestador, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC)['media'];
        } catch (PDOException $ex) {
            $this->logErro($ex->getMessage());
            return false;
        }
    }
}
?>

