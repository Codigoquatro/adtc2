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
  <style>
    /* Estilos personalizados */
    body {
      padding-top: 20px;
    }
    .navbar {
      margin-bottom: 20px;
    }
    .container {
      max-width: 600px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .btn-block {
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <a href="" class="navbar-brand">ADTC2</a>
  </nav>
  <div class="container">
   <form novalidate class="needs-validation" action="../procedimentos/cadastrar_usuario.php"  method="POST" >

    <div class="form-row">        
        <div class="col form-group">
           <label for="nome">Nome de Usuário</label>
           <select class="form-control" id="nome" class="form-control is-valid" name="nome"onkeyup="maiuscula(this)"required >                   
                      <option>Selecione</option>
                      <option>SEDE</option>
                      <option>ALEGRIA</option>
                      <option>JUBAIA</option>
                      <option>LAGES</option>
                      <option>NOVO MARANGUAPE 1</option>
                      <option>NOVO MARANGUAPE 2</option>
                      <option>NOVO MARANGUAPE 3</option>
                      <option>NOVO MARANGUAPE 4</option>                     
                      <option>OUTRA BANDA</option>
                      <option>PARQUE SÃO JOÃO</option>
                      <option>NOVO PARQUE IRACEMA</option>
                      <option>SITIO SÃO LUIZ</option>
                      <option>TABATINGA</option>
                      <option>UMARIZEIRAS</option>
                      <option>VITÓRIA</option>
                      <option>VIÇOSA</option>
                      <option>PAPARA</option>
                      <option>PLANALTO</option>
                      <option>SERRA JUBAIA</option>
                      <option>IRACEMA</option>
                      <option>PARAISO</option>
                      <option>CASTELO</option>
                      <option>LAMEIRÃO</option>
                      
                </select>
        </div>
    </div><!-- end div-form-row-->    
    <div class="form-row">     
        <div class="col form-group">
        <label for="nome">Nível</label> 
        <select name="nivel" id="nivel" class="custom-select is-valid"required >
            <option selected></option>
            <option value="admin">admin</option>
            <option value="apoio">apoio</option>
            <option value="financeiro">financeiro</option> 
        </select> 
        
        </div>
    </div><!-- end div-form-row-->

    <div class="form-row">        
        <div class="col form-group">
            <label for="nome">Senha</label>
            <input type="password" name="senha" id="" class="form-control is-valid" id= "senha" required>
            
        </div>
    </div><!-- end div-form-row-->
    <div class="form-row">     
        <div class="col form-group">
            <label for="nome" >Confirmar senha</label>
            <input type="text" name="confirmar" class="form-control is-valid" id= "confirmar" required>
            
        </div>   
    </div><!-- end div-form-group-row-->  

    <button type="submit" class="btn btn-primary btn-block">Gravar</button>  
    <a  href="tela_listar_usuarios.php"class="btn btn-info btn-block">Lista Usuários</a>            
   </form><!-- end form-->
  </div><!-- end div-container-->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
  <script>
    /*
    $(() => {
        $('form').on('submit', e => {

            const form = e.target;

            if (form.checkValidity() === false){
                e.preventDefault();
                e.stopImmediatePropagation();
            }
            
            $(form).addClass('was-validated');
        });
    });
    */
   window.addEventListener('load', e =>{
        const form = document.querySelector('form');

        form.addEventListener('submit', es =>{

            if (form.checkValidity() === false){
                es.preventDefault();
                es.stopImmediatePropagation();
            }

        });
          form.classList.add('was-validated')  
   
    });
  </script>

