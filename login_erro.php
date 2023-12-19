<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SECRETARIA ON LINE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/tela_login.css">
    
</head>
<body>

    <header>
       <h1>SECRETARIA ON LINE</h1>
       <nav></nav>
    </header>   

    <section class="content-center">
        <div class="text-center">
        <a href="" target="blank"><img src="imagens/img_carteira/ADTC2 VERMELHO.png" alt="logo do CodigoQuatro"></a>
        </div>

        <form action="seguranca.php" method="POST" class="text-center" id="form-login">

            <div>
                <input type="text" name="nome" id="nome" placeholder="Digite da sua congregacao" required>
            </div>
            <div>
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
            </div>
            <div>
                <button type="submit" class="btn btn-outline-secondary" >Enviar</button>
            </div>
        </form>

    </section>


    </section>

    <footer>
       <h2><i class="fas fa-exclamation-triangle text-warning">Senha ou Login estão incorretos !</i></h2>
    </footer>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>   
 <script src="js/script.js"></script>   
</body>
</html>