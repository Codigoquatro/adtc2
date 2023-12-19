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

      $sql = "SELECT * FROM saidas";
      $sql = $pdo->query($sql);
	 
?>


<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' integrity='sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N' crossorigin='anonymous'>
<br><br><br>		
<div class="container">	
<h1>Saídas</h1>
<hr style="border:1px solid #008000;">
<a href="https://codigoquatro.com.br/adtc2/view/lancamentos.php">voltar</a>
<div class="row justify-content-center"> 

<div class="form-row">
<div class="col-md-12">
<div class="table-responsive" style="overflow: auto;margin-top:10px;">  
<table class="table table-responsive-md">
  <thead>
    <tr class="header">
      <th>Id</th>
      <th>Data</th>
      <th>Valor</th>
      <th>Responsavel</th>
      <th>Congregação</th>
      <th>Descrição</th>
       <th>Ações</th>  
     </tr>
  </thead>
  <?php 
  
  if($sql->rowCount() > 0) {
      foreach($sql->fetchAll() as $linhas){   
  ?>
  <tbody>
    <tr>
      
      <td><?php echo $linhas['id'];?></td>
      <td><?php echo date("d/m/Y",strtotime($linhas['datasaida']));?></td>
      <td><?php echo $linhas['valor'];?></td>
      <td><?php echo $linhas['responsavel'];?></td> 
      <td><?php echo $linhas['congregacao'];?></td> 
      <td><?php echo $linhas['descricao'];?></td>        
      <td><a class="btn btn-primary" href="../procedimentos/excluir_saidas.php?&id=<?php echo $linhas['id']; ?>">Excluir</a></td> 
    
    </tr>
   
  </tbody>
  <?php 
       }
      } 
    ?>
</table>
</div>
    		
</div>
</div>
</div>
</div><!-- Linha 1 -->	

  
</div><!-- fim do Conteiner_principal -->
<footer style="background-color:">
	
</footer>
<?php require_once'footer.php';?>
 