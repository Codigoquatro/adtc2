<?php
session_start();
if ( !isset($_SESSION['nome']) and !isset($_SESSION['senha']) ) {  
  //Limpa
  unset ($_SESSION['nome']);
  unset ($_SESSION['senha']);
  
  //Redireciona para a página de autenticação
 header('location:../login.php');   
  }     
?>
<?php 
      require_once "../db/config.php";

      $sql = "SELECT * FROM usuarios";
      $sql = $pdo->query($sql);
	 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <title>Cadastro Usuários</title>
</head>
<body>
  <div class="container">
   <form class="needs-validation">

    <div class="form-row">        
        <div class="col form-group">
           <label for="nome">Nome</label>
           <input type="text" name="nome" class="form-control">
        </div>
    </div><!-- end div-form-row-->    
    <div class="form-row">     
        <div class="col form-group">
        <label for="nome">Nível</label> 
        <select name="nivel" id="" class="form-control">
            <option selected>Selecione item...</option>
            <option value="1">admin</option>
            <option value="2">apoio</option>
            <option value="3">financeiro</option> 
        </select> 
        </div>
    </div><!-- end div-form-row-->

    <div class="form-row">        
        <div class="col form-group">
            <label for="nome">Senha</label>
            <input type="password" name="senha" id="" class="form-control">
        </div>
    </div><!-- end div-form-row-->
    <div class="form-row">     
        <div class="col form-group">
            <label for="nome" >Confirmar senha</label>
            <input type="text" name="confirmar" class="form-control">
        </div>   
    </div><!-- end div-form-group-row-->  

    <button type="submit" class="btn btn-primary">Gravar</button>             
   </form><!-- end form-->
  </div><!-- end div-container-->
  
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</html>