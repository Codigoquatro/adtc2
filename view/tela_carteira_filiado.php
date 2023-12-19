<?php
session_start();
if (!isset($_SESSION['nome']) and !isset($_SESSION['senha']) )
 {  
  //Limpa
  unset ($_SESSION['nome']);
  unset ($_SESSION['senha']);
  
  //Redireciona para a página de autenticação
  header('location:login.php'); 
  }
?>
<?php   
      require_once "../db/config.php";
      $sql = "SELECT * FROM filiado  LIMIT 0";
      $sql = $pdo->query($sql);	 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
 
  <title>Buscar carteira</title>
</head>
<body>
  <div class="container">  
<br>
<h1>CARTÃO DE IDENTIFICAÇÃO</h1>  

<hr>

<div class="col-sm-4 form-group ">
  <form class="form-group "action="../carteira/carteira.php" method="get">
      <input name="matricula" id="txt_consulta" placeholder="Pesquisar pela Matricula" type="text" class="form-control"><br>
      <button type="submit" class="form-group btn btn-primary">Pesquisar</button>
  </form>
</div><br>

<div class="col-sm-4 form-group ">
  <form class="form-group "action="../carteira/carteira.php" method="get">
      <input name="nome" id="txt_consulta" placeholder="Pesquisar pela Nome" type="text" class="form-control"><br>
      <button type="submit" class="form-group btn btn-success">Pesquisar</button>
  </form>
</div>

  </div>
</body>
</html>




 