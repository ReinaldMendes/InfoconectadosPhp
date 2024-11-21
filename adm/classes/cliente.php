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
    private $foto_perfil;
    private $con;

    public function __construct($conexao = null) {
        $this->con = $conexao ?? new Conexao();
    }

    private function logErro($mensagem) {
        error_log('ERRO: ' . $mensagem);
    }

    private function existeEmail($email) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT idCliente FROM cliente WHERE email = :email");
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->execute();
            return $sql->rowCount() > 0;
        } catch (PDOException $ex) {
            $this->logErro($ex->getMessage());
            return false;
        }
    }

    public function adicionar($nome, $sobrenome, $data_nasc, $endereco, $qualServicoNecessita, $telefone, $email, $senha) {
        if ($this->existeEmail($email)) {
            return false; // Email já existe, não pode adicionar
        }

        try {
            $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
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
            $sql->bindParam(':senha', $senhaHash, PDO::PARAM_STR);

            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return false;
        }
    }

    public function listar() {
        try {
            $sql = $this->con->conectar()->prepare("SELECT idCliente, nome, sobrenome, data_nasc, endereco, qualServicoNecessita, telefone, email, foto_perfil FROM cliente");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            $this->logErro($ex->getMessage());
            return [];
        }
    }


    public function avaliarPrestador($avaliacao) {
        try {
            $sql = $this->con->conectar()->prepare("INSERT INTO avaliacao (idCliente, idPrestador, nota, comentario) VALUES (:idCliente, :idPrestador, :nota, :comentario)");
            foreach ($avaliacao as $key => $value) {
                $sql->bindValue(":$key", $value);
            }
            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            $this->logErro($ex->getMessage());
            return false;
        }
    }

    public function buscar($idCliente) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM cliente WHERE idCliente = :idCliente");
            $sql->bindValue(':idCliente', $idCliente, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            $this->logErro($ex->getMessage());
            return [];
        }
    }

    public function editar($dados, $idCliente) {
        if ($this->existeEmail($dados['email']) && $this->buscar($idCliente)['email'] !== $dados['email']) {
            return false;
        }

        try {
            if (!empty($dados['senha'])) {
                $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
            } else {
                unset($dados['senha']);
            }

            $sets = [];
            foreach ($dados as $key => $value) {
                $sets[] = "$key = :$key";
            }
            $setString = implode(", ", $sets);

            $sql = $this->con->conectar()->prepare("UPDATE cliente SET $setString WHERE idCliente = :idCliente");
            $dados['idCliente'] = $idCliente;
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

    public function excluir($idCliente) {
        try {
            $sql = $this->con->conectar()->prepare("DELETE FROM cliente WHERE idCliente = :idCliente");
            $sql->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
            $sql->execute();
        } catch (PDOException $ex) {
            $this->logErro($ex->getMessage());
        }
    }
    public function fazerLogin($email, $senha) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT idCliente, senha FROM cliente WHERE email = :email");
            $sql->bindValue(":email", filter_var($email, FILTER_SANITIZE_EMAIL));
            $sql->execute();
    
            $cliente = $sql->fetch(PDO::FETCH_ASSOC);
            if ($cliente && password_verify($senha, $cliente['senha'])) {
                $_SESSION["logado"] = $cliente['idCliente'];
                return true;
            }
            return false;
        } catch (PDOException $ex) {
            error_log('ERRO: ' . $ex->getMessage());
            return false;
        }
    }
    
    public function listarPrestadores() {
        try {
            // Consulta para listar todos os prestadores
            $sql = $this->con->conectar()->prepare("SELECT * FROM prestadores");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            // Exibe mensagem de erro caso ocorra
            echo json_encode(['error' => 'ERRO: ' . $ex->getMessage()]);
            return [];
        }
    }
    public function obterDadosCliente($idCliente) {
        try {
            // Prepara a consulta SQL para buscar os dados do cliente
            $sql = $this->con->conectar()->prepare("SELECT nome, sobrenome, email, telefone, endereco, foto_perfil 
                                                    FROM cliente 
                                                    WHERE idCliente = :idCliente LIMIT 1");
    
            // Vincula o ID do cliente ao parâmetro
            $sql->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
    
            // Executa a consulta
            $sql->execute();
    
            // Verifica se algum resultado foi retornado
            if ($sql->rowCount() > 0) {
                // Retorna os dados do cliente como um array associativo
                return $sql->fetch(PDO::FETCH_ASSOC);
            } else {
                // Retorna false se nenhum dado foi encontrado
                return false;
            }
        } catch (PDOException $ex) {
            // Loga o erro, se houver
            $this->logErro($ex->getMessage());
            return false;
        }
    }
    
    public function atualizarPerfil($idCliente, $dados) {
        // Verifica se o novo email já está em uso por outro cliente, mas ignorando o email do próprio cliente
        $clienteAtual = $this->buscar($idCliente);
        if (!$clienteAtual) {
            return false; // Caso o cliente não seja encontrado
        }
    
        if ($this->existeEmail($dados['email']) && $clienteAtual['email'] !== $dados['email']) {
            return false; // Retorna falso se o email já existir e não for o mesmo do cliente
        }
    
        try {
            // Se a senha foi fornecida, realiza a atualização com a senha criptografada
            if (!empty($dados['senha'])) {
                $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
            } else {
                unset($dados['senha']); // Se não foi fornecida senha, remove o campo da atualização
            }
    
            // Criação da string de campos a serem atualizados
            $sets = [];
            foreach ($dados as $key => $value) {
                $sets[] = "$key = :$key";
            }
            $setString = implode(", ", $sets);
    
            // Prepara a consulta SQL para atualizar os dados do cliente
            $sql = $this->con->conectar()->prepare("UPDATE cliente SET $setString WHERE idCliente = :idCliente");
    
            // Vincula todos os parâmetros de dados, incluindo o idCliente
            $dados['idCliente'] = $idCliente;
            foreach ($dados as $key => $value) {
                $sql->bindValue(":$key", $value);
            }
    
            // Executa a atualização
            $sql->execute();
    
            return true; // Retorna verdadeiro se a atualização for bem-sucedida
        } catch (PDOException $ex) {
            $this->logErro($ex->getMessage()); // Log do erro
            return false; // Retorna falso se houver erro na execução da consulta
        }
    }
    public function buscarDetalhesPrestador($idPrestador) {
        try {
            // Prepara a consulta para obter os detalhes do prestador
            $sql = $this->con->conectar()->prepare("
                SELECT nome, sobrenome, especialidade, foto_perfil, telefone 
                FROM prestadores 
                WHERE idPrestador = :idPrestador
            ");
            // Vincula o parâmetro idPrestador
            $sql->bindParam(':idPrestador', $idPrestador, PDO::PARAM_INT);
    
            // Executa a consulta
            $sql->execute();
    
            // Retorna os detalhes do prestador
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            // Loga o erro e retorna false em caso de falha
            $this->logErro($ex->getMessage());
            return false;
        }
    }
    
    
    
    
}
?>
