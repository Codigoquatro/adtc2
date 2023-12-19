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
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Cadastro Documentos Oficiais</title>
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
					  		
			</div>
		</div>
		<div class="col-sm-9 float-left  bg-info"style="border:1px solid #ccc;margin-top:48px;padding:10px 10px; ">
        <form id="frmRegistro" name="form1" action="../procedimentos/cadastro_doc.php"  method="post" enctype="multipart/form-data" style="border:1px solid #008000;margin-top:10px;padding:10px;margin-right:0px;background-color:#FF4500;">        
	    <div class="form-row">
		<div class="form-group col-md-6">
        Descrição			      
		<input type="text" class="form-control" id="descricao" name="descricao">
		</div>
        <div class="form-group col-md-2"> 
         Tipo  
        <select class="form-control" id="tipo" name="tipo">
				    <option>pdf</option>
				    <option>xls</option>
				    <option>xlsx</option>
				    <option>ppt</option>
				    <option>doc</option>
				    <option>docx</option>
				    <option>jpg</option>
				    <option>png</option>
				    <option>txt</option>
        </select>
        </div>
        <div class="form-group col-md-4">
        Responsavel			      
			<input type="text" class="form-control" id="responsavel" name="responsavel">
		</div>     

	</div>
  
    
     
      <div class="form-row">

      <div class="form-group col-md-12">
             
            <input type="file" id="arquivo"  name="arquivo"sty><br><br>
            <button type="submit" name="button"class="btn btn-secondary">Gravar</button>
			<a class="btn btn-secondary" href="../view/gestao_documentos.php">Voltar</a>
            
      </div>
      
      
  </div>

</form>          
		</div>
	</div>		
</div><!-- Fim conteiner -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>	
</body>
</html>









<?php require 'footer.php';?>


