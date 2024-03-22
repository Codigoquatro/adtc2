<?php
session_start();
require '../db/config.php';

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    header('location: login.php');
    exit;
}

// Selecionar todos os itens da tabela
$data_inicio = date('Y-m-d', strtotime($_GET['data_inicio']));
$data_fim = date('Y-m-d', strtotime($_GET['data_fim']));
$congregacao = isset($_GET['congregacao']) ? $_GET['congregacao'] : '';

if ($congregacao === "Alves" || $congregacao === "Marcos") {
    $sqlDizimo = "SELECT * FROM dizimo WHERE dataCaptura BETWEEN :data_inicio AND :data_fim";
} else {
    $sqlDizimo = "SELECT * FROM dizimo WHERE congregacao=:congregacao AND dataCaptura BETWEEN :data_inicio AND :data_fim";
}

if ($congregacao === "Alves" || $congregacao === "Marcos") {
    $sqlOfertas = "SELECT * FROM ofertas WHERE dataOferta BETWEEN :data_inicio AND :data_fim";
} else {
    $sqlOfertas = "SELECT * FROM ofertas WHERE congregacao=:congregacao AND dataOferta BETWEEN :data_inicio AND :data_fim";
}

$stmtDizimo = $pdo->prepare($sqlDizimo);
$stmtDizimo->bindParam(':data_inicio', $data_inicio);
$stmtDizimo->bindParam(':data_fim', $data_fim);
if ($congregacao !== "Alves" && $congregacao !== "Marcos") {
    $stmtDizimo->bindParam(':congregacao', $congregacao);
}
$stmtDizimo->execute();
$dizimos = $stmtDizimo->fetchAll(PDO::FETCH_ASSOC);

$stmtOfertas = $pdo->prepare($sqlOfertas);
$stmtOfertas->bindParam(':data_inicio', $data_inicio);
$stmtOfertas->bindParam(':data_fim', $data_fim);
if ($congregacao !== "Alves" && $congregacao !== "Marcos") {
    $stmtOfertas->bindParam(':congregacao', $congregacao);
}
$stmtOfertas->execute();
$ofertas = $stmtOfertas->fetchAll(PDO::FETCH_ASSOC);

$totalDizimos = 0;
foreach ($dizimos as $dizimo) {
    $totalDizimos += $dizimo['valor'];
}

$totalOfertas = 0;
foreach ($ofertas as $oferta) {
    $totalOfertas += $oferta['valor'];
}

$totalGeral = $totalDizimos + $totalOfertas;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Resultado</h1>
        <hr>

        <!-- Dízimos -->
        <div class="card mb-4">
            <div class="card-header">
                Dízimos
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Transação</th>
                                <th>Nome</th>
                                <th>Congregação</th>
                                <th>Valor</th>
                                <th>Responsável</th>
                                <th>Data de Lançamento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($stmtDizimo->rowCount() > 0) {
                                foreach ($dizimos as $dizimo) {
                                    echo '<tr>';
                                    echo '<td>' . $dizimo["id_dizimo"] . '</td>';
                                    echo '<td>' . $dizimo["nome"] . '</td>';
                                    echo '<td>' . $dizimo["congregacao"] . '</td>';
                                    echo '<td>R$ ' . number_format($dizimo['valor'], 2, ',', '.') . '</td>';
                                    echo '<td>' . $dizimo["responsavel"] . '</td>';
                                    echo '<td>' . date("d/m/Y", strtotime($dizimo["dataCaptura"])) . '</td>';
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <p class="text-right"><strong>Total Dízimos:</strong> R$ <?php echo number_format($totalDizimos, 2, ',', '.'); ?></p>
            </div>
        </div>

        <!-- Ofertas -->
        <div class="card mb-4">
            <div class="card-header">
                Ofertas
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Transação</th>
                                <th>Data</th>
                                <th>Valor</th>
                                <th>Congregação</th>
                                <th>Responsável</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($stmtOfertas->rowCount() > 0) {
                                foreach ($ofertas as $oferta) {
                                    echo '<tr>';
                                    echo '<td>' . $oferta["id_ofertas"] . '</td>';
                                    echo '<td>' . date("d/m/Y", strtotime($oferta["dataOferta"])) . '</td>';
                                    echo '<td>R$ ' . number_format($oferta['valor'], 2, ',', '.') . '</td>';
                                    echo '<td>' . $oferta["congregacao"] . '</td>';
                                    echo '<td>' . $oferta["responsavel"] . '</td>';
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <p class="text-right"><strong>Total Ofertas:</strong> R$ <?php echo number_format($totalOfertas, 2, ',', '.'); ?></p>
            </div>
        </div>

        <!-- Total Geral -->
        <div class="card">
            <div class="card-header">
                Total Geral
            </div>
            <div class="card-body">
                <p class="text-right"><strong>Total Geral:</strong> R$ <?php echo number_format($totalGeral, 2, ',', '.'); ?></p>
            </div>
        </div>

        <!-- Botão Voltar -->
        <div class="mt-4">
            <a href="../index_tesoureiro.php" class="btn btn-primary btn-block">Voltar</a>
        </div>
    </div>

    <!-- Bootstrap

