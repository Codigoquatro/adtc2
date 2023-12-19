<?php
session_start();

if ( !isset($_SESSION['nome']) and !isset($_SESSION['senha']) ) {
  //Destrói
  session_destroy();

  //Limpa
  unset ($_SESSION['nome']);
  unset ($_SESSION['senha']);
  
  //Redireciona para a página de autenticação
  header('location:../login.php');
}

require '../../db/config.php';

//Caso o usuário não esteja autenticado, limpa os dados e redireciona
$id_dizimo           = $_POST['id_dizimo'];
$nome                = addslashes($_POST['nome']);
$congregacao         = addslashes($_POST['congregacao']);
$valor               = addslashes($_POST['valor']);
$responsavel         = addslashes($_POST['responsavel']);





$sql = "UPDATE dizimo SET nome='$nome',congregacao='$congregacao',valor='$valor',responsavel='$responsavel'WHERE id_dizimo ='$id_dizimo'";
$sql=$pdo->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php

		if ($sql->rowCount() != 0 ){	
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=tela_lista_dizimo.php'>
				<script type=\"text/javascript\">
					alert(\"Dizimo alterado com Sucesso.\");
				</script>
			";		   
		}else{ 	
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=tela_lista_dizimo.php'>
				<script type=\"text/javascript\">
					alert(\"Dizimo não foi alterado .\");
				</script>
			";		   

		}

		?>
	</body>
</html>