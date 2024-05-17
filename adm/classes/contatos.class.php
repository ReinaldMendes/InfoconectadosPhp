<?php
require 'conexao.class.php';  //para poder usar a classe conexao pelo banco de dados
class Contatos {
//idUsuario	nome	email	senha	detalhesDoPerfil	cpf	Data_Nasc	telefone	
    private $idUsuario;
    private $nome ;
    private $email; 
	private $senha; 
	private	$detalhesDoPerfil; 
	private	$cpf; 
	private $Data_Nasc;
	private	$telefone;


    private $con;

    public function __construct(){  // underline duplo considerado um comando mágico, ou seja, tem uma carta na manga pra facilitar a programação
        $this->con = new Conexao();
    }
    public function __set($atributo,$valor){
        $this->atributo = $valor;
    }
    public function __get($atributo){
        return $this->atributo;
    }
    
    //vamos fazer uma validação pelo email, que é um atributo único, assim evitamos que haja duplicidade no cadastro de usuário
    private function existeEmail($email){
        $sql = $this->con->conectar()->prepare("SELECT idUsuario FROM usuario WHERE email = :email");
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();  //comando fetch retorna o valor que está no banco de dados, email no caso

        }else{
            $array = array();
        }
        return $array;
    }  //idUsuario	nome	email	senha	detalhesDoPerfil	cpf	Data_Nasc	telefone
    public function adicionar($email, $nome, $senha, $detalhesDoPerfil, $cpf, $Data_Nasc, $telefone){
        $emailExistente = $this->existeEmail($email);
        if(count($emailExistente) == 0){
            try{
                $this->nome = $nome;
                $this->email = $email;
                $this->senha = $senha;
                $this->detalhesDoPerfil = $detalhesDoPerfil;
                $this->cpf = $cpf;
                $this->Data_Nasc = $Data_Nasc;
                $this->telefone = $telefone;
                
                $sql = $this->con->conectar()->prepare("INSERT INTO usuario(nome, email, senha, detalhesDoPerfil, cpf, Data_Nasc, telefone)
                    VALUES(:nome, :email, :senha, :detalhesDoPerfil, :cpf, :Data_Nasc, :telefone)");
                    $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
                    $sql->bindParam(":email", $this->email, PDO::PARAM_STR);
                    $sql->bindParam(":senha", $this->senha, PDO::PARAM_STR);
                    $sql->bindParam(":detalhesDoPerfil", $this->detalhesDoPerfil, PDO::PARAM_STR);
                    $sql->bindParam(":cpf", $this->cpf, PDO::PARAM_STR);
                    $sql->bindParam(":Data_Nasc", $this->Data_Nasc, PDO::PARAM_STR);
                    $sql->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
                   

                    $sql->execute();
                return TRUE;

            }catch(PDOException $ex){
                return 'ERRO: '.$ex->getMessage();
            }

            
        }else{
            return FALSE;
        }

    }  
    public function listar(){
        try{ //idUsuario	nome	email	senha	detalhesDoPerfil	cpf	Data_Nasc	telefone
            $sql = $this->con->conectar()->prepare("SELECT idUsuario, nome, email, senha, detalhesDoPerfil, cpf, Data_Nasc, telefone FROM usuario");
            $sql->execute(); 
            return $sql->fetchAll();           

        }catch(PDOException $ex){
            return 'ERRO: '.$ex->getMessage();
        }
    }
    public function buscar ($idUsuario){
        try{
            $sql = $this->con->conectar()->prepare("SELECT * FROM usuario WHERE idUsuario = :idUsuario");
            $sql->bindValue(':idUsuario',$idUsuario);
            $sql->execute(); 
            if($sql->rowCount()>=0){
                return $sql->fetch(); 
            }else{
                return array();
            }            

        }catch(PDOException $ex){
            echo"ERRO";
        }
    }//idUsuario	nome	email	senha	detalhesDoPerfil	cpf	Data_Nasc	telefone
    public function editar( $nome,$email, $senha, $detalhesDoPerfil, $cpf, $Data_Nasc, $telefone,$idUsuario){
        $emailExistente = $this->existeEmail($email);
        if(count ($emailExistente )> 0 && $emailExistente['idUsuario']!=$idUsuario){
            return FALSE;
        }else{
            try{//idUsuario	nome	email	senha	detalhesDoPerfil	cpf	Data_Nasc	telefone
                $sql = $this->con->conectar()->prepare("UPDATE usuario SET nome = :nome, email= :email, senha = :senha, 
                detalhesDoPerfil = :detalhesDoPerfil, cpf = :cpf, Data_Nasc= :Data_Nasc, telefone = :telefone WHERE idUsuario = :idUsuario ");
                $sql->bindValue(':nome', $nome); 
                $sql->bindValue(':email', $email); 
                $sql->bindValue(':senha', $senha); 
                $sql->bindValue(':detalhesDoPerfil', $detalhesDoPerfil); 
                $sql->bindValue(':cpf', $cpf); 
                $sql->bindValue(':Data_Nasc', $Data_Nasc); 
                $sql->bindValue(':telefone', $telefone); 
                $sql->bindValue(':idUsuario', $idUsuario); 
                $sql->execute();
                return TRUE;           
    
            }catch(PDOException $ex){
                echo'ERRO: '.$ex->getMessage();
            }
        }

    }
    public function excluir($idUsuario){
        $sql = $this->con->conectar()->prepare("DELETE FROM usuario WHERE idUsuario = :idUsuario");
        $sql->bindValue(':idUsuario', $idUsuario);
        $sql->execute();

    }
    public function fazerLogin($email,$senha){
        $sql = $this->con->conectar()->prepare("SELECT * FROM usuario WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        if ($sql->rowCount () > 0){
            $sql = $sql->fetch();
            $_SESSION["logado"]= $sql['idUsuario'];

            return TRUE;
        }
        return FALSE;
    }
    public function setUsers($idUsuario){
        $this->idUsuario = $idUsuario;
        $sql = $this->con->conectar()->prepare("SELECT * FROM usuario WHERE idUsuario= :idUsuario");
        $sql ->bindValue(':idUsuario', $idUsuario);
        $sql->execute();

        if($sql->rowCount()>0){
            $sql = $sql->fetch();
            $this->detalhesDoPerfil = explode(',',$sql['detalhesDoPerfil']);//transforma em array (add,edit,del,super)
        }
    }
    public function getPermissoes(){
        return $this->detalhesDoPerfil;

    }
    public function temPermissoes($p){
         if(in_array($p, $this->detalhesDoPerfil)){
            return TRUE;
         }else{
                return FALSE;
            }
    }
}

