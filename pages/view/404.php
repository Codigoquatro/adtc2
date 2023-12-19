<?php
session_start();
 require '../db/config.php';
 if (!isset($_SESSION['nome']) and !isset($_SESSION['senha'])) {
  //Destrói
  session_destroy();
  //Limpa
  unset($_SESSION['nome']);
  unset($_SESSION['senha']);
  //Redireciona para a página de autenticação
  header('location:login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pesquisa</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/meuEstilo.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="container">

        <div class="pagina-erro col-sm-12">
          <h1>
            <i class="fas fa-exclamation-triangle text-warning"></i>
             Oops! Filiado não encontrado!
           </h1>
        </div>
      <a href="index.php" class="brand-link">
      <img id ="img_erro" src="../imagens/img_carteira/logo sem fundo.png" alt="ADTC II" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">ADTC System</span>
    </a>
       
</div>


<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
