<?php
include('conexao.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die("Você não está logado.<p><a href='index.php'>Logar</a></p>");
}


$id_usuario = $_SESSION['id'];
$usuario = $_SESSION['usuario'];

$perfil_id = $_GET['id_perfil'];


$sql = "SELECT * FROM cadastro WHERE id = $perfil_id";
$resultado = $conn->query($sql);

$perfil = $resultado->fetch_assoc();


$sql = "SELECT * FROM produtos WHERE id_usuario = $perfil_id ORDER BY id DESC";
$produtos_user = $conn->query($sql);


$selectFoto = "SELECT linkFoto FROM cadastro WHERE id = $perfil_id";
$bole = $conn->query($selectFoto);
$fotoPerfil = $bole->fetch_assoc();

$comentarios = "SELECT comentarios.id,
comentarios.comentario,
comentarios.id_comentador,
cadastro.linkFoto,
cadastro.usuario FROM comentarios JOIN cadastro ON
comentarios.id_comentador = cadastro.id WHERE comentarios.secao = 'perfil' AND comentarios.id_item = $perfil_id";
$comentado = $conn->query($comentarios);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="stylesheet" href="css/cabecalho.css">
</head>

<body>

    <!-- Cabeçalho -->
    <?php include('header.php') ?>





    <section id="principal">
        <div class="titulo">
            <h2><b><?php echo $perfil['usuario'] ?></b></h2>
        </div>


        <div class="formulario">

            <div class="foto-perfil">
                <img src="<?php
                            
                            if (!empty($perfil['linkFoto'])) {
                                echo $fotoPerfil['linkFoto'];
                            } else {
                                echo "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKAyHUwfu-mtzTdTBMpWWBCWbk7YEBTx2GOw&s";
                            }

                            ?>" alt="">
            </div>

            <div>
                <label for="nome">Nome</label>
                <input class="form-control" type="text" value="<?php echo $perfil['usuario'] ?>" id="nome" disabled readonly>
            </div>

            <div>
                <label for="email">E-mail</label>
                <input class="form-control" type="text" value="<?php echo $perfil['email'] ?>" id="email" disabled readonly>
            </div>

            <div>
                <label for="telefone">Telefone</label>
                <input class="form-control" type="text" value="<?php echo $perfil['telefone'] ?>" id="telefone" disabled readonly>
            </div>
        </div>

    </section>


    <section class="resultados">

        <div>
            <h2>Produtos de <b><?php echo $perfil['usuario'] ?></b></h2>
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
                            <img src="<?php echo $produto['link-img'] ?>" class="card-img-top" alt="produto">
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
                            <a href="perfil.php?id_perfil=<?php echo $comentario['id_comentador'] ?>" class="foto-comentario">
                                <img src="<?php

                                            if (!empty($comentario['linkFoto'])) {
                                                echo $comentario['linkFoto'];
                                            } else {
                                                echo "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKAyHUwfu-mtzTdTBMpWWBCWbk7YEBTx2GOw&s";
                                            }

                                            ?>">
                            </a>
                            <h4><?php echo $comentario['usuario'] ?></h4>
                        </div>

                        <div class="texto-comentario">
                            <p><?php echo $comentario['comentario'] ?></p>


                            <?php if ($comentario['id_comentador'] == $id_usuario || $perfil_id == $id_usuario) { ?>

                                <form action="deletecomment.php" method="post">
                                    <input type="hidden" name="id_item" value="<?php echo $perfil_id ?>">
                                    <button class="btn-excluir" type="submit" name="valor" value="<?php echo $comentario['id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                        </svg>
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

        <form action="comentario.php" method="post">


            <div>
                <input type="hidden" name="id_item" value="<?php echo $perfil_id ?>">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="comentario"></textarea>
                    <label for="floatingTextarea">Comentário</label>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Comentar</button>
            </div>
        </form>

    </section>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>