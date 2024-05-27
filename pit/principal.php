<?php

if(!isset($_SESSION)){
    session_start();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Market Tiger</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap');
        body {

            font-family: "Rajdhani", sans-serif;
            font-weight: 600;

            
            
            
        }

        .cabecalho {
            background-color: #ff8b38;
            padding: 2vh;
            border-bottom: 2px solid rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: space-between;
        }

        .login {
            width: 40%;
            display: flex;
            justify-content: end;
            align-items: center;
            gap: 10px;

        }

        .perfil {
            background-color: whitesmoke;
            border-radius: 100%;
            padding: 8px 12px;
            border: black 2px solid;
        }

        svg {
            height: 20px;
        }
    </style>
</head>
<body>

    <header class="cabecalho">

        <div>

        </div>

        
        <div class="login">
            <a class="btn btn-danger" href="cadastroproduto.php">Cadastrar produto</a>
            <a href="index.php" class="btn btn-primary">Sair</a>
            <div class="perfil">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>
            </div>
        </div>

    </header>

    <h1>
        Bem vindo ao Painel, <b><?php echo $_SESSION['usuario'];?></b>
    </h1>


</body>
</html>