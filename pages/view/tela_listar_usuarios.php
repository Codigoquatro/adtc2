<?php
session_start();
if ( !isset($_SESSION['nome']) and !isset($_SESSION['senha']) ) {  
  //Limpa
  unset ($_SESSION['nome']);
  unset ($_SESSION['senha']);
  
  //Redireciona para a página de autenticação
 header('location:../login.php');   
  }     
?>
<?php   
      require_once "../db/config.php";
      $sql = "SELECT * FROM usuarios";
      $sql = $pdo->query($sql);	 
?>
<?php  // require_once'header.php';?>

<div class="container">	
<h1>Controle Geral</h1>
<hr style="border:1px solid #008000;">

	
      
	


<div class="row">
<div class="col-md-12">
	<div class="table-responsive" style="overflow: auto;border:solid 1px #FF4500;margin-top:10px;">
       <table class="table table-hover">
  <thead>
    <tr>
      <th>Edit</th>      	 
      <th>Id</th>
      <th>Email</th>
      <th>Nivel</th>
      <th>Senha</th>      
      <th>Ação</th>
    </tr>
  </thead>
  <?php 
  
  if($sql->rowCount() > 0) {
      foreach($sql->fetchAll() as $linhas){   
  ?>
  <tbody>
    <tr>
      <td><a href="../view/tela_cad_alterar_filiado.php?&id_doc=<?php echo $linhas['id_doc']; ?>"><img class="card-img-top" src="../svg/si-glyph-edit.svg" width="25" height="25" style="margin-right:-125px;"></a></td>
      
     
      <td><?php echo $linhas['id'];?></td>
      <td><?php echo $linhas['email'];?></td>
      <td><?php echo $linhas['senha'];?></td>      
      <td><?php echo $linhas['nivel'];?></td>
     
      
      <td><a href="" title=""><img src="../imagens/diversas_imagens/download.png" width="20" height="20"></a></td>
      <td><a href="../procedimentos/excluir_filiado.php?&matricula=<?php echo $linhas['matricula']; ?>">Excluir</a></td>
    
    </tr>
   
  </tbody>
  <?php 
       }
      } 
    ?>
</table>
</div>			
</div>

</div><!-- Linha 1 -->	


</div><!-- fim do Conteiner_principal -->

<?php require'footer.php';?>

 