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

require'../db/config.php';

if (isset($_POST['nome']) && empty($_POST['nome']) == false) {
$dados=array(
addslashes($_POST["nome"]),
addslashes($_POST["nivel"]),
MD5(addslashes($_POST["senha"])),
addslashes($_POST["confirmar"])

);

}

$data		= date('Y-m-d');

$sql = "INSERT INTO usuarios (nome,nivel,senha,confirmar,dataCaptura) VALUES('$dados[0]','$dados[1]','$dados[2]','$dados[3]','$data')";
$sql = $pdo->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
		if ($sql->rowCount() > 0 ){	
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/usuarioCadastrado.php'>				
			";		   
		}
		 else{ 	
				echo "			
				<script type=\"text/javascript\">
					alert(\"Usuário não foi cadastrado com Sucesso.\");
				</script>
			";		   

		}
Alegria2022
		?>
	</body>
</html>
