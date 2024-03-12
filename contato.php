<?php
Class Contato{
    private $pdo;
    
    public function __construct($dbName, $host, $user, $senha) {
        try{
            $this->pdo = new PDO("mysql:dbname=".$dbName.";host=".$host,$user,$senha);
        } catch (PDOException $e) {
            echo 'Erro no banco de dados: '.$e->getMessage();
        }
        catch (Exception $e){
            echo 'Erro Genérico '.$e->getMessage();            
        }
                
    }
    
    public function listarContatos(){
        $res = array();
        $res = $this->pdo->query("SELECT * FROM contato ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
        return $res;

    }
    
    public function inserirContato($nome, $telefone, $email){
         $test = $this->pdo->query("SELECT id FROM contato WHERE email = '$email'");
            if($test->rowCount() > 0){                
                return false;
            }else{
                $res = $this->pdo->query("INSERT INTO contato(nome,telefone,email) VALUES ('$nome','$telefone','$email')");
                return true;
            }        
    }
    
    public function deletarContato($id) {
        $this->pdo->query("DELETE FROM contato WHERE id = '$id'");        
    }
    
    public function buscarContato($id) {
        $res = array();
        $res = $this->pdo->query("SELECT * FROM contato WHERE id='$id'")->fetch(PDO::FETCH_ASSOC);   
        return $res;
    }
    
    public function atualizarContato($id, $nome, $telefone,$email) {
        $this->pdo->query("UPDATE contato SET nome = '$nome',telefone = '$telefone',email = '$email' WHERE id = '$id'");        
    }

}

