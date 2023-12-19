<?php
session_start();
if (!isset($_SESSION['nome']) and !isset($_SESSION['senha']) )
 {  
  //Limpa
  unset ($_SESSION['nome']);
  unset ($_SESSION['senha']);
  
  //Redireciona para a p���gina de autentica������o
  header('location:login.php'); 
  }
?>
<?php   
      require_once "../db/config.php";
       $matricula= $_GET['matricula'];
       $sql    = "SELECT * FROM filiado WHERE matricula='$matricula' ";
       $sql    = $pdo->query($sql);
?>



   <?php if($sql->rowCount() > 0): ?>
     <?php foreach($sql->fetchAll() as $linhas){
   ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Resultado da Busca</title>
  </head>
  <body>
  <div class="container">
       <div class="row">  

        <div class="cols-sm-6"id="foto_resultado">
          <img class="img-thumbnail" src="../imagens/<?php echo $linhas['arquivo'];?>" width="400" height="400" style="margin-right:20px;margin-top:40px;border-radius: 50% "> 
        </div>

        <div class="cols-sm-6" style="margin:10px 20px;margin-top:40px;">
          <label>Matricula : <?php echo $linhas['matricula'];?></label>
          <p>Nome : <?php echo $linhas['nome'];?></p>
          <p>Cargo : <?php echo $linhas['funcao'];?> </p>  
          <p>Congregação : <?php echo $linhas['congregacao'];?></p>
          <p>Documento : <?php echo $linhas['documento'];?></p>
          <p>Data de Nascimento : <?php echo date("d/m/Y",strtotime($linhas['dataNascimento']));?></p>
          <p>Data do Batismo : <?php echo date("d/m/Y",strtotime($linhas['dataBatismo']));?></p>
          <p>Data da Consagração : <?php echo date("d/m/Y",strtotime($linhas['data_Consagracao']));?></p>
          <p>Estado Civil : <?php echo $linhas['estadoCivil'];?></p>  
          <p>Nome da Mãe : <?php echo $linhas['mae'];?></p>
          <p>Nome do Pai : <?php echo $linhas['pai'];?></p> 
          <p>Cadastrado em : <?php echo date("d/m/Y",strtotime($linhas['datCadastro']));?></p>
          <p>Status Atual : <?php echo $linhas['status'];?></p> 
        </div>
       
        <div class="col-sm-6" style="margin-top:20px;">
          <div class="text-center">
              <a class="btn btn-primary d-inline" href="../view/tela_alterar_filiado.php?&matricula=<?php echo $linhas['matricula']; ?>">Alterar</a>
              <a class="btn btn-danger d-inline" href="../procedimentos/excluir_filiado.php?&matricula=<?php echo $linhas['matricula']; ?>">Excluir</a>
              <a class="btn btn-primary d-inline" href="../view/tela_controle_filiado.php">Voltar</a>
          </div>
        </div>

    
      </div>    
      </div>     
  </body>
  </html>    
      
     
  <?php 
    }
   ?>
<?php else: ?>
 
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/404.php'>
        <script type=\"text/javascript\">
          alert(\"Filiado não encontrado.\");
        </script>

   
<?php endif; ?>  





<?php require'footer.php';?>

 