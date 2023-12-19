<?php
session_start();
if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    //Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    //Redireciona para a página de autenticação
    header('location:login.php');
}
?>

<?php
require_once "../db/config.php";

// Parâmetros da paginação
$porPagina = 10; // Quantidade de resultados por página
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Página atual, padrão é 1

// Consulta total de registros
$totalRegistros = $pdo->query("SELECT COUNT(*) FROM eventos")->fetchColumn();

// Cálculo para determinar o número total de páginas
$totalPaginas = ceil($totalRegistros / $porPagina);

// Calcula o índice inicial para a consulta
$indiceInicio = ($paginaAtual - 1) * $porPagina;

// Consulta com LIMIT para a paginação
$sql = "SELECT * FROM eventos LIMIT $indiceInicio, $porPagina";
$query = $pdo->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventos ADTC2</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="seu-estilo.css"> <!-- Importe seu arquivo CSS personalizado aqui -->

    <style>
        /* Estilização da tabela */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
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
<div class="container">
    <h1>Eventos ADTC2</h1>
    <a href="tela_cadastro.php">Cadastro</a>
    <hr style="border: 1px solid #008000;">

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Evento</th>
                        <th>Informações</th>
                        <th>Congregação</th>
                        <th>Data Evento</th>
                        <th>Status</th>
                        <th>Alterar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($query->rowCount() > 0) {
                        foreach ($query->fetchAll() as $linhas) {
                            ?>
                            <tr>
                                <td><?php echo $linhas['id']; ?></td>
                                <td><?php echo $linhas['evento']; ?></td>
                                <td><?php echo $linhas['anotacoes']; ?></td>
                                <td><?php echo $linhas['congregacao']; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($linhas['dt_evento'])); ?></td>
                                <td><?php echo $linhas['situacao']; ?></td>

                                <td>
                                    <a href="tela_alterar_eventos.php?id=<?php echo $linhas['id']; ?>"><img
                                            src="../imagens/diversas_imagens/editar.png" width="25" height="20"></a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- Linha 1 -->

    <!-- Paginação -->
    <br>
    <div class="row">
    <div class="col-md-12">
        <ul class="pagination">
            <?php
            for ($pagina = 1; $pagina <= $totalPaginas; $pagina++) {
                echo "<li";
                if ($pagina == $paginaAtual) {
                    echo " class='active'";
                }
                echo "><a href='?pagina=$pagina'>$pagina</a></li>";
            }
            ?>
        </ul>
    </div>
</div><!-- fim do Conteiner_principal -->

<script src="seu-script.js"></script> <!-- Importe seu arquivo JavaScript personalizado aqui -->
</body>
</html>



