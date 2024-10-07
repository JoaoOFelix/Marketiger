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

    $perfil_id = $_GET['id_perfil'];
}

//Informações do perfil
$perfil = $Cadastro->perfil($perfil_id);

//Foto de perfil (Comentários)
$fotoPerfil = $Cadastro->foto_cadastro($perfil_id);

//Comentários do perfil
$comentado = $Cadastro->selecionar_comentarios($perfil_id);

//Produtos do perfil
$produtos_user = $Cadastro->produtos_perfil($perfil_id);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../resources/css/perfil.css">
    <link rel="stylesheet" href="../resources/css/cabecalho.css">
    <link rel="stylesheet" href="../resources/fontawesome/css/all.min.css">
</head>

<body>

    <!-- Cabeçalho -->
    <?php include('../utilities/header.php') ?>



    <section id="principal">
        <div class="titulo">
            <h2><b><?= $perfil['usuario'] ?></b></h2>
        </div>


        <div class="formulario">

            <div class="foto-perfil">
                <img src="<?php

                            if (!empty($perfil['linkFoto'])) {
                                echo $fotoPerfil['linkFoto'];
                            } else {
                                echo "../resources/images/no-user.png";
                            }

                            ?>" alt="">
            </div>

            <div>
                <label for="nome">Nome</label>
                <input class="form-control" type="text" value="<?= $perfil['usuario'] ?>" id="nome" disabled readonly>
            </div>

            <div>
                <label for="email">E-mail</label>
                <input class="form-control" type="text" value="<?= $perfil['email'] ?>" id="email" disabled readonly>
            </div>

            <div>
                <label for="telefone">Telefone</label>
                <input class="form-control" type="text" value="<?= $perfil['telefone'] ?>" id="telefone" disabled readonly>
            </div>
        </div>

    </section>


    <section class="resultados">

        <div>
            <h2>Produtos de <b><?= $perfil['usuario'] ?></b></h2>
        </div>

        <div class="produtos" id="produto">
            <?php

            if ($produtos_user->num_rows > 0) {
                $i = 1;
                // Iterar sobre os resultados e exibi-los
                while ($produto = $produtos_user->fetch_assoc()) {

            ?>

                    <div class="card m-3">

                        <picture>
                            <img src="<?= $produto['link-img'] ?>"
                                class="card-img-top"
                                onerror="this.src='images/no-image.svg'">
                        </picture>

                        <div class="card-body">

                            <h5 class="card-title">
                                <?= $produto['produto'] ?>
                                <?php
                                if ($i <= 3) {
                                    echo "<span class='badge text-bg-danger'>Novo</span>";
                                }
                                ?>
                            </h5>

                            <p class="card-text"><?= $produto['descricao'] ?></p>

                            <a href="produto.php?id=<?= $produto['id'] ?>" class="btn btn-primary">Ver Produto</a>
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

    <!-- ---------------------------------------------comentarios-------------------------------------------------- -->

    <section class="comentarios">

        <div>
            <h3>Comentários do Perfil</h3>
        </div>

        <div class="comentario" id="comen">
            <?php

            if ($comentado->num_rows > 0) {
                // Iterar sobre os resultados e exibi-los
                while ($comentario = $comentado->fetch_assoc()) {

            ?>
                    <hr>
                    <div class="div-com">
                        <div class="perfil-comentario">
                            <a href="perfil.php?id_perfil=<?= $comentario['id_comentador'] ?>" class="foto-comentario">
                                <img src="
                                <?php

                                if (!empty($comentario['linkFoto'])) {
                                    echo $comentario['linkFoto'];
                                } else {
                                    echo "images/no-user.png";
                                }

                                ?>">
                            </a>
                            <h4><?= $comentario['usuario'] ?></h4>
                        </div>

                        <div class="texto-comentario">
                            <p><?= $comentario['comentario'] ?></p>


                            <?php if ($comentario['id_comentador'] == $id_usuario || $perfil_id == $id_usuario) { ?>

                                <form action="../controller/deletecomment.php" method="POST">
                                
                                    <input type="hidden" name="id_perfil" value="<?= $perfil_id ?>">
                                    
                                    <button class="btn-excluir" type="submit" name="valor" value="<?= $comentario['id'] ?>">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                    
                                </form>
                            <?php } ?>
                        </div>



                    </div>


            <?php
                }
            } else {
                echo "Nenhum comentário ainda...";
            }
            ?>
        </div>

        <form action="../controller/comentario.php" method="post">

            <div>
                <input type="hidden" name="id_item" value="<?= $perfil_id ?>">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Comente aqui" id="floatingTextarea" name="comentario"></textarea>
                    <label for="floatingTextarea">Comentário</label>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Comentar</button>
            </div>
        </form>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>
