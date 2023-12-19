<?php
session_start();

if (isset($_POST['nome']) && empty($_POST['nome']) == false) {

	$nome = addslashes($_POST['nome']);

	$senha = md5(addslashes($_POST['senha']));

} 

require 'db/config.php';	

$sql = "SELECT * FROM usuarios WHERE nome='$nome' AND senha='$senha'";
$sql = $pdo->query($sql);	


if($sql->rowCount() > 0) 
{
     foreach($sql->fetchAll() as $linhas)
     {   	          
          //session_regenerate_id();

          $_SESSION['nome']   = $linhas['nome'];
          $_SESSION['senha']  = $linhas['senha'];
          $_SESSION['nivel']  = $linhas['nivel'];


          if ($_SESSION['nivel'] === "admin")
          {
               header('Location:index.php');

          }elseif($_SESSION['nivel'] === "apoio")
          {
               header('Location:index_secretario.php');  

          }else
          {
               header('Location:index_tesoureiro.php'); 

          }
          exit();    
    }      

}else{
        header("Location:login_erro.php");   
        session_destroy();
        session_unset($_SESSION['nome']);
        session_unset($_SESSION['senha']);
        session_unset($_SESSION['nivel']);           
        exit(); 
}



?>		