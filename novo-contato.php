<?php 
    require_once 'contato.php';
    $c = new Contato("crudpdo","localhost","root","");
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="contato.css"/>
        <title>Agenda</title>
    </head>
    <body>
        <header class="mt-3">
            <h1>Agenda de Contatos</h1> 
            <a href="index.php" class="btn btn-primary"><i class="bi bi-arrow-left-circle"></i>Voltar</a>
        </header>
        <main class="container mt-3">
            <?php 
                if(isset($_POST['nome'])){
                    if(isset($_GET['id_up']) && !empty($_GET['id_up'])){
                        $id_upd = addslashes($_GET['id_up']); 
                        $nome = addslashes($_POST['nome']);  
                        $telefone = addslashes($_POST['telefone']);
                        $email = addslashes($_POST['email']);
                        if(!empty($id_upd) && !empty($nome) && !empty($telefone) && !empty($email)){
                            $c->atualizarContato($id_upd, $nome, $telefone, $email);
                            header("location: index.php");
                        }else{
                            echo 'Preencha todos os campos!';
                        }
                        
                    }else{
                        $nome = addslashes($_POST['nome']);  
                        $telefone = addslashes($_POST['telefone']);
                        $email = addslashes($_POST['email']);
                        if(!empty($nome) && !empty($telefone) && !empty($email)){                            
                             if(!$c->inserirContato($nome, $telefone, $email)){
                                 echo 'Email já cadastrado';                                 
                             }else{
                                 header("location: index.php");
                             }
                        }else{
                            echo 'Preencha todos os campos!';
                        }
                    }                              
               
                }
                ?> 
            <?php 
                if(isset($_GET['id_up'])){
                    $id_update = addslashes($_GET['id_up']);
                    $dadosPessoa = $c->buscarContato($id_update);               
                }
            ?>      

            <form method="POST">
                 <div class="mb-3">
                  <label for="nome" class="form-label">Nome</label>
                  <input type="text" class="form-control" id="nome" name="nome" value="<?php if(isset($dadosPessoa)){echo $dadosPessoa["nome"];}?>">
                </div> 
                 <div class="mb-3">
                  <label for="telefone" class="form-label">Telefone</label>
                  <input type="tel" maxlength="15" class="form-control" id="telefone" name="telefone" onkeyup="handlePhone(event)" value="<?php if(isset($dadosPessoa)){echo $dadosPessoa["telefone"];}?>">
                </div> 
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?php if(isset($dadosPessoa)){echo $dadosPessoa["email"];}?>">
                </div>
                <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-primary" value="<?php if(isset($dadosPessoa)){echo "Atualizar";}else{
                echo "Cadastrar";} ?>">                    
                </div>                
            </form>                       
        </main>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        const handlePhone = (event) => {
        let input = event.target;
        input.value = phoneMask(input.value);
        };

      const phoneMask = (value) => {
        if (!value) return "";
        value = value.replace(/\D/g,'');
        value = value.replace(/(\d{2})(\d)/,"($1) $2");
        value = value.replace(/(\d)(\d{4})$/,"$1-$2");
        return value;
        };    
    </script>
</html>





