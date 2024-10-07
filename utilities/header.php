<?php

if (isset($_SESSION['carrinho'])){
    $itens_carrinho = count($_SESSION['carrinho']);
}


$imgPerfil = $Cadastro->foto_cadastro($_SESSION['id']);

?>
<header class="cabecalho">

    <div>
        <h1><a href="principal.php">LOGO</a></h1>
    </div>

    <form action="busca.php" method="GET" class="row g-2 alinha-busca">
        <div class="col-auto">
            <input type="text" name="busca" class="form-control" id="input-busca" placeholder="Buscar" value="<?php echo (isset($busca)) ? $busca : '' ?>">
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    <div class="login">

        <div class="carrinho">
            <a href="carrinho.php" type="button" class="btn btn-success position-relative">
                Carrinho
                <?php 
                if (isset($_SESSION['carrinho'])){
                    if ($itens_carrinho > 0 ){ ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger not-carrinho">
                            <?= $itens_carrinho ?>
                        </span>
                        <?php
                        } 
                }
                
                ?>
            </a>
        </div>


        <a class="btn btn-danger" href="cadastroproduto.php">Anunciar</a>

        <div class="dropdown">
            <button class="btn btn-secondary" type="button" id="botaoperfil" data-bs-toggle="dropdown">
                <img src="<?php
                            if (!empty($imgPerfil['linkFoto'])) {
                                echo $imgPerfil['linkFoto'];
                            } else {
                                echo "../resources/images/no-user.png";
                            }
                            ?>
                " alt="">
            </button>

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="editarperfil.php">Editar perfil</a></li>
                <li><a class="dropdown-item" href="perfil.php?id_perfil=<?php echo $id_usuario ?>">Ver perfil</a></li>
                <li><a class="dropdown-item" href="favoritos.php">Favoritos</a></li>
                <li class="btn-sair"><a href="../utilities/logout.php" class="dropdown-item">Sair</a></li>
            </ul>
        </div>

    </div>

</header>