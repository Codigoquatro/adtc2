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
$id_ofertas          = $_POST['id_ofertas'];
$dataOferta          = addslashes($_POST['dataOferta']);
$valor               = addslashes($_POST['valor']);
$congregacao         = addslashes($_POST['congregacao']);
$responsavel         = addslashes($_POST['responsavel']);





$sql = "UPDATE ofertas SET dataOferta='$dataOferta',valor='$valor',congregacao='$congregacao',responsavel='$responsavel'WHERE id_ofertas ='$id_ofertas'";
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
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=tela_lista_oferta.php'>
				<script type=\"text/javascript\">
					alert(\"Oferta alterada com Sucesso.\");
				</script>
			";		   
		}else{ 	
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=tela_lista_oferta.php'>
				<script type=\"text/javascript\">
					alert(\"Oferta não foi alterado .\");
				</script>
			";		   

		}

		?>
	</body>
</html>