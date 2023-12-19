<?php
session_start();
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {  
    // Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    
    // Redireciona para a página de autenticação
    header('location: login.php');   
    exit;
}

require_once "../db/config.php";

$consulta = isset($_GET['consulta']) ? $_GET['consulta'] : "";
$matricula = isset($_GET['matricula']) ? $_GET['matricula'] : "";
$nome = isset($_GET['nome']) ? $_GET['nome'] : "";

// Construa a consulta SQL com base no campo de pesquisa
if ($consulta === "matricula") {
    $sql = "SELECT * FROM filiado WHERE matricula = :valorPesquisa";
} elseif ($consulta === "nome") {
    $sql = "SELECT * FROM filiado WHERE nome = :valorPesquisa";
} else {
    // Se nenhum tipo de consulta específico for fornecido, execute a consulta padrão
    $sql = "SELECT * FROM filiado";
}

// Prepara a declaração SQL
$stmt = $pdo->prepare($sql);

// Substitui o marcador de posição pelo valor real
$stmt->bindParam(':valorPesquisa', $matricula); // Use matrícula ou nome, dependendo do tipo de consulta

// Executa a consulta
$stmt->execute();

// Obtém o resultado
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if ($resultado) {
    // Se houver resultados, exiba os dados
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <title>Gerar QRcode</title>
  <style>
    /* Estilos personalizados */
    body {
      padding-top: 20px;
    }
    .navbar {
      margin-bottom: 20px;
    }
    .container {
      max-width: 600px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .btn-block {
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <a href="https://codigoquatro.com.br/adtc2/index.php" class="navbar-brand">Gerar QRCode</a>
  </nav>
  <div class="container">
   <form novalidate class="needs-validation" action="procedimento_gerarQRcode.php"  method="POST" enctype="multipart/form-data">
   <div class="form-row">        
        <div class="col form-group">
           <label for="matricula">Matricula</label>
           <input type="text" name="matricula" class="form-control is-valid" id="matricula" value="<?php echo $resultado['matricula'];?>">
        </div>
    </div><!-- end div-form-row--> 
    <div class="form-row">        
        <div class="col form-group">
           <label for="nome">Nome</label>
           <input type="text" name="nome" class="form-control is-valid" id="nome" value="<?php echo $resultado['nome'];?>">
        </div>
    </div><!-- end div-form-row-->    
</div>      
 
    </div><!-- end div-form-group-row-->  

    <button type="submit" class="btn btn-primary btn-block">Gerar QRCode</button>
    <a  href="tela_cadastro.php"class="btn btn-info btn-block">Associar</a>    
    <a  href="tela_lista_ponto.php"class="btn btn-info btn-block">Lista de QRCode </a>  
    <a  href="tela_relatorio_ponto.php"class="btn btn-primary btn-block">Relatório Presenças</a>           
   </form><!-- end form-->
  </div><!-- end div-container-->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
  <script>
    /*
    $(() => {
        $('form').on('submit', e => {

            const form = e.target;

            if (form.checkValidity() === false){
                e.preventDefault();
                e.stopImmediatePropagation();
            }
            
            $(form).addClass('was-validated');
        });
    });
    */
   window.addEventListener('load', e =>{
        const form = document.querySelector('form');

        form.addEventListener('submit', es =>{

            if (form.checkValidity() === false){
                es.preventDefault();
                es.stopImmediatePropagation();
            }

        });
          form.classList.add('was-validated')  
   
    });
  </script>
<?php
} else {
    echo "Nenhum resultado encontrado.";
}
?>