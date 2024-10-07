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

if (isset($_SESSION['carrinho'])) {
    $carrinho = $_SESSION['carrinho'];
}

//var_dump($carrinho);
if (!is_null($_SESSION['carrinho'])) {
    foreach ($carrinho as $row) {
        $Cadastro->comprar_produto($row);
    }
}


$_SESSION['carrinho'] = [];

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Pedido finalizado!</title>

    <link rel="stylesheet" href="../resources/css/finalizacao.css">
    <link rel="stylesheet" href="../resources/css/cabecalho.css">

</head>

<body>

    <!-- Cabeçalho -->
    <?php include('../utilities/header.php') ?>


    <section class="finalizacao">
        <h1>Pedido Finalizado!</h1>
        <img class="check-img" src="https://cdn-icons-png.flaticon.com/512/5610/5610944.png" alt=""><br>
        <a href="../view/principal.php" class="btn btn-success">Voltar</a>
    </section>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</script>

</html>