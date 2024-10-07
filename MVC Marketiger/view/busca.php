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

$busca = $_GET['busca'];
$ordem = "";

//Url
$urlAtual = basename($_SERVER['PHP_SELF']) . '?' . "busca=$busca";

if (isset($_GET['pag'])){
    $pagina = $_GET['pag'];
} else {
    $pagina = 1;
}

//Número de produtos
$numProdutos = $Cadastro->numero_produto($busca);
$qnt_pagina = ceil($numProdutos / 20);



if (isset($_GET['pag'])) {
    $pagina = $_GET['pag'];

    $curr_page = $pagina;
    $prev_page = $pagina - 1;
    $next_page = $pagina + 1;

    $curr_page = $pagina;
    if ($curr_page == 1) {
        $prev_page = 1;
        $curr_page = 2;
        $next_page = 3;
    }
} else {
    $pagina = 1;
    $prev_page = 1;
    $curr_page = 2;
    $next_page = 3;
}

if (isset($_GET['pag'])) {
    if ($_GET['pag'] > $qnt_pagina) {
        $curr_page = $pagina - 1;
        $prev_page = $pagina - 2;
        $next_page = $pagina;
    }
    if ($qnt_pagina == 0) {
        $prev_page = 1;
        $next_page = 1;
    }
}



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
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>

    <!-- Cabeçalho -->
    <?php include('../utilities/header.php') ?>

    <!-- Resultados -->
    <section class="ordenar">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-filter"></i> Ordenar por: <span id="btn-ordem"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item ordena-item" href="" onclick="searchProducts('novo')">Mais novos</a></li>
                <li><a class="dropdown-item ordena-item" href="" onclick="searchProducts('alfa')">Alfabética</a></li>
                <li><a class="dropdown-item ordena-item" href="" onclick="searchProducts('conf')">Confiabilidade</a></li>
            </ul>
        </div>
    </section>


    <!-- RESULTADOS -->
    <section class="resultados">

        <div>
            <h2>Resultados (<?= $numProdutos ?>) </h2>
        </div>

        <!-- Cards de produtos -->
        <div class="produtos" id="produto">

        </div>

    </section>


    <!-- Paginação -->

    <div class="paginacao">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="<?= $urlAtual . "&pag=" . 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php
                if ($qnt_pagina >= $qnt_pagina && $qnt_pagina != 0) { ?>

                    <li class="page-item back-1">
                        <a class="page-link 
                        <?php if ($pagina == $prev_page) {
                            echo "active";
                        } ?>" href="<?= $urlAtual . "&pag=" . $prev_page ?>"><?= $prev_page ?></a>
                    </li>

                <?php }

                if ($qnt_pagina >= $curr_page && $qnt_pagina != 0) {
                ?>
                    <li class="page-item current-1">
                        <a class="page-link 
                        <?php if ($pagina == $curr_page) {
                            echo "active";
                        } ?>" href="<?= $urlAtual . "&pag=" . $curr_page ?>"><?= $curr_page ?></a>
                    </li>
                <?php }

                if ($qnt_pagina >= $next_page || $qnt_pagina == 0) { ?>
                    <li class="page-item next-1">
                        <a class="page-link 
                    <?php if ($pagina == $next_page) {
                        echo "active";
                    } ?>" href="<?= $urlAtual . "&pag=" . $next_page ?>"><?= $next_page ?></a>
                    </li>

                <?php } ?>

                <li class="page-item">
                    <a class="page-link" href="<?= $urlAtual . "&pag=" . $qnt_pagina ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    function preventDefaultAction(event) {
        event.preventDefault(); // Previne o comportamento padrão do link
    }

    // Adiciona o evento de clique a todos os links com a classe 'prevent-link'
    window.onload = function() {
        var links = document.querySelectorAll('.ordena-item');
        links.forEach(function(link) {
            link.addEventListener('click', preventDefaultAction);
        });
    };


    function searchProducts(ordem) {

        let list = document.getElementsByClassName("ordena-item")

        switch (ordem) {
            case 'alfa':
                list[1].classList.add("selecionaOrdem")
                list[0].classList.remove("selecionaOrdem")
                list[2].classList.remove("selecionaOrdem")
                document.getElementById('btn-ordem').textContent = "Alfabética";


                break;

            case 'conf':
                list[0].classList.remove("selecionaOrdem")
                list[2].classList.add("selecionaOrdem")
                list[1].classList.remove("selecionaOrdem")
                document.getElementById('btn-ordem').textContent = "Confiabilidade";


                break;

            case 'novo':
            default:
                list[1].classList.remove("selecionaOrdem")
                list[2].classList.remove("selecionaOrdem")
                list[0].classList.add("selecionaOrdem")
                document.getElementById('btn-ordem').textContent = "Mais novos";

                break;
        }



        var pagina = "<?= $pagina; ?>";
        var busca = "<?= $busca; ?>";
        var orderBy = ordem;
        $.ajax({

            url: '../controller/selectbusca.php',
            type: 'GET',
            data: {
                busca: busca,
                pagina: pagina,
                ordenar_por: orderBy,
                ajax: 1
            },
            success: function(response) {
                $("#produto").html(response);
            }
        });
    }
    searchProducts('<?= $_SESSION['ordem']; ?>');
</script>

</html>