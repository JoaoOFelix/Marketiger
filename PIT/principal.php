<?php

if (!isset($_SESSION)) {
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
            height: 300vh;
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

        .mais-novos {
            width: 100%;
            margin: 0 auto;
            background-color: #F7F7F8;
            padding: 15px;
        }

        .produtos {
            display: flex;
            overflow-x: scroll;
            white-space: nowrap;
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

    //Busca dos 3 últimos
    $sqlRecentes = "SELECT * FROM produtos ORDER BY id DESC";
    $resultadoRecentes = $conn->query($sqlRecentes);

    if ($resultadoRecentes->num_rows > 0) {
        // Inicializar variáveis para armazenar os 3 últimos itens
        $item1 = null;
        $item2 = null;
        $item3 = null;
        $item4 = null;

        // Iterar sobre os resultados e armazenar em variáveis
        $i = 1;
        while ($linha = $resultadoRecentes->fetch_assoc()) {
            if ($i == 1) {
                $item1 = $linha;
            } elseif ($i == 2) {
                $item2 = $linha;
            } elseif ($i == 3) {
                $item3 = $linha;
            } elseif ($i == 4) {
                $item4 = $linha;
            }

            $i++;
        }
    }

    //Criar o comando
    $sql = "SELECT * FROM produtos WHERE id = 5";

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
            <a href="index.php" class="btn btn-primary">Sair</a>
        </div>

    </header>



    <br>


    <section class="mais-novos">

        <div class="titulo">
            <h2>Mais Novos</h2>
        </div>

        <div class="produtos">

            <?php

            $sql = "SELECT * FROM produtos ORDER BY id DESC";
            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {

                // Iterar sobre os resultados e exibi-los
                while ($produto = $resultado->fetch_assoc()) {

            ?>

                    <div class="card m-3">

                        <img src="https://http2.mlstatic.com/D_NQ_NP_886529-MLB31846836118_082019-F.jpg" class="card-img-top" alt="produto">

                        <div class="card-body">

                            <h5 class="card-title"><?php echo $produto['produto'] ?> <span class="badge text-bg-secondary">Novo</span></h5>

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


    <section class="mais-novos">
            
    </section>





</body>

</html>