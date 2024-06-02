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

    $item = $resultado->fetch_assoc();;
    ?>


<header class="cabecalho">

<div>
    <h1><a href="principal.php">LOGO</a></h1>
</div>

<form action="busca.php" method="GET" class="row g-2 alinha-busca">
    <div class="col-auto">
        <input type="text" name="busca" class="form-control" id="input-busca" placeholder="Bola de...">
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</form>

<div class="login">

    <a class="btn btn-danger" href="cadastroproduto.php">Anunciar</a>

    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Opções
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li class="btn-sair"><a href="logout.php" class="dropdown-item">Sair</a></li>
        </ul>
    </div>
    
</div>

</header>

    <main>
        <section class="text-center">
            <img src="<?php echo $item['link-img'] ?>" class="rounded" alt="...">
        </section>

        <section>
            <div>
                <h1>
                    <?php echo $item['produto'] ?>
                </h1>
            </div>

            <h3>Confiabilidade: <b> <?php echo $item['confiabilidade'] ?>%</b> </h3>

            <p>
                <?php echo $item['descricao'] ?>
            </p> <br>



            <span>
                Material: <?php echo $item['material'] ?>
            </span><br>

            <span>
                Tamanho: <?php echo $item['tamanho'] ?>
            </span><br>

            <span>
                Condição do produto: <?php echo $item['condicao'] ?>
            </span><br>

            <span>
                Anunciante: <?php echo $item['anunciante'] ?>
            </span>
        </section>

    </main>


</body>
<script>
</script>

</html>