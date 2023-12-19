<?php
session_start();
 require '../db/config.php';
 if (!isset($_SESSION['nome']) and !isset($_SESSION['senha'])) {
  //Destrói
  session_destroy();
  //Limpa
  unset($_SESSION['nome']);
  unset($_SESSION['senha']);
  //Redireciona para a página de autenticação
  header('location:login.php');
}


$arquivo='Relatorio_ofertas_Campo.xls';

$html='';
$html.='<table border="1">';
$html.='<tr>';
$html.='</tr>';

$html.='<tr>';
$html.='<td><b>Valor</b></td>';
$html.='<td><b>Responsavel</b></td>';
$html.='<td><b>Congregação</b></td>';
$html.='<td><b>Data Oferta</b></td>';
$html.='</tr>';

//Selecionar todos os itens da tabela 
    require_once '../db/config.php';
          
    $total =0;
          $sql ="SELECT COUNT(*) as c FROM ofertas";
          $sql = $pdo->query($sql);
          $sql = $sql->fetch();
          $total = $sql['c'];      
       
		  $sql = "SELECT * FROM ofertas ";
		  $sql = $pdo->query($sql);
		
		if ($sql->rowCount() > 0) {
            # code...
            foreach ($sql->fetchAll() as  $linhas) {
    # code...
			$html .= '<tr>';			
			$html .= '<td>'.$linhas["valor"].'</td>';
			$html .= '<td>'.$linhas["responsavel"].'</td>';
			$html .= '<td>'.$linhas["congregacao"].'</td>';    
          	$data = date('d/m/Y H:i:s');
			$html .= '<td>'.$data.'</td>';
			$html .= '</tr>';
			;
		}

// Configurações header para forçar o download
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");
		header("Content-type: application/x-msexcel");
		header("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header("Content-Description: PHP Generated Data" );
		// Envia o conteúdo do arquivo
		
    echo $html;
 ?>	

<?php
  }
 

 ?> 