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

if (isset($_POST['dataOferta']) && !empty($_POST['dataOferta'])) {
    $dataOferta      = addslashes($_POST['dataOferta']);
    $valor           = addslashes($_POST['valor']);
    $responsavel     = addslashes($_POST['responsavel']);  
    $congregacao     = addslashes($_POST['congregacao']);
     
           
  
        $sql = "INSERT INTO ofertas(dataOferta,valor,responsavel,congregacao)
                VALUES ('$dataOferta','$valor','$responsavel','$congregacao')";
        
        if ($pdo->exec($sql)) {
            echo "
                <script type=\"text/javascript\">
                    alert(\"Oferta lançado com  sucesso.\");
                    window.location.href = 'tela_cadastro.php';
                </script>
            ";
        } else {
            echo "
                <script type=\"text/javascript\">
                    alert(\"Oferta  não realizado.\");
                    window.location.href = 'tela_cadastro.php';
                </script>
            ";
        }
    } 
?>