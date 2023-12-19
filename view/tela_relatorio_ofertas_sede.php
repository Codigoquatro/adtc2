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
      $total = 0;
      $sql = "SELECT COUNT(*) as c FROM ofertas";
      $sql = $pdo->query($sql);
      $sql = $sql->fetch();
      $total = $sql['c'];
      $paginas = $total / 10;



      $p = 0;
      $pg = 1;
      if (isset($_GET['p']) && !empty($_GET['p'])){
        $pg = addslashes($_GET['p']);
      }
      $p = ($pg - 1) * 10;

      $sql = "SELECT * FROM ofertas LIMIT $p,10";
      $sql = $pdo->query($sql);
	 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' integrity='sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N' crossorigin='anonymous'>
  <title>Relatorio Ofertas</title>
</head>
<body>
  <div class="container">
  <div class="table-responsive">  
  <table class="table table-sm">
  <thead>
    <tr class="header">
      <th>Id</th>
      <th>Data</th>
      <th>Valor</th>
      <th>Responsavel</th>
      <th>Congregação</th>
       <th>Ações</th>  
     </tr>
  </thead>
  <?php   
  if($sql->rowCount() > 0) {
      foreach($sql->fetchAll() as $linhas){   
  ?>
  <tbody>
    <tr>      
      <td><?php echo $linhas['id_ofertas'];?></td>
      <td><?php echo date("d/m/Y",strtotime($linhas['dataOferta']));?></td>
      <td><?php echo $linhas['valor'];?></td>
      <td><?php echo $linhas['responsavel'];?></td> 
      <td><?php echo $linhas['congregacao'];?></td>       
      <td><a class="btn btn-primary" href="../procedimentos/excluir_ofertas.php?&id_ofertas=<?php echo $linhas['id_ofertas']; ?>">Excluir</a></td>     
    </tr>   
  </tbody>

  <?php 
       }
      } 
    ?>
</table>
</div>
<nav aria-label="...">
  <ul class="pagination pagination-sm">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">1</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
  </ul>
</nav>
<?php 
   // for($q=0;$q<$paginas;$q++){
     // echo '<a href=#"./?p='.($q+1).'">['.($q+1).']</a>';
   // }
  ?>
</div>

</body>
</html>
