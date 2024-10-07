<?php
include '../model/Conexao.class.php';
include '../model/Manager.class.php';
$Cadastro = new Cadastro();

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
}

$id_usuario = $_SESSION['id'];
$usuario = $_SESSION['usuario'];

$favoritos = $Cadastro->select_favoritos($id_usuario);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Market Tiger</title>
    <link rel="stylesheet" href="../resources/css/busca.css">
    <link rel="stylesheet" href="../resources/css/cabecalho.css">
    <link rel="stylesheet" href="../resources/fontawesome/css/all.min.css">

    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>

    <!-- Cabeçalho -->
    <?php include('../utilities/header.php') ?>

    <!-- Resultados -->
    <section class="resultados">

        <div>
            <h2>Resultados (<?= $favoritos->num_rows ?>) </h2>
        </div>
        <!-- Cards de produtos -->
        <div class="produtos" id="produto">
            <?php

            if ($favoritos->num_rows > 0) {
                while ($produto = $favoritos->fetch_assoc()) {

                    $resultado = $Cadastro->select_produto($produto['id_produto'])

            ?>
                    <div class="card m-3">
                        <picture>
                            <img src="<?= $resultado['link-img'] ?>"
                                class="card-img-top"
                                onerror="this.src='images/no-image.svg'">>
                        </picture>

                        <div class="card-body">
                            <h5 class="card-title placeholder-glow"><?= $resultado['produto'] ?></h5>
                            <p class="card-text"><?= $resultado['descricao'] ?></p>
                            <a href="perfil.php?id_perfil=<?= $resultado['id_usuario'] ?>"><?= $resultado['anunciante'] ?></a><br>
                            <a href="produto.php?id=<?= $resultado['id'] ?>" class="btn btn-primary">Ver Produto</a>
                        </div>
                    </div>
            <?php

                }
            } else {
                echo "Nenhum produto favoritado.";
            }
            ?>


        </div>
    </section>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>