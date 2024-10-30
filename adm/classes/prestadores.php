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

    private function existeEmail($email) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT idPrestador FROM prestadores WHERE email = :email");
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->execute();
            return $sql->rowCount() > 0;
        } catch (PDOException $ex) {
            echo json_encode(['error' => 'ERRO: ' . $ex->getMessage()]);
            return false;
        }
    }

    public function adicionar($nome, $sobrenome, $data_nasc, $endereco, $cpf, $telefone, $email, $senha) {
        if ($this->existeEmail($email)) {
            echo json_encode(['error' => 'Email já existe']);
            return false;
        }

        try {
            // Criptografa a senha com BCRYPT
            $senha = password_hash($senha, PASSWORD_BCRYPT);

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
            echo json_encode(['success' => true, 'message' => 'Prestador adicionado com sucesso']);
            return true;
        } catch (PDOException $ex) {
            echo json_encode(['error' => 'ERRO: ' . $ex->getMessage()]);
            return false;
        }
    }

    public function listarJSON() {
        try {
            $sql = $this->con->conectar()->prepare("SELECT idPrestador, nome, sobrenome, telefone, email FROM prestadores");
            $sql->execute();
            echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $ex) {
            echo json_encode(['error' => 'ERRO: ' . $ex->getMessage()]);
        }
    }

    public function buscar($idPrestador) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM prestadores WHERE idPrestador = :idPrestador");
            $sql->bindValue(':idPrestador', $idPrestador, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo json_encode(['error' => 'ERRO: ' . $ex->getMessage()]);
            return array();
        }
    }

    public function editar($nome, $sobrenome, $data_nasc, $endereco, $cpf, $telefone, $email, $senha, $idPrestador) {
        if ($this->existeEmail($email) && $this->buscar($idPrestador)['email'] !== $email) {
            echo json_encode(['error' => 'Email já existe para outro prestador']);
            return false;
        }
    
        try {
            if (!empty($senha)) {
                $senha = password_hash($senha, PASSWORD_BCRYPT);
            } else {
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
            echo json_encode(['success' => true, 'message' => 'Dados atualizados com sucesso']);
            return true;
        } catch (PDOException $ex) {
            echo json_encode(['error' => 'ERRO: ' . $ex->getMessage()]);
            return false;
        }
    }

    public function excluir($idPrestador) {
        try {
            $sql = $this->con->conectar()->prepare("DELETE FROM prestadores WHERE idPrestador = :idPrestador");
            $sql->bindParam(':idPrestador', $idPrestador, PDO::PARAM_INT);
            $sql->execute();
            echo json_encode(['success' => true, 'message' => 'Prestador excluído com sucesso']);
        } catch (PDOException $ex) {
            echo json_encode(['error' => 'ERRO: ' . $ex->getMessage()]);
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
            // Consulta SQL para selecionar os clientes cadastrados nos últimos 30 dias
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
        // Prepara a consulta para verificar se o e-mail existe
        $sql = $this->con->conectar()->prepare("SELECT * FROM prestadores WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();
    
        // Busca o usuário
        $user = $sql->fetch(PDO::FETCH_ASSOC);
    
        // Para depuração - log no arquivo de erro
        error_log("Resultado da consulta: " . print_r($user, true)); // Verifica se o usuário foi encontrado
    
        // Verifica se o usuário existe
        if ($user) {
            // Primeiro, tenta verificar a senha usando o método md5
            if (md5($senha) === $user['senha']) {
                // Atualiza a senha para a nova abordagem com password_hash
                $novaSenhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
                $updateSql = $this->con->conectar()->prepare("UPDATE prestadores SET senha = :senha WHERE idPrestador = :idPrestador");
                $updateSql->bindValue(":senha", $novaSenhaCriptografada);
                $updateSql->bindValue(":idPrestador", $user['idPrestador']);
                $updateSql->execute();
    
                // Armazena o ID do prestador na sessão
                $_SESSION["logado"] = $user['idPrestador'];
                // Retorna resposta em JSON
                echo json_encode(['success' => true, 'message' => 'Login bem-sucedido, senha atualizada.']);
                return;
            }
    
            // Agora, tenta verificar a senha usando a nova abordagem
            if (password_verify($senha, $user['senha'])) {
                // Armazena o ID do prestador na sessão
                $_SESSION["logado"] = $user['idPrestador'];
                // Retorna resposta em JSON
                echo json_encode(['success' => true, 'message' => 'Login bem-sucedido']);
                return;
            }
        }
    
        // Retorna resposta de erro em JSON se não for bem-sucedido
        echo json_encode(['success' => false, 'message' => 'Credenciais inválidas']);
    }
    
    
}
?>
