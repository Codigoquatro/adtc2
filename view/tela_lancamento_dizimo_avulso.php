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
  require '../db/config.php';

 $sql="SELECT * FROM filiado ";
 $sql=$pdo->query($sql);

  $matricula = $_GET['matricula'];

  $sql = "SELECT * FROM filiado WHERE matricula ='$matricula' LIMIT 1";
  $sql=$pdo->query($sql);
  if ($sql->rowCount() > 0) {
    # code...
   foreach ($sql->fetchAll() as $resultado) {
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
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' integrity='sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N' crossorigin='anonymous'>
  <title>Lancamento dizimos</title>
</head>
<body>
<div class="container">	
<h1>Lançar Dízimos Sem Cadastro</h1>
<hr style="border:1px solid #008000;">
<div class="form-group col-md-12" id="label_cor"> 
             

        </div>
<div class="row">
<div class="col-md-12">	
<form id="frmRegistro" name="form1" action="../procedimentos/cadastrar_dizimo.php"  method="POST" enctype="multipart/form-data" style="border:1px solid #008000;margin-top:10px;padding:10px;margin-right:0px;background-color:#FF4500;">
       
	<div class="form-row">
      
      <div class="col-md-3">
           
           <h1>Sou Dízimista</h1>
           <input class="form-control" type="hidden"  name="matricula"  value="<?php echo $resultado['matricula']?>">  
      </div> 
      <div class="col-md-9">            
          <img src="../imagens/diversas_imagens/vazio.jpg" width="100" height="100">
      </div>
            <script type="text/javascript">
          // INICIO FUNÇÃO DE MASCARA MAIUSCULA
          function maiuscula(z){
                  v = z.value.toUpperCase();
                  z.value = v;
              }
          //FIM DA FUNÇÃO MASCARA MAIUSCULA
          </script>
		  <div class="form-group col-md-8">
            <label for="nome" id="label_cor">Nome</label>			      
			      <input type="text" class="form-control" id="" name="nome"onkeyup="maiuscula(this)" value="">
		  </div>
      <div class="form-group col-md-4"> 
                <label for="congregacao" id="label_cor">Congregação</label>               
                <select class="form-control" id="congregacao" name="congregacao">                   
                      <option>CONGREGAÇÃO</option>
                      <option>SEDE</option>
                      <option>ALEGRIA</option>
                      <option>JUBAIA</option>
                      <option>LAGES</option>
                      <option>NOVO MARANGUAPE 1</option>
                      <option>NOVO MARANGUAPE 2</option>
                      <option>NOVO MARANGUAPE 3</option>
                      <option>NOVO MARANGUAPE 4</option>                     
                      <option>OUTRA BANDA</option>
                      <option>PARQUE SÃO JOÃO</option>
                      <option>NOVO PARQUE IRACEMA</option>
                      <option>SITIO SÃO LUIZ</option>
                      <option>TABATINGA</option>
                      <option>UMARIZEIRAS</option>
                      <option>VITÓRIA</option>
                      <option>VIÇOSA</option>
                      <option>PAPARA</option>
                      <option>PLANALTO</option>
                      <option>SERRA JUBAIA</option>
                      <option>IRACEMA</option>
                      <option>PARAISO</option>
                      <option>CASTELO</option>
                      <option>LAMEIRÃO</option>
                      
                </select>
             </div>
      

	</div>
  
    
    
    <div class="form-row">
            <div class="form-group col-md-2"> 
                <label for="valor" id="label_cor">VALOR</label>               
                <input type="text" class="form-control" id="valor"placeholder=""name="valor" >
             </div>

        <div class="form-group col-md-2" >
                <label for="cidade" id="label_cor">Responsável</label>                   
                <select class="form-control" id="responsavel" name="responsavel">                   
                      <option>RESPONSAVEL</option>
                      <option>MARIA DE JESUS</option>
                      <option>ALBANIZA</option>
                      <option></option>
                      <option></option>
                      <option></option>                      
                      <option></option>
                      
                </select>
        </div>
        
        
    </div>
   
      <button id="registro" type="submit" name="button"class="btn btn-secondary">Gravar</button>
     
    
      
  </div>

</form>          
</div>




</div><!-- fim do Conteiner_principal -->
</body>
</html>     

<?php require'footer.php';?>
