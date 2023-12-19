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

 $sql="SELECT * FROM saidas";
 $sql=$pdo->query($sql);

  $id= $_GET['id'];

  $sql = "SELECT * FROM saidas WHERE id ='$id' LIMIT 1";
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
  <title>Alterar</title>
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
    <a href="../../index_tesoureiro.php" class="navbar-brand">Saída</a>
  </nav>
  <div class="container">
   <form novalidate class="needs-validation" action="procedimento_alterar_saida.php"  method="POST" enctype="multipart/form-data">
  
   <div class="form-row">        
        <div class="col form-group">          
           <input type="hidden" name="id" class="form-control is-valid" id="descricao" value="<?php echo $linhas['id']; ?>" >
        </div>
    </div><!-- end div-form-row--> 
    <div class="form-row">        
        <div class="col form-group">
           <label for="nome">Data da Saída</label>
           <input type="text" name="datasaida" class="form-control is-valid" id="descricao" value="<?php echo date("d/m/Y", strtotime($linhas['datasaida'])); ?>" required>
        </div>
    </div><!-- end div-form-row-->  

    <div class="form-row">        
        <div class="col form-group">
           <label for="nome">Valor</label>
           <input type="text" name="valor" class="form-control is-valid" id="descricao" value="<?php echo $linhas['valor']; ?>" required>
        </div>
    </div><!-- end div-form-row-->  
    <div class="form-row">
        <div class="col form-group">       
        <label for="nome">Responsavel</label>
           <input type="text" name="responsavel" class="form-control is-valid" id="qtde" value="<?php echo $linhas['responsavel']; ?>"required>
        </div>
    </div><!-- end div-form-row-->

    <div class="form-row">        
        <div class="col form-group">
            <label for="nome">Congregação</label>
            <select name="congregacao" id="tipo_evento" class="custom-select is-valid" required>
            <option><?php echo $linhas['congregacao']; ?></option>
            </select> 
            
        </div>
    </div><!-- end div-form-row-->
    <div class="form-row">     
        <div class="col form-group">       
        <label for="nome">Descrição</label>
        <input type="text" name="descricao" class="form-control is-valid" id="" value="<?php echo $linhas['descricao']; ?>" required>
        </div>
    </div><!-- end div-form-row-->

</div>        
 
    </div><!-- end div-form-group-row-->  

    <button type="submit" class="btn btn-primary btn-block">Alterar</button>  
    <a  href="tela_lista_saida.php"class="btn btn-info btn-block">Listar Saida</a>  
    <a  href="tela_relatorio_saida.php"class="btn btn-primary btn-block">Relatório</a>           
   </form><!-- end form-->
  </div><!-- end div-container-->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
  <script>

          // Função para aplicar a máscara no campo de telefone
          function formatarTelefone() {
            const inputTelefone = document.getElementById("telefone");
            let valor = inputTelefone.value.replace(/\D/g, ''); // Remove caracteres não numéricos
            let formattedValue = '';

            if (valor.length === 11) {
                formattedValue = `(${valor.slice(0, 2)}) ${valor.slice(2, 7)}-${valor.slice(7)}`;
            } else if (valor.length === 10) {
                formattedValue = `(${valor.slice(0, 2)}) ${valor.slice(2, 6)}-${valor.slice(6)}`;
            } else if (valor.length === 9) {
                formattedValue = `${valor.slice(0, 5)}-${valor.slice(5)}`;
            } else if (valor.length === 8) {
                formattedValue = `${valor.slice(0, 4)}-${valor.slice(4)}`;
            } else {
                formattedValue = valor;
            }

            inputTelefone.value = formattedValue;
        }

        // Adiciona o evento input para formatar o telefone enquanto o usuário digita
        const inputTelefone = document.getElementById("telefone");
        inputTelefone.addEventListener("input", formatarTelefone);  


    const inputHorario = document.getElementById('horario');

    inputHorario.addEventListener('input', function () {
      let value = this.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
      if (value.length > 4) {
        value = value.substring(0, 4); // Limita a entrada a 4 caracteres
      }

      if (value.length > 2) {
        value = value.substring(0, 2) + ':' + value.substring(2); // Adiciona dois pontos no meio
      }

      this.value = value;
    }); 
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