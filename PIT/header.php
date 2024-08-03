<?php
$fotoHeader = "SELECT linkFoto FROM cadastro WHERE id = $id_usuario";
$bole = $conn->query($fotoHeader);
$imgPerfil = $bole->fetch_assoc();
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

        <a class="btn btn-danger" href="cadastroproduto.php">Anunciar</a>

        <div class="dropdown">
            <button class="btn btn-secondary" type="button" id="botaoperfil" data-bs-toggle="dropdown">
                <img src="<?php 
                if (!empty($imgPerfil['linkFoto'])){
                    echo $imgPerfil['linkFoto'];
                } else {
                    echo "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKAyHUwfu-mtzTdTBMpWWBCWbk7YEBTx2GOw&s";
                }
                ?>
                " alt="">
            </button>

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="perfil.php?id_perfil=<?php echo $id_usuario ?>">Ver perfil</a></li>
                <li><a class="dropdown-item" href="editarperfil.php">Editar perfil</a></li>
                <li class="btn-sair"><a href="logout.php" class="dropdown-item">Sair</a></li>
            </ul>
        </div>
        
    </div>

</header>