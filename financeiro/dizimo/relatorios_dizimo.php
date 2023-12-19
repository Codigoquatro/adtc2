<?php
session_start();
require '../../db/config.php';

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Redireciona para a página de autenticação
    header('Location: login.php');
    exit; // Importante: saia do script após o redirecionamento
}

require '../../vendor/autoload.php'; // Certifique-se de que o caminho para o arquivo do DomPDF esteja correto

use Dompdf\Dompdf;
use Dompdf\Options;

// Crie um novo objeto Dompdf com as opções
$options = new Options();
$options->set('isPhpEnabled', true); // Permite que o PHP seja executado no HTML
$pdf = new Dompdf($options);

// Defina o título do documento PDF
$pdf->getOptions()->set('title', 'Relatório de Dízimos');

$html = '';
$html .= '<!DOCTYPE html>';
$html .= '<html>';
$html .= '<head>';
$html .= '<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>';
$html .= '</head>';
$html .= '<body>';
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<td colspan="6"><b>Relatório de Dízimos</b></td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td><b>Transação</b></td>';
$html .= '<td><b>Nome</b></td>';
$html .= '<td><b>Congregação</b></td>';
$html .= '<td><b>Valor</b></td>';
$html .= '<td><b>Responsável</b></td>';
$html .= '<td><b>Data de Lançamento</b></td>';
$html .= '</tr>';

// Inicializa uma variável para rastrear a soma geral de todos os valores
$totalGeral = 0;

// Inicializa um array para armazenar a soma dos valores por mês
$sumByMonth = [];

// Inicializa um array para armazenar a soma dos valores por congregação
$sumByCongregation = [];

// Validar e filtrar dados de entrada
$data_inicio = isset($_GET['data_inicio']) ? date('Y-m-d', strtotime($_GET['data_inicio'])) : null;
$data_fim = isset($_GET['data_fim']) ? date('Y-m-d', strtotime($_GET['data_fim'])) : null;
$congregacao = isset($_GET['congregacao']) ? filter_input(INPUT_GET, 'congregacao', FILTER_SANITIZE_STRING) : '';

// Use declaração preparada para evitar SQL injection
if ($congregacao === "Alves" || $congregacao === "Marcos") {
    $sql = $pdo->prepare("SELECT * FROM dizimo WHERE dataCaptura BETWEEN :data_inicio AND :data_fim");
    $sql->bindParam(':data_inicio', $data_inicio, PDO::PARAM_STR);
    $sql->bindParam(':data_fim', $data_fim, PDO::PARAM_STR);
    $sql->execute();
} else {
    $sql = $pdo->prepare("SELECT * FROM dizimo WHERE congregacao=:congregacao AND dataCaptura BETWEEN :data_inicio AND :data_fim");
    $sql->bindParam(':congregacao', $congregacao, PDO::PARAM_STR);
    $sql->bindParam(':data_inicio', $data_inicio, PDO::PARAM_STR);
    $sql->bindParam(':data_fim', $data_fim, PDO::PARAM_STR);
    $sql->execute();
}

if ($sql->rowCount() > 0) {
    foreach ($sql->fetchAll() as $linhas) {
        $html .= '<tr>';
        $html .= '<td>' . $linhas["id_dizimo"] . '</td>';
        $html .= '<td>' . $linhas["nome"] . '</td>';
        $html .= '<td>' . $linhas["congregacao"] . '</td>';
        $html .= '<td>' . number_format($linhas['valor'], 2, '.', '.') . '</td>';
        $html .= '<td>' . $linhas["responsavel"] . '</td>';
        $html .= '<td>' . date("d/m/Y", strtotime($linhas["dataCaptura"])) . '</td>';
        $html .= '</tr>';

        // Obter o mês e o ano da dataCaptura
        $mesAno = date("Y-m", strtotime($linhas["dataCaptura"]));

        // Inicializar a soma do mês se ainda não estiver definida
        if (!isset($sumByMonth[$mesAno])) {
            $sumByMonth[$mesAno] = 0;
        }

        // Inicializar a soma da congregação se ainda não estiver definida
        if (!isset($sumByCongregation[$linhas["congregacao"]])) {
            $sumByCongregation[$linhas["congregacao"]] = 0;
        }

        // Adicionar o valor do item à soma do mês correspondente
        $sumByMonth[$mesAno] += $linhas["valor"];

        // Adicionar o valor do item à soma da congregação correspondente
        $sumByCongregation[$linhas["congregacao"]] += $linhas["valor"];

        // Atualizar a soma geral
        $totalGeral += $linhas["valor"];
    }
}

$html .= '</table>';
$html .= '<br>';

// Adicionar uma tabela para mostrar a soma por congregação
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<th>Congregação</th>';
$html .= '<th>Mês</th>'; // Adicionar o cabeçalho do mês
$html .= '<th>Total</th>';
$html .= '</tr>';

foreach ($sumByCongregation as $congregacao => $total) {
    foreach ($sumByMonth as $mesAno => $mesTotal) {
        $mes = date("M", strtotime($mesAno . '-01'));
        $html .= '<tr>';
        $html .= '<td>' . $congregacao . '</td>';
        $html .= '<td>' . $mes . '</td>';
        $html .= '<td>' . number_format($mesTotal, 2, '.', '.') . '</td>';
        $html .= '</tr>';
    }
}

$html .= '</table>';
$html .= '<br>';

$html .= '<p>Total Geral: ' . number_format($totalGeral, 2, '.', '.') . '</p>';

// Defina um nome de arquivo para o PDF temporário
$pdfFilename = 'relatorio_dizimos.pdf';

// Carregue o HTML no Dompdf
$pdf->loadHtml($html);

// Renderize o PDF
$pdf->render();

// Defina o cabeçalho para indicar que é um arquivo PDF para download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $pdfFilename . '"');

// Envie o PDF para o navegador
echo $pdf->output();

// Exclua o arquivo temporário
unlink($pdfFilename);
?>

