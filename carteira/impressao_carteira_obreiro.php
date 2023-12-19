<?php
session_start();
if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    // Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    // Redireciona para a página de autenticação
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Identificação</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="css/carteira_obreiro.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
    <style>
        @media print {
            .hide-on-print {
                display: none;
            }

            .print-text {
                position: absolute;
                z-index: 1; /* Coloca o texto na frente da imagem */
            }
        }
    </style>
    <nav style="margin-left:50px;">
        <a href="#" onclick="window.print();" style="text-decoration:none;">
            <p id="texto_imprimir"><?php echo rand(1, 10) . "   |  " . "Imprimir"; ?></p>
        </a>
    </nav>

    <?php
    require_once "../db/config.php";

    $matricula = isset($_GET['matricula']) ? $_GET['matricula'] : "";
    $nome = isset($_GET['nome']) ? $_GET['nome'] : "";

    $sql = "SELECT * FROM filiado";

    if (!empty($matricula) && !empty($nome)) {
        $sql .= " WHERE matricula = '$matricula' AND nome LIKE '$nome%'";
    } elseif (!empty($matricula)) {
        $sql .= " WHERE matricula = '$matricula'";
    } elseif (!empty($nome)) {
        $sql .= " WHERE nome LIKE '$nome%'";
    }

    $sql = $pdo->query($sql);

    if ($sql->rowCount() > 0) {
        foreach ($sql->fetchAll() as $linhas) {
    ?>
            <div class="container">
                <div id="img_fundo" class="">
                    <img id="frente_card" onclick="trocar()" src="../carteira/imagens/carteira_obreiro.png" alt="">
                </div>
                <div class="class row">
                    <div id="nome" class="col-12-sm"><strong><p style="text-align:center"><?php echo $linhas['nome']; ?></p></strong></div>
                    <div id="data_Consagracao" class="col-12-sm"><p style="text-align:center"><?php echo date("d/m/Y", strtotime($linhas['data_Consagracao'])); ?></p></div>
                    <div id="documento" class="col-12-sm"><p style="text-align:center"><?php echo $linhas['documento']; ?></p></div>
                    <div id="dataNascimento" class="col-12-sm"><p style="text-align:center"><?php echo date("d/m/Y", strtotime($linhas['dataNascimento'])); ?></p></div>
                    <div id="dataBatismo" class="col-12-sm"><p style="text-align:center"><?php echo date("d/m/Y", strtotime($linhas['dataBatismo'])); ?></p></div>
                    <div id="estadoCivil" class="col-12-sm"><p style="text-align:center"><?php echo $linhas['estadoCivil']; ?></p></div>
                    <div id="mae" class="col-12-sm"><p style="text-align:left"><?php echo $linhas['mae']; ?></p></div>
                    <div id="pai" class="col-12-sm"><p style="text-align:left"><?php echo $linhas['pai']; ?></p></div>
                </div>
                <div class="class row">
                    <div id="matricula" class="col-4-sm"><strong><p style="text-align:center"><?php echo $linhas['matricula']; ?></p></strong></div>
                    <div id="nome_carteira" class="col-12-sm"><strong><p style="text-align:center"><?php echo $linhas['nome_carteira']; ?></p></strong></div>
                    <div id="funcao" class="col-12-sm"><strong><p style="text-align:center"><?php echo strtoupper($linhas['funcao']); ?></p></strong></div>
                    <div id="congregacao" class="col-12-sm"><strong><p style="text-align:center"><?php echo $linhas['congregacao']; ?></p></strong></div>
                </div>
                <div id="foto" class="circle">
                    <img id="img_foto" src="../imagens/<?php echo $linhas['arquivo']; ?>">
                </div>
            </div>
        <?php
        }
    } else {
        // Não foram encontrados filiados com os critérios especificados
        // Você pode exibir uma mensagem apropriada aqui.
    }
    ?>
    <!-- jQuery -->
    <script>
        var currentImgIndex = 1;
        var ImgSrcArray = [ //caminho das suas imgs aqui
            '../carteira/imagens/carteira_obreiro.png',
        ];

        function trocar() {

            if (currentImgIndex == ImgSrcArray.length) //reseta quando o contatador for igual ao tamanho da array e volta a 1° img
            {
                currentImgIndex = 0;
            }
            document.getElementById("frente_card").src = ImgSrcArray[currentImgIndex]; //altera a img do elemento "bomdia" de acordo com o indice
            currentImgIndex++; // incrementa a nossa referencia

        }
    </script>
    
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
</body>

</html>
