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
    private $senha;
    private $con;

    public function __construct() {
        $this->con = new Conexao();
    }

    private function existeEmail($email, $idPrestador = null) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT idPrestador FROM prestadores WHERE email = :email AND (:idPrestador IS NULL OR idPrestador != :idPrestador)");
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->bindParam(':idPrestador', $idPrestador, PDO::PARAM_INT);
            $sql->execute();
            return $sql->rowCount() > 0;
        } catch (PDOException $ex) {
            echo json_encode(['error' => 'ERRO: ' . $ex->getMessage()]);
            return false;
        }
    }

    public function obterDadosPrestador($idPrestador) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM prestadores WHERE idPrestador = :idPrestador");
            $sql->bindParam(':idPrestador', $idPrestador, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo json_encode(['error' => 'ERRO: ' . $ex->getMessage()]);
            return null;
        }
    }

    public function editarPerfil($idPrestador, $nome, $sobrenome, $data_nasc, $endereco, $cpf, $telefone, $email, $senha) {
        // Verificar se o e-mail já existe
        if ($this->existeEmail($email, $idPrestador)) {
            echo json_encode(['error' => 'Email já existe para outro prestador']);
            return false;
        }

        try {
            // Se a senha estiver vazia, mantemos a senha atual
            if (!empty($senha)) {
                $senha = password_hash($senha, PASSWORD_BCRYPT);
            } else {
                $dados = $this->obterDadosPrestador($idPrestador);
                $senha = $dados['senha']; // Mantém a senha atual
            }

            // Atualiza os dados do prestador
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
            echo json_encode(['success' => true, 'message' => 'Dados atualizados com sucesso']);
            return true;
        } catch (PDOException $ex) {
            echo json_encode(['error' => 'ERRO: ' . $ex->getMessage()]);
            return false;
        }
    }

    public function listarClientesDisponiveis($idPrestador) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM cliente WHERE prestador_id IS NULL");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo json_encode(['error' => 'ERRO: ' . $ex->getMessage()]);
            return [];
        }
    }

    public function listarClientesRecentes($idPrestador) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM cliente 
                WHERE DATE(data_nasc) >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                AND idCliente NOT IN (SELECT idCliente FROM prestadores_clientes WHERE idPrestador = :idPrestador)");

            $sql->bindParam(':idPrestador', $idPrestador, PDO::PARAM_INT);
            $sql->execute();

            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo json_encode(['error' => 'ERRO: ' . $ex->getMessage()]);
            return [];
        }
    }

    public function buscarClientesPorServico($idPrestador, $servicoNecessitado) {
        try {
            $sql = "SELECT * FROM cliente WHERE prestador_id = :idPrestador AND qualServicoNecessita LIKE :servico";
            $stmt = $this->con->conectar()->prepare($sql);
            $stmt->bindValue(":idPrestador", $idPrestador, PDO::PARAM_INT);
            $stmt->bindValue(":servico", '%' . $servicoNecessitado . '%', PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo json_encode(['error' => 'ERRO: ' . $ex->getMessage()]);
            return [];
        }
    }

    public function loginJSON($email, $senha) {
        $sql = $this->con->conectar()->prepare("SELECT * FROM prestadores WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($senha, $user['senha'])) {
                $_SESSION["logado"] = $user['idPrestador'];
                echo json_encode(['success' => true, 'message' => 'Login bem-sucedido']);
                return;
            }
        }

        echo json_encode(['success' => false, 'message' => 'Credenciais inválidas']);
    }
    public function atualizarPerfil($idPrestador, $nome, $sobrenome, $email, $telefone, $endereco, $nova_senha = null) {
        // Se a senha foi fornecida, faça o hash da nova senha
        if ($nova_senha) {
            $nova_senha = password_hash($nova_senha, PASSWORD_BCRYPT);
        }
    
        try {
            // SQL para atualizar o perfil
            $sql = $this->con->conectar()->prepare("UPDATE prestadores SET 
                nome = :nome, 
                sobrenome = :sobrenome, 
                email = :email, 
                telefone = :telefone, 
                endereco = :endereco" . ($nova_senha ? ", senha = :senha" : "") . " 
                WHERE idPrestador = :idPrestador");
    
            // Bind dos parâmetros
            $sql->bindParam(':nome', $nome, PDO::PARAM_STR);
            $sql->bindParam(':sobrenome', $sobrenome, PDO::PARAM_STR);
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->bindParam(':telefone', $telefone, PDO::PARAM_STR);
            $sql->bindParam(':endereco', $endereco, PDO::PARAM_STR);
    
            // Se houver uma nova senha, faça o bind do parâmetro
            if ($nova_senha) {
                $sql->bindParam(':senha', $nova_senha, PDO::PARAM_STR);
            }
    
            // Bind do ID do prestador
            $sql->bindParam(':idPrestador', $idPrestador, PDO::PARAM_INT);
    
            // Execute a query
            $sql->execute();
    
            // Se tudo ocorreu bem, retorne sucesso
            echo json_encode(['success' => true, 'message' => 'Perfil atualizado com sucesso']);
            return true;
        } catch (PDOException $ex) {
            // Se houver erro, capture e mostre o erro
            echo json_encode(['error' => 'ERRO: ' . $ex->getMessage()]);
            return false;
        }
    }
    
    
}
?>
