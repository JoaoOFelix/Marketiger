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
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Produto</title>

    <link rel="stylesheet" href="css/produto.css">
    <link rel="stylesheet" href="css/cabecalho.css">
</head>

<body>
    <?php
    $id_usuario = $_SESSION['id'];


    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
    }



    //Criar o comando
    $sql = "SELECT * FROM produtos WHERE id = $id";

    //executar o comando
    $resultado = $conn->query($sql);

    $item = $resultado->fetch_assoc();
    ?>


    <!-- Cabeçalho -->
    <?php include('header.php') ?>


    <!-- Conteudo principal -->
    <main>

        <?php
        if ($id_usuario == $item['id_usuario']) { ?>
            <div class="btn-produto dropdown">
                <button class="btn" type="button" data-bs-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
                    </svg>
                </button>

                <ul class="dropdown-menu">
                    
                    <li><a class="dropdown-item" href="editarproduto.php?id=<?php echo $id ?>">Editar produto</a></li>

                    <li class="btn-sair"><button onclick="deletarProduto()" class="dropdown-item">Excluir produto</button></li>
                </ul>
            </div>
        <?php }
        ?>


        <section class="text-center">
            <img src="<?php echo $item['link-img'] ?>"
             class="rounded"
             onerror="this.src='images/no-image.svg'">
        </section>

        <section class="infos">
            <div>
                <h1>
                    <?php echo $item['produto'] ?>
                </h1>
            </div>

            <p>
                <?php echo $item['descricao'] ?>
            </p> <br>



            <div class="confiabilidade">
                <span>
                    Confiabilidade:
                </span>

                <div class="progressbar-back">
                    <div class="progressbar-color">

                    </div>
                </div>

                <span class="conf-value"><b><?php echo $item['confiabilidade'] ?>%</b></span>
            </div>

            <span>
                Material: <b><?php echo $item['material'] ?></b>
            </span><br>

            <span>
                Tamanho: <b><?php echo $item['tamanho'] ?></b>
            </span><br>

            <span>
                Condição do produto: <b><?php echo $item['condicao'] ?></b>
            </span><br>



            <span>
                Anunciante: <a href="perfil.php?id_perfil=<?php echo $item['id_usuario'] ?>"><?php echo $item['anunciante'] ?> </a>
            </span>
        </section>

    </main>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Script barra de progresso -->
<!-- https://stackoverflow.com/questions/42477756/build-semi-circle-progress-bar-with-round-corners-and-shadow-in-java-script-and -->
<!-- <script src="https://rawgit.com/kimmobrunfeldt/progressbar.js/1.0.0/dist/progressbar.js"></script> -->

<script>
    const colorBar = document.getElementsByClassName('progressbar-color')[0];
    var confiabilidade = "<?php echo $item['confiabilidade'] ?>";


    colorBar.style.width = `${confiabilidade}%`


    function deletarProduto() {
        var txt;
        if (confirm("Tem certeza que quer deletar?")) {
            window.location.assign("deleteproduto.php?id=<?php echo $id ?>&perfil=<?php echo $id_usuario ?>");
        } else {
            window.alert("Ação cancelada!")
            
        }
        
    }
</script>

</html>