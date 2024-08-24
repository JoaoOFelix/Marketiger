<?php
include('conexao.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die("Você não está logado.<p><a href='index.php'>Logar</a></p>");
}


$id_usuario = $_SESSION['id'];


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}



//Criar o comando
$sql = "SELECT * FROM produtos WHERE id = $id";

//executar o comando
$resultado = $conn->query($sql);

$item = $resultado->fetch_assoc();


if ($_SESSION['id'] != $item['id_usuario']) {
    die("Você não pode alterar produtos de outros usuários.<p><a href='principal.php'>Voltar</a></p>");
}


?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Produto</title>

    <link rel="stylesheet" href="css/editarproduto.css">
    <link rel="stylesheet" href="css/cabecalho.css">
</head>

<body>

    <!-- Cabeçalho -->
    <?php include('header.php') ?>

    <form action="updateproduto.php" method="POST">
    <input hidden name="id" value="<?php echo $id?>">
    <input hidden name="perfil" value="<?php echo $id_usuario?>">

        <main>

            <section class="text-center">
                <img id="nova-img" src="<?php echo $item['link-img'] ?>" class="rounded" alt="...">
            </section>

            <section class="infos">
                <div>
                    <h1>
                        <?php echo $item['produto'] ?>
                    </h1>
                </div>

                <textarea class="form-control" name="descricao"><?php echo $item['descricao'] ?></textarea> <br>


                <span>
                    Material: <input type="text" class="form-control" name="material" value="<?php echo $item['material'] ?>">
                </span><br>

                <span>
                    Tamanho: <input type="text" class="form-control" name="tamanho" value="<?php echo $item['tamanho'] ?>">
                </span><br>

                <span>
                    Condição do produto: <input type="text" class="form-control" name="condicao" value="<?php echo $item['condicao'] ?>">
                </span><br>

                <span>
                    Link da imagem: <input type="text" id="link" class="form-control" onchange="atualizafoto()" name="foto" value="<?php echo $item['link-img']?>">
                </span><br>

                <div style="margin: 0 auto;">
                    <input type="submit" class="btn btn-primary" value="Atualizar">
                    <a href="produto.php?id=<?php echo $id ?>" class="btn btn-primary">Voltar</a>
                </div>
            </section>

        </main>

        
    </form>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    const novaFoto = document.getElementById("nova-img")
    var link
function atualizafoto(){
    link = document.getElementById("link").value

    novaFoto.src = link
}


</script>
</html>