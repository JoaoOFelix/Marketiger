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

$precoPagamento = $_POST['preco']
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Pagamento</title>

    <link rel="stylesheet" href="css/pagamento.css">
    <link rel="stylesheet" href="css/cabecalho.css">

</head>

<body>

    <!-- Cabeçalho -->
    <?php include('header.php') ?>





    <section class="metodo-pagamento">
        <h1>Total: R$<?= $precoPagamento ?></h1>

        <div class="pagamento">
            <form action="finalizacao" method="post">

                <input type="radio" name="metodo" id="pix" required onclick="creditoo()">
                <label for="pix">PIX</label><br>


                <input type="radio" name="metodo" id="credito" required onclick="creditoo()">
                <label for="credito">Cartão de crédito</label><br>
                <div class="form-cartao">
                    <input type="text" placeholder="Número do cartão" class="full-input">
                    <input type="text" placeholder="Nome no cartão" class="full-input">
                    <input type="text" placeholder="Validade" class="meio-input">
                    <input type="text" placeholder="Código de verificação" class="meio-input">
                </div>

                <input type="radio" name="metodo" id="boleto" required onclick="creditoo()">
                <label for="boleto">Boleto bancário</label><br>

                <button type="submit" class="btn btn-success">Finalizar compra</button>
            </form>
        </div>
    </section>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</script>
<script>
    function creditoo(e) {
        let cartao = document.getElementsByClassName('form-cartao')[0]
        let credit = document.getElementById('credito')

        if (credit.checked) {
            //cartao.style.display = 'block' // Mostra a div
            cartao.classList.add('visivel')
        } else {
            //cartao.style.display = 'none' // Esconde a div
            cartao.classList.remove('visivel')
        }

    }
</script>

</html>