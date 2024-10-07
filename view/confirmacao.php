<?php
include('conexao.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
}

$id_usuario = $_SESSION['id'];
$usuario = $_SESSION['usuario'];

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Confirmação de pagamento</title>

    <link rel="stylesheet" href="css/confirmacao.css">
    <link rel="stylesheet" href="css/cabecalho.css">

</head>

<body>

    <!-- Cabeçalho -->
    <?php include('header.php') ?>


    <section class="metodo-pagamento">
        <h1>Total: R$<?= $precoPagamento?></h1>

        <div class="pagamento">
            <form action="">
                
                <input type="radio" name="metodo" id="pix">
                <label for="pix">PIX</label><br>

                
                <input type="radio" name="metodo" id="credito">
                <label for="credito">Cartão de crédito</label><br>
                
                <input type="radio" name="metodo" id="boleto">
                <label for="boleto">Boleto bancário</label><br>
            </form>
        </div>
    </section>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</script>
</html>