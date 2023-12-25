<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leitor de QR Code</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        #preview {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div id="preview"></div>

    <script src="../ponto/instascan.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });


            scanner.addListener('scan', function (content) {
                // Redireciona para o arquivo PHP com o conteúdo lido do QR code
                window.location.href = 'caminho/para/seu/arquivo.php?conteudo=' + encodeURIComponent(content);
            });

            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    console.error('Nenhuma câmera encontrada.');
                    alert('Nenhuma câmera encontrada.');
                }
            }).catch(function (e) {
                console.error(e);
                alert('Erro ao acessar a câmera: ' + e);
            });
        });
    </script>
</body>
</html>
