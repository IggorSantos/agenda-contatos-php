<?php  
 require_once 'contato.php';
 $c = new Contato("crudpdo","localhost","root","");
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css"/>
        <title>Agenda</title>
    </head>
    <body>
        <header class="mt-3">
            <h1>Agenda de Contatos</h1>
            <a href="novo-contato.php" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i>Novo Contato</a>            
        </header>
        <main class="container mt-3">
            <div class="first-row row">
                <div class="col-3">
                    Nome                    
                </div>  
                 <div class="col-3">
                    Telefone                  
                </div> 
                 <div class="col-3">
                    Email                    
                </div> 
            </div>
            <?php 
             $dados = $c->listarContatos();
                         if(count($dados) > 0){
                                for($i=0; $i < count($dados); $i++){
                                    echo "<div class='row-dados row'>";
                                    foreach ($dados[$i] as $k => $v) {
                                        if($k != "id"){
                                            echo "<div class='col-3'>".$v."</div>";                                
                                        }                                                        
                                    }
                                ?> 
                                    <div class="col-3">                            
                                        <a href="novo-contato.php?id_up=<?php echo $dados[$i]['id']?>" class="btn btn-info"><i class="bi bi-pencil-fill"></i>Editar</a>
                                        <a href="index.php?id=<?php echo $dados[$i]['id'];?>" class="btn btn-danger"><i class="bi bi-trash3-fill"></i>Excluir</a>
                                    </div> 
                                <?php
                                    echo "</div>";
                                }
                        }else{
                            echo 'Ainda não existem pessoas cadastradas';                
                        } 
            ?>            
        </main>
        
        <?php
        // put your code here
        ?>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>

<?php 
    if(isset($_GET['id'])){
        $id_pessoa = addslashes($_GET['id']);
        $c->deletarContato($id_pessoa);
        header("location: index.php");
        exit;
    }
    /*Warning: Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\agenda-contatos\index.php:66) in C:\xampp\htdocs\agenda-contatos\index.php on line 74
     * Erro que aparece as vezes quando tenta excluir um contato que foi recentemente cadastrado
     */
    
?>
