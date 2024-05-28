<?php

if (!isset($_SESSION)) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Produto</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap');

        body {
            font-family: "Rajdhani", sans-serif;
            font-weight: 600;
            height: 130vh;

            box-sizing: border-box;
            margin: 0;
            padding: 0;
            width: 100%;
            background-color: lightgrey;
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

        main {

            width: 80%;
            height: 600px;
            display: flex;
            margin: 0 auto;
            justify-content: space-evenly;
        }

        section {

            width: 500px;
            height: 400px;
            margin-top: 100px;

        }

        main>.imagem {
            background-image: url("https://http2.mlstatic.com/D_NQ_NP_851120-MLB70085510807_062023-O.webp");

            border: 0px black solid;
        }

        section h1 {
            font-weight: bolder;
            text-transform: uppercase;
            font-size: 2.6em;
        }

        section p {
            font-weight: 400;
            font-size: 1.5em;
        }

        section span {
            font-weight: 700;
            font-size: 1.2em;
        }
    </style>
</head>

<body>

    <?php
    //dados de conexao
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "marketiger";

    //Conectar ao banco de dados
    try {
        $conn = new mysqli($hostname, $username, $password, $database);
    } catch (Exception $e) {
        die("Erro ao conectar:" . $e->getMessage());
    }

    $id_usuario = $_SESSION['id'];

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
    }

    //Criar o comando
    $sql = "SELECT * FROM produtos WHERE id = $id";

    //executar o comando
    $resultado = $conn->query($sql);

    $item = $resultado->fetch_assoc();;

    ?>


    <header class="cabecalho">

        <div>
            <h1>LOGO</h1>
        </div>


        <div class="login">
            <a class="btn btn-danger" href="cadastroproduto.php">Anunciar</a>
            <a href="principal.php" class="btn btn-primary">Menu</a>
        </div>

    </header>

    <main>
        <section class="text-center">
            <img src="https://http2.mlstatic.com/D_NQ_NP_851120-MLB70085510807_062023-O.webp" class="rounded" alt="...">
        </section>

        <section>
            <h1>
                <?php echo $item['produto'] ?>
            </h1> <br>

            <p>
                <?php echo $item['descricao'] ?>
            </p> <br>

            <span>
                Material: <?php echo $item['material'] ?>
            </span><br>

            <span>
                Tamanho: <?php echo $item['tamanho'] ?>
            </span><br>

            <span>
                Anunciante: <?php echo $item['anunciante'] ?>
            </span>
        </section>
    </main>


</body>

</html>