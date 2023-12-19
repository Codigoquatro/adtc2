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
       $consulta = $_GET['consulta'];
       $sql    = "SELECT * FROM filiado WHERE nome LIKE '$consulta%'";
       $sql    = $pdo->query($sql);
?>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' integrity='sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N' crossorigin='anonymous'>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' integrity='sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N' crossorigin='anonymous'>
  <link rel="stylesheet" href="../css/pesquisar_dizimista.css">
  <title>Resultado pesquisa dizimista</title>
</head>
<body>
<div class="container">
        <div class="col-sm-12" id= "search_dizimista">
          <form class="form-group "action="../view/tela_resultado_pesquisa_dizimo.php" method="get">
                  <div class="input-group mb-3">
                          <input name="consulta" id="txt_consulta" placeholder="Consultar" type="text" class="form-control">
                  </div>
                    
                    <button type="submit" class="form-group btn btn-primary" >Pesquisar</button> 
          </form>  
        </div>
</div> 
<div class="container">

      <?php   
          if($sql->rowCount() > 0) {
              foreach($sql->fetchAll() as $linhas){   
      ?>
      <div class="container">
          <div class="card" style="width: 18rem;">
                  <img src="../imagens/<?php echo $linhas['arquivo'];?>">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo "Matricula :".$linhas['matricula'];?></h5>
                    <p class="card-text"><?php echo $linhas['nome'];?></p>
                    <p class="card-text"><?php echo $linhas['congregacao'];?></p>
                    <a class="btn btn-primary" href="../view/tela_lancamento_dizimo.php?&matricula=<?php echo $linhas['matricula']; ?>">Lançar</a>
                  </div>
          </div>
     </div>          

      <?php 
          }
          } 
        ?>  
</body>
</html>
<?php require'footer.php';?>

 