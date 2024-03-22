<?php
session_start();
require '../../db/config.php';

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Destrói
    session_destroy();
    // Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    // Redireciona para a página de autenticação
    header('location: login.php');
    exit; // Encerre o script após a redireção
}

$arquivo = 'Dizimos.xls';

// Configurações header para forçar o download
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/x-msexcel");
header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
header("Content-Description: PHP Generated Data");

$html = '';
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<td colspan="11">Dizimos</td>';
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

// Inicializa um array para armazenar a soma dos valores por congregação e mês
$sumByCongregationAndMonth = [];
// Inicializa um array para armazenar a soma dos valores por dia
$sumByDay = [];

// Selecionar todos os itens da tabela
$data_inicio = date('Y-m-d', strtotime($_GET['data_inicio']));
$data_fim = date('Y-m-d', strtotime($_GET['data_fim']));
$congregacao = isset($_GET['congregacao']) ? $_GET['congregacao'] : '';

if ($congregacao === "Alves" || $congregacao === "Marcos") {
    $sql = "SELECT * FROM dizimo WHERE dataCaptura BETWEEN '$data_inicio' AND '$data_fim'";
    $sql = $pdo->query($sql);
} else {
    $sql = "SELECT * FROM dizimo WHERE congregacao='$congregacao' AND dataCaptura BETWEEN '$data_inicio' AND '$data_fim'";
    $sql = $pdo->query($sql);
}

if ($sql->rowCount() > 0) {
    foreach ($sql->fetchAll() as $linhas) {
        $html .= '<tr>';
        $html .= '<td>' . $linhas["id_dizimo"] . '</td>';
        $html .= '<td>' . $linhas["nome"] . '</td>';
        $html .= '<td>' . $linhas["congregacao"] . '</td>';
        $html .= '<td>R$ ' . number_format($linhas['valor'], 2, ',', '.') . '</td>'; // Formatando para Reais
        $html .= '<td>' . $linhas["responsável"] . '</td>';
        $html .= '<td>' . date("d/m/Y", strtotime($linhas["dataCaptura"])) . '</td>';
        $html .= '</tr>';

        // Obter o mês e o ano da dataCaptura
        $mesAno = date("Y-m", strtotime($linhas["dataCaptura"]));
        // Obter o dia da dataCaptura
        $dia = date("Y-m-d", strtotime($linhas["dataCaptura"]));

        // Inicializar a soma do mês para a congregação se ainda não estiver definida
        if (!isset($sumByCongregationAndMonth[$linhas["congregacao"]][$mesAno])) {
            $sumByCongregationAndMonth[$linhas["congregacao"]][$mesAno] = 0;
        }

        // Adicionar o valor do item à soma da congregação e do mês correspondente
        $sumByCongregationAndMonth[$linhas["congregacao"]][$mesAno] += $linhas["valor"];

        // Inicializar a soma do dia se ainda não estiver definida
        if (!isset($sumByDay[$dia])) {
            $sumByDay[$dia] = 0;
        }

        // Adicionar o valor do item à soma do dia correspondente
        $sumByDay[$dia] += $linhas["valor"];

        // Atualizar a soma geral
        $totalGeral += $linhas['valor'];
    }
}

$html .= '</table>';

// Exibir a tabela HTML
echo $html;

// Exibir a soma por congregação e mês
echo '<br><br><h2>Soma dos Valores por Congregação e Mês:</h2>';
echo '<table border="1">';
echo '<tr><td><b>Congregação</b></td><td><b>Mês</b></td><td><b>Soma</b></td></tr>';

foreach ($sumByCongregationAndMonth as $congregation => $sumsByMonth) {
    foreach ($sumsByMonth as $mesAno => $soma) {
        echo '<tr>';
        echo '<td>' . $congregation . '</td>';
        echo '<td>' . date("M", strtotime($mesAno . '-01')) . '</td>';
        echo '<td>R$ ' . number_format($soma, 2, ',', '.') . '</td>'; // Formatando para Reais
        echo '</tr>';
    }
}

echo '</table>';

// Exibir a soma por dia
echo '<br><br><h2>Soma dos Valores por Dia:</h2>';
echo '<table border="1">';
echo '<tr><td><b>Dia</b></td><td><b>Soma</b></td></tr>';

foreach ($sumByDay as $dia => $soma) {
    echo '<tr>';
    echo '<td>' . date("d/m/Y", strtotime($dia)) . '</td>';
    echo '<td>R$ ' . number_format($soma, 2, ',', '.') . '</td>'; // Formatando para Reais
    echo '</tr>';
}

echo '</table>';

// Exibir a soma geral
echo '<br><h2>Soma Geral:</h2>';
echo '<p>R$ ' . number_format($totalGeral, 2, ',', '.') . '</p>'; // Formatando para Reais
?>


