<?php
include('conexao.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die("Você não está logado.<p><a href='index.php'>Logar</a></p>");
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Market Tiger</title>
    <link rel="stylesheet" href="css/cabecalho.css">
    <link rel="stylesheet" href="css/principal.css">
    

</head>

<body>

    <?php

    $id_usuario = $_SESSION['id'];
    $usuario = $_SESSION['usuario'];

    $busca;

    //Busca dos mais recentes
    $sqlRecentes = "SELECT * FROM produtos ORDER BY id DESC LIMIT 6";
    $resultadoRecentes = $conn->query($sqlRecentes);


    //Busca dos mais confiaveis
    $sqlConf = "SELECT * FROM produtos ORDER BY confiabilidade DESC LIMIT 8";
    $resultadoConf = $conn->query($sqlConf);


    ?>

    <header class="cabecalho">

        <div>
            <h1><a href="principal.php">LOGO</a></h1>
        </div>

        <form action="busca.php" method="GET" class="row g-2 alinha-busca">
            <div class="col-auto">
                <input type="text" name="busca" class="form-control" id="input-busca" placeholder="Bola de...">
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <div class="login">

            <a class="btn btn-danger" href="cadastroproduto.php">Anunciar</a>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Opções
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li class="btn-sair"><a href="logout.php" class="dropdown-item">Sair</a></li>
                </ul>
            </div>
            
        </div>

    </header>



    <section class="mais-novos">

        <div class="titulo">
            <h2>Mais Novos</h2>
        </div>

        <div class="produtos">

            <?php

            if ($resultadoRecentes->num_rows > 0) {
                $i = 1;
                // Iterar sobre os resultados e exibi-los
                while ($produto = $resultadoRecentes->fetch_assoc()) {

            ?>

                    <div class="card m-3">

                        <img src="<?php echo $produto['link-img'] ?>" class="card-img-top" alt="produto">

                        <div class="card-body">

                            <h5 class="card-title"><?php echo $produto['produto'] ?> <?php
                                                                                        if ($i <= 3) {
                                                                                        ?>
                                    <span class="badge text-bg-danger">Novo</span>
                                <?php
                                                                                        }
                                ?>
                            </h5>

                            <p class="card-text"><?php echo $produto['descricao'] ?></p>

                            <a href="produto.php?id=<?php echo $produto['id'] ?>" class="btn btn-primary">Ver Produto</a>
                        </div>
                    </div>

            <?php

                    $i++;
                }
            } else {
                echo "Nenhum produto encontrado.";
            }
            ?>
        </div>


    </section>



    <section class="mais-novos">

        <div class="titulo">
            <h2>Mais Confiáveis</h2>
        </div>

        <div class="produtos">

            <?php

            if ($resultadoConf->num_rows > 0) {
                $i = 1;
                // Iterar sobre os resultados e exibi-los
                while ($produto = $resultadoConf->fetch_assoc()) {

            ?>

                    <div class="card m-3">

                        <img src="<?php echo $produto['link-img'] ?>" class="card-img-top" alt="produto">

                        <div class="card-body">

                            <h5 class="card-title"><?php echo $produto['produto'] ?> <?php
                                                                                        if ($i <= 3) {
                                                                                        ?>
                                    <span class="badge text-bg-success">Mais Confiável</span>
                                <?php
                                                                                        }
                                ?>
                            </h5>

                            <p class="card-text"><?php echo $produto['descricao'] ?></p>

                            <a href="produto.php?id=<?php echo $produto['id'] ?>" class="btn btn-primary">Ver Produto</a>
                        </div>
                    </div>

            <?php

                    $i++;
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