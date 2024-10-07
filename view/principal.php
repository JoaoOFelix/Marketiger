<?php
include '../model/Conexao.class.php';
include '../model/Manager.class.php';
$Cadastro = new Cadastro();

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
} else {
    $id_usuario = $_SESSION['id'];
    $usuario = $_SESSION['usuario'];
}


$resultadoRecentes = $Cadastro->busca_principal('recentes');
$resultadoConf = $Cadastro->busca_principal('confiaveis');

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Market Tiger</title>
    <link rel="stylesheet" href="../resources/css/cabecalho.css">
    <link rel="stylesheet" href="../resources/css/principal.css">
    

</head>

<body>

    <!-- Cabeçalho -->
    <?php include('../utilities/header.php') ?>


    <!-- Produtos mais novos -->
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
                        
                        <picture>
                            <img src="<?php echo $produto['link-img'] ?>" class="card-img-top">
                        </picture>
                        

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
                        
                        <picture>
                            <img src="<?php echo $produto['link-img'] ?>" class="card-img-top" alt="produto">
                        </picture>

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