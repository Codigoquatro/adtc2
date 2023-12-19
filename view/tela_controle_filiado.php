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
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>
<div class="container"> 
<h1>Consultar Filiados</h1>
<hr style="border:1px solid #008000;">

  <div class="col-sm-8">
  <form class="form-group "action="../view/tela_resultado_pesquisa_filiado.php" method="get">
  <input name="matricula" id="txt_consulta" placeholder="Digite a Matricula  do Filiado" type="text" class="form-control"><br>
  <button type="submit" class="form-group btn btn-primary">Pesquisar</button>
  </form>
  </div>
  <hr>
  <div class="col-sm-8">
  <form class="form-group "action="../view/tela_resultado_pesquisa_filiado_nome.php" method="get">
  <input name="nome" id="txt_consulta" placeholder="Digite Nome do Filiado" type="text" class="form-control"><br>
  <button type="submit" class="form-group btn btn-primary">Pesquisar</button>
  </form>
  </div>
      


</div><!-- fim do Conteiner_principal -->

</body>
</html>


<?php require'footer.php';?>

 