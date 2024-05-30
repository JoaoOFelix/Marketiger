<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die("Você não está logado");
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
            padding: 10px;
            width: 40px;
            aspect-ratio: 1/1;
            border: black 2px solid;
        }

        svg {
            height: 10px;
        }

        .resultados {
            width: 70%;
            margin: 80px auto;
            background-color: #F7F7F8;
            padding: 15px;
        }

        .produtos {
            display: grid;
            white-space: nowrap;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            
            justify-content: start;
        }

        .cartao {
            width: 300px;
            height: 500px;
            margin: 30px 60px;
            background-color: #ACACC8;
            border-radius: 5px;
            border: 1px rgba(0, 0, 0, 0.3) solid;
            display: flex;
            overflow: hidden;
            flex-direction: column;
            align-items: center;
            flex: 0 0 auto;

            box-shadow: 1px 13px 17px -9px rgba(130, 130, 130, 1);
            -webkit-box-shadow: 1px 13px 17px -9px rgba(130, 130, 130, 1);
            -moz-box-shadow: 1px 13px 17px -9px rgba(130, 130, 130, 1);
        }

        .card {
            width: 250px;
            height: 400px;
            flex: 0 0 auto;

            box-shadow: 1px 13px 17px -9px rgba(130, 130, 130, 1);
            -webkit-box-shadow: 1px 13px 17px -9px rgba(130, 130, 130, 1);
            -moz-box-shadow: 1px 13px 17px -9px rgba(130, 130, 130, 1);
        }

        .card-img-top {
            height: 62%;
            width: 100%;
        }

        .card p {
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .cartao>div {
            text-align: center;
        }

        .cartao>.bg-cartao {
            background-image: url("https://http2.mlstatic.com/D_NQ_NP_851120-MLB70085510807_062023-O.webp");
            width: 100%;
            height: 50%;
            z-index: 0;
            background-size: cover;
        }

        .cartao>div>a {
            background-color: #ff8b38;
            text-decoration: none;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all .2s;
        }

        .cartao>div>a:hover {
            color: white;
            background-color: #E17B33;
        }

        section {
            margin-bottom: 100px !important;
        }

        #busca {
            display: flex;
            align-items: center;
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
    $usuario = $_SESSION['usuario'];

    $busca = $_GET['busca'];

    $sql = "SELECT * FROM `produtos` WHERE `produto` LIKE '%$busca%' ORDER BY id DESC";
    $resultado = $conn->query($sql);

    ?>

    <header class="cabecalho">

        <div>
            <h1><a href="principal.php">LOGO</a></h1>
        </div>

        <form action="busca.php" method="get" class="row g-2" id="busca">
            <div class="col-auto">
                <input type="text" name="busca" class="form-control" id="input-busca" placeholder="Bola de..." value="<?php echo $busca ?>">
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <div class="login">
            <a class="btn btn-danger" href="cadastroproduto.php">Anunciar</a>
            <a href="index.php" class="btn btn-primary">Sair</a>
        </div>

    </header>


    <section class="resultados">
        <div>
            <h2>Resultados (<?php echo $resultado->num_rows ?>) </h2>
        </div>
        <div class="produtos">
            <?php

            if ($resultado->num_rows > 0) {

                while ($produto = $resultado->fetch_assoc()) {
            ?>
                    <div class="card m-3">

                        <img src="<?php echo $produto['link-img'] ?>" class="card-img-top" alt="produto">

                        <div class="card-body">

                            <h5 class="card-title"><?php echo $produto['produto'] ?></h5>

                            <p class="card-text"><?php echo $produto['descricao'] ?></p>

                            <a href="produto.php?id=<?php echo $produto['id'] ?>" class="btn btn-primary">Ver Produto</a>
                        </div>
                    </div>

            <?php

                }
            } else {
                echo "Nenhum produto encontrado.";
            }
            ?>
        </div>

    </section>




</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>