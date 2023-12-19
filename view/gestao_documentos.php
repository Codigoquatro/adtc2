<?php
session_start();
 if (!isset($_SESSION['nome']) and !isset($_SESSION['senha'])) {
  //Destr���i
  session_destroy();
  //Limpa
  unset($_SESSION['nome']);
  unset($_SESSION['senha']);
  //Redireciona para a p���gina de autentica������o
  header('location:login.php');
}
?>
<?php   
  require '../db/config.php';  
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Documentos</title>
</head>
<body>
<div class="conteiner">
    <div class="row">
		<div class="col-sm-2"><br><br>
			<div class="list-group"style="margin-left:5px;">
					  <a href="../view/gestao_doc_cadastro.php" class="list-group-item list-group-item-action ">
					    Cadastro de Documentos Oficiais
					  </a>
					  <a href="../view/gestao_doc_cadastro_digitalizados.php" class="list-group-item list-group-item-action">Cadastro de Documentos Digitalizados</a>
					  <a href="../view/gestao_listar_documentos.php" class="list-group-item list-group-item-action">Lista de Modelo de Documentos Oficiais</a>
					  <a href="../view/gestao_listar_documentos_digitalizados.php" class="list-group-item list-group-item-action">Lista de Documentos Digitalizados</a>	
					  <a href="https://codigoquatro.com.br/adtc2/index.php" class="list-group-item list-group-item-action">Voltar</a>					 		
			</div>
		</div>
		<div class="col-sm-9 float-left  bg-secondary" style="border:1px solid #000;margin-top:48px;">
             <h1 style="color:#fff;">Gestão de Documentos</h1>
		</div>
	</div>		
</div><!-- Fim conteiner -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>	
</body>
</html>
<?php require 'footer.php';?>


