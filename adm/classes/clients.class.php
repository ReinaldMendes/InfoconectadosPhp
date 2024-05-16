<?php
require 'conexao.class.php';  //para poder usar a classe conexao pelo banco de dados
class Cliente {
//idCliente	Nome	Sobrenome	Endereço, telefone	$qualServicoPrecisa , email, senha
    private $idCliente;
    private $nome ;
    private $sobrenome; 
    private $data_nasc;
	private $endereco; 
	private	$qualServicoNecessita; 
    private	$telefone;
	private	$email; 
	private $senha;



    private $con;

    public function __construct(){  // underline duplo considerado um comando mágico, ou seja, tem uma carta na manga pra facilitar a programação
        $this->con = new Conexao();
    }
    
    //vamos fazer uma validação pelo email, que é um atributo único, assim evitamos que haja duplicidade no cadastro de usuário
    private function existeEmail($email){
        $sql = $this->con->conectar()->prepare("SELECT idCliente FROM cliente WHERE email = :email");
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();  //comando fetch retorna o valor que está no banco de dados, email no caso

        }else{
            $array = array();
        }
        return $array;
    }  //idCliente	Nome	Sobrenome	Endereço, telefone	$qualServicoPrecisa , telefone, email, senha
    public function adicionar($email, $nome, $sobrenome, $data_nasc, $endereco, $qualServicoNecessita, $telefone,$senha){
        $emailExistente = $this->existeEmail($email);
        if(count($emailExistente) == 0){
            try{
                $this->nome = $nome;
                $this->sobrenome= $sobrenome;
                $this->data_nasc= $data_nasc;
                $this->endereco = $endereco;
                $this->qualServicoNecessita = $qualServicoNecessita;
                $this->telefone = $telefone;
                $this->email = $email;
                $this->senha = $senha;
                
                
                            //idCliente	nome	sobrenome	data_nasc	endereco	qualServicoNecessita	telefone	email	senha
                $sql = $this->con->conectar()->prepare("INSERT INTO cliente (nome, sobrenome, data_nasc, endereco, qualServicoNecessita, telefone, email, senha)
                    VALUES(:nome, :sobrenome, :data_nasc, :qualServicoNecessita, :endereco, :telefone, :email, :senha)");
                    $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
                    $sql->bindParam(":sobrenome", $this->sobrenome, PDO::PARAM_STR);
                    $sql->bindParam(":data_nasc", $this->data_nasc, PDO::PARAM_STR);
                    $sql->bindParam(":endereco", $this->endereco, PDO::PARAM_STR);
                    $sql->bindParam(":qualServicoNecessita", $this->qualServicoNecessita, PDO::PARAM_STR);
                    $sql->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
                    $sql->bindParam(":senha", $this->senha, PDO::PARAM_STR);
                    $sql->bindParam(":email", $this->email, PDO::PARAM_STR);
                   

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
            $sql = $this->con->conectar()->prepare("SELECT idCliente, nome, sobrenome, data_nasc, qualServicoNecessita, endereco, telefone, email, senha FROM cliente");
            $sql->execute(); 
            return $sql->fetchAll();           

        }catch(PDOException $ex){
            return 'ERRO: '.$ex->getMessage();
        }
    }
    public function buscar ($idCliente){
        try{
            $sql = $this->con->conectar()->prepare("SELECT * FROM cliente WHERE idCliente = :idCliente");
            $sql->bindValue(':idCliente',$idCliente);
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
    public function editar( $nome, $sobrenome, $data_nasc, $qualServicoNecessita,$telefone, $email, $senha, $idCliente){
        $emailExistente = $this->existeEmail($email);
        if(count ($emailExistente )> 0 && $emailExistente['idCliente']!=$idCliente){
            return FALSE;
        }else{
            try{//idUsuario	nome	email	senha	detalhesDoPerfil	cpf	Data_Nasc	telefone
                $sql = $this->con->conectar()->prepare("UPDATE cliente SET nome = :nome, sobrenome = :sobrenome, data_nasc= :data_nasc, endereco = :endereco, qualServicoNecessita = :qualServicoNecessita, telefone = :telefone, email= :email, senha = :senha 
                 WHERE idCliente = :idCliente ");
                $sql->bindValue(':nome', $nome); 
                $sql->bindValue(':sobrenome', $sobrenome); 
                $sql->bindValue(':data_nasc', $data_nasc); 
                $sql->bindValue(":endereco", $this->endereco, PDO::PARAM_STR);
                $sql->bindValue(':qualServicoNecessita', $qualServicoNecessita); 
                $sql->bindValue(':telefone', $telefone); 
                $sql->bindValue(':email', $email); 
                $sql->bindValue(':senha', $senha);   
                $sql->bindValue(':idCliente', $idCliente); 
                $sql->execute();
                return TRUE;           
    
            }catch(PDOException $ex){
                echo'ERRO: '.$ex->getMessage();
            }
        }

    }
    public function excluir($idCliente){
        $sql = $this->con->conectar()->prepare("DELETE FROM cliente WHERE idCliente = :idCliente");
        $sql->bindValue(':idCliente', $idCliente);
        $sql->execute();

    }
}