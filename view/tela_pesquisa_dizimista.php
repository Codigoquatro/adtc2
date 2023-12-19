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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' integrity='sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N' crossorigin='anonymous'>
  <link rel="stylesheet" href="../css/pesquisar_dizimista.css">
  <title>Pesquisa dizimista</title>
</head>
<body>
      <div class="container">
        <div class="col-sm-12" id= "search_dizimista">
          <form class="form-group "action="../view/tela_resultado_pesquisa_dizimo.php" method="get">
                  <div class="input-group mb-3">
                          <input name="consulta" id="txt_consulta" placeholder="Nome do dizimista" type="text" class="form-control">
                  </div>
                    
                    <button type="submit" class="form-group btn btn-primary" >Pesquisar</button> 
          </form>  
          <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                  <div class="card-header">Dizimistas sem cadastro</div>
                    <div class="card-body">
                      <a class="btn btn-light" href="tela_lancamento_dizimo_avulso.php">Lançar</a>
                    </div>
                  </div>
          </div>
      </div> 
</body>
</html>




 

   
  

	
