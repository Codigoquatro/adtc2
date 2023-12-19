<?php
session_start();
if (!isset($_SESSION['nome']) and !isset($_SESSION['senha']))
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

// Parâmetros da paginação
$porPagina = 5; // Quantidade de resultados por página
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Página atual, padrão é 1

// Consulta total de registros
$totalRegistros = $pdo->query("SELECT COUNT(*) FROM documentos")->fetchColumn();

// Cálculo para determinar o número total de páginas
$totalPaginas = ceil($totalRegistros / $porPagina);

// Calcula o índice inicial para a consulta
$indiceInicio = ($paginaAtual - 1) * $porPagina;

// Consulta com LIMIT para a paginação
$sql = "SELECT * FROM documentos LIMIT $indiceInicio, $porPagina";
$query = $pdo->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <title>Lista Documentos</title>
  <style>
        .pagination {
            margin-top: 20px;
        }

        .pagination li {
            display: inline;
            margin-right: 5px;
        }

        .pagination li a {
            padding: 5px 10px;
            border: 1px solid #ccc;
            background-color: #f8f8f8;
            color: #333;
            text-decoration: none;
        }

        .pagination li.active a {
            background-color: #007bff;
            color: #fff;
        }
    </style>
    <head>
    <!-- ... outras tags head ... -->
    <style>
        /* Estilização da tabela */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        .table tr:hover {
            background-color: #e0e0e0;
        }

        /* Estilização da tabela responsiva */
        .table-responsive {
            overflow: auto;
            border: 1px solid #FF4500;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="conteiner">
    <div class="row">
		<div class="col-sm-2"><br><br>
			<div class="list-group"style="margin-left:5px;">
      <a href="../view/gestao_doc_cadastro.php" class="list-group-item list-group-item-action ">
					    Cadastro de Documentos Oficiais
					  </a>
					  <a href="../view/gestao_doc_cadastro_digitalizados.php" class="list-group-item list-group-item-action">Cadastro de Documentos Digitalizados</a>
					  <a href="../view/gestao_listar_documentos.php" class="list-group-item list-group-item-action">Lista de Modelo de Documentos Oficiais</a>
					  <a href="../view/gestao_listar_documentos_digitalizados.php" class="list-group-item list-group-item-action">Lista de Documentos Digitalizados</a>	
            	
			</div>
		</div>
		<div class="col-sm-9 float-left  bg-secondary"style="border:1px solid #000;margin-top:48px;">
             <div class="row">
<div class="col-md-12">
	<div class="table" style="overflow: auto;margin-top:10px;">
  <table class="table table-hover">
  <thead>
  <tr>            
            <th>Id</th>
            <th>Descrição</th>
            <th>Tipo</th>
            <th>Responsavel</th>
            <th>Data Cadastro</th>
            <th>Arquivo</th>      
            <th>Baixar</th>
            <th>Voltar</th>
            <th>Excluir</th>      
          </tr>
  </thead>
        <?php 
  
       if($query->rowCount() > 0) {
       foreach($query->fetchAll() as $linhas){   
        ?>
  <tbody>
            
      <td><?php echo $linhas['id'];?></td>
      <td><?php echo $linhas['descricao'];?></td>
      <td><?php echo $linhas['tipo'];?></td>      
      <td><?php echo $linhas['responsavel'];?></td>
      <td><?php echo $linhas['dataCadastro'];?></td>
      <td><?php echo $linhas['arquivo'];?></td>
      
      <td><a href="../documentos/<?php echo $linhas['arquivo'];?>" title="Baixe arquivo" download><img src="../imagens/diversas_imagens/download.png" width="20" height="20"></a></td>
      <td><a href="../view/gestao_documentos.php" title="Voltar"><img src="../imagens/diversas_imagens/voltar.png" width="20" height="20"></a></td>
      <td><a href="../procedimentos/excluir_documento.php?&id=<?php echo $linhas['id']; ?>"><img src="../imagens/diversas_imagens/excluir.png"width="30" height="20" ></a></td>
    
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
<div class="row">
        <div class="col-md-12">
            <ul class="pagination">
                <?php
                for ($pagina = 1; $pagina <= $totalPaginas; $pagina++) {
                    echo "<li><a href='?pagina=$pagina'>$pagina</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</div><!-- fim do Conteiner_principal -->	
		</div>
    
	</div>
	
</div><!-- Fim conteiner -->


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>  
</body>
</html>















