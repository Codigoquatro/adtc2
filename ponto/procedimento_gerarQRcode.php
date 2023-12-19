<?php
// Gere um nome único para a sessão com base no timestamp atual
$sessionName = 'sess_' . time();

// Inicie a sessão antes de qualquer saída
session_name($sessionName);
session_start();

// Verifica se a sessão está ativa
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Destrói a sessão
    session_destroy();

    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    // Regenera o ID da sessão para evitar fixação de sessão
    session_regenerate_id(true);

    // Redireciona para a página de autenticação
    header('Location: ../login.php', true, 302);
    exit;
}
// Verifica se os dados do formulário foram enviados
if (isset($_POST['matricula']) && !empty($_POST['matricula'])) {
    $matricula = addslashes($_POST['matricula']);
    $nome = addslashes($_POST['nome']);
}

// Pasta onde o arquivo será salvo
$pasta = 'img_qrcode/';

// Gera o QR code
require_once 'qrcode/qrlib.php';

// Dados para o QR code (ajuste conforme necessário)
$qrData = "Matrícula: $matricula\nNome: $nome";

// Verifica se o diretório existe, senão cria
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/adtc2/ponto/' . $pasta)) {
    mkdir($_SERVER['DOCUMENT_ROOT'] . '/adtc2/ponto/' . $pasta, 0755, true);
}

// Caminho completo para o arquivo QR code
$nomeArquivo = time() . '_' . $nome . '.png'; // Adicionei o nome para torná-lo mais único
$caminhoCompleto = $_SERVER['DOCUMENT_ROOT'] . '/adtc2/ponto/' . $pasta . $nomeArquivo;

// Verifica se o arquivo já existe
while (file_exists($caminhoCompleto)) {
    // Se existir, renomeia adicionando "_repetido" ao nome do arquivo
    $nomeArquivo = time() . '_' . $nome . '_repetido.png';
    $caminhoCompleto = $_SERVER['DOCUMENT_ROOT'] . '/adtc2/ponto/' . $pasta . $nomeArquivo;
}

// Gera o QR code e salva como imagem
try {
    QRcode::png($qrData, $caminhoCompleto, QR_ECLEVEL_L, 5);

    // QR code gerado com sucesso
    echo "
        <script type=\"text/javascript\">
            alert(\"QR code gerado com sucesso!\");
            window.location.href = 'tela_cadastro.php';
        </script>
    ";
} catch (Exception $e) {
    // Captura exceção e exibe mensagem de erro
    echo "
        <script type=\"text/javascript\">
            alert(\"Erro ao gerar QR code: " . $e->getMessage() . "\");
            window.location.href = 'tela_cadastro.php';
        </script>
    ";
}
?>






