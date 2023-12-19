<?php
session_start();
if ( !isset($_SESSION['nome']) and !isset($_SESSION['senha']) ) {  
  //Limpa
  unset ($_SESSION['nome']);
  unset ($_SESSION['senha']);
  
  //Redireciona para a página de autenticação
 header('location:login.php');   
  }     
?>
<?php 
  require '../../db/config.php';

 $sql="SELECT * FROM dizimo";
 $sql=$pdo->query($sql);

  $id_dizimo= $_GET['id_dizimo'];

  $sql = "SELECT * FROM dizimo WHERE id_dizimo ='$id_dizimo' LIMIT 1";
  $sql=$pdo->query($sql);
  if ($sql->rowCount() > 0) {
    # code...
   foreach ($sql->fetchAll() as $linhas) {
     # code...
   }

  }


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="css/dizimo.css">
  <title>Comprovante</title>  
</head>
<body>
<style>
        @media print {
            nav {
                display: none;
            }
        }
</style>
  <nav style="margin-left:50px;">
    <a href="#" onclick="window.print();" style="text-decoration:none;">
        <p id="texto_imprimir" ><?php echo rand(1,10)."   |  "."Imprimir";?></p>
    </a><a href="tela_cadastro.php">Voltar</a>
  </nav>
  <div class="conteiner">
  <div class="texto2_diz">
      <img id="checkIn_diz" src="../../imagens/diversas_imagens/logAdtcII.png" alt="">
    </div>
  <hr>
  <h4><p id="comprovante_diz">Comprovante</p></h4> 

  <div class="texto4_diz">
  <p id="dt_lancamento_diz"><strong>Lançado em</strong> : <?php echo date("d/m/Y",strtotime($linhas['dataCaptura']));?></p><br> 
  <p id="nome_diz"><strong>Nome dizimista</strong> : <br><?php echo $linhas['nome']; ?></p><br>   
  <p id="valor_diz"><strong>Valor</strong> : R$ <?php echo number_format($linhas['valor'], 2, ',', '.'); ?></p><br>
  <p id="responsavel_diz"><strong>Responsável</strong> : <?php echo $linhas['responsavel']; ?></p><br>
  <p id="congregacao_diz"><strong>Congregação</strong> : <?php echo $linhas['congregacao']; ?></p><br>
    
  </div>  


  </div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
 