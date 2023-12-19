<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Destrói a sessão
    session_destroy();

    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    // Redireciona para a página de autenticação
    header('location:../login.php');
    exit;
}

require '../../db/config.php';

if (isset($_POST['datasaida']) && !empty($_POST['datasaida'])) {
    $datasaida      = addslashes($_POST['datasaida']);
    $valor          = addslashes($_POST['valor']);
    $responsavel    = addslashes($_POST['responsavel']);
    $congregacao    = addslashes($_POST['congregacao']);
    $descricao      = addslashes($_POST['descricao']); 
    

        $sql = "INSERT INTO saidas(datasaida,valor,responsavel,congregacao,descricao)
                VALUES ('$datasaida','$valor','$responsavel','$congregacao','$descricao')";
        
        if ($pdo->exec($sql)) {
            echo "
                <script type=\"text/javascript\">
                    alert(\"Saída lançado com  sucesso.\");
                    window.location.href = '../saidas/tela_cadastro.php';
                </script>
            ";
        } else {
            echo "
                <script type=\"text/javascript\">
                    alert(\"Lançamento de saída não realizado.\");
                    window.location.href = '../saidas/tela_cadastro.php';
                </script>
            ";
        }
    } 
?>