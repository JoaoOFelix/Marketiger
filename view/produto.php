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


if (isset($_GET['id'])) {
    $id_produto = intval($_GET['id']);
}


$item = $Cadastro->select_produto($id_produto);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Produto</title>

    <link rel="stylesheet" href="../resources/css/produto.css">
    <link rel="stylesheet" href="../resources/css/cabecalho.css">
</head>

<body>


    <!-- Cabeçalho -->
    <?php include('../utilities/header.php') ?>


    <!-- Conteudo principal -->
    <main>

        <div class="favoritar">
            <form action="../controller/favoritar.php" method="post">
                <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">
                <input type="hidden" name="id_produto" value="<?= $id_produto ?>">
                <input type="submit" value="Favoritar" class="btn btn-secondary">
            </form>

        </div>


        <?php
        if ($id_usuario == $item['id_usuario']) { ?>
            <div class="btn-produto dropdown">
                <button class="btn" type="button" data-bs-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
                    </svg>
                </button>

                <ul class="dropdown-menu">

                    <li><a class="dropdown-item" href="editarproduto.php?id=<?= $id_produto ?>">Editar produto</a></li>

                    <li class="btn-sair"><button onclick="deletarProduto()" class="dropdown-item">Excluir produto</button></li>
                </ul>
            </div>
        <?php }
        ?>


        <section class="text-center">
            <img src="<?= $item['link-img'] ?>"
                class="rounded"
                onerror="this.src='images/no-image.svg'">
        </section>

        <section class="infos">
            <div>
                <h1>
                    <?= $item['produto'] ?>
                </h1>
            </div>

            <p>
                <?= $item['descricao'] ?>
            </p> <br>



            <div class="confiabilidade">
                <span>
                    Confiabilidade:
                </span>

                <div class="progressbar-back">
                    <div class="progressbar-color">

                    </div>
                </div>

                <span class="conf-value"><b><?= $item['confiabilidade'] ?>%</b></span>
            </div>

            <span>
                Material: <b><?= $item['material'] ?></b>
            </span><br>

            <span>
                Tamanho: <b><?= $item['tamanho'] ?></b>
            </span><br>

            <span>
                Condição do produto: <b><?= $item['condicao'] ?></b>
            </span><br>

            <span>
                Preço estimado: <b><?= 'R$' . $item['preco'] ?></b>
            </span><br>


            <span>
                Anunciante: <a href="perfil.php?id_perfil=<?= $item['id_usuario'] ?>"><?= $item['anunciante'] ?> </a>
            </span> <br> <br>

            <form action="../controller/adicionarcarrinho.php" method="POST">
                <input type="hidden" name="id_produto" value="<?= $id_produto ?>">
                <input type="submit" class="btn btn-success" name="tipo" value="Adicionar ao carrinho">
            </form>
        </section>

    </main>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Script barra de progresso -->
<!-- https://stackoverflow.com/questions/42477756/build-semi-circle-progress-bar-with-round-corners-and-shadow-in-java-script-and -->
<!-- <script src="https://rawgit.com/kimmobrunfeldt/progressbar.js/1.0.0/dist/progressbar.js"></script> -->

<script>
    const colorBar = document.getElementsByClassName('progressbar-color')[0];
    var confiabilidade = "<?= $item['confiabilidade'] ?>";


    colorBar.style.width = `${confiabilidade}%`


    function deletarProduto() {
        var txt;
        if (confirm("Tem certeza que quer deletar?")) {
            window.location.assign("../controller/deleteproduto.php?id=<?= $id_produto ?>&perfil=<?= $id_usuario ?>");
        } else {
            window.alert("Ação cancelada!")

        }

    }
</script>

</html>