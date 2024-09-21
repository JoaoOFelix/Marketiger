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

if (isset($_SESSION['carrinho'])) {
    $carrinho = $_SESSION['carrinho'];
}

$precoTotal = "0.00";

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/carrinho.css">
    <link rel="stylesheet" href="css/cabecalho.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>

<body>

    <!-- Cabeçalho -->
    <?php include('header.php') ?>



    <!-- Carrinho -->


    <main class="produtos">
        <div class="titulo">
            <h2>Produtos no carrinho (<?php echo isset($_SESSION['carrinho']) ? count($carrinho) : "0" ?>)</h2>
        </div>

        <section class="lista-itens">
            <?php
            if (isset($carrinho)) {
                if (count($carrinho) > 0) {
                    $i = 0;
                    // Iterar sobre os resultados e exibi-los
                    while ($i < count($carrinho)) {

                        $sql = "SELECT * FROM `produtos` WHERE `id` = $carrinho[$i]";
                        $consulta = $conn->query($sql);
                        $produto = $consulta->fetch_assoc();
                        $precoTotal += $produto["preco"];

            ?>
                        <div class="item">
                            <div class="foto-produto">
                                <a href="<?= 'produto.php?id=', $produto["id"] ?>">
                                    <img src="<?php echo $produto['link-img'] ?>"
                                        class="card-img-top"
                                        onerror="this.src='images/no-image.svg'"></a>
                            </div>

                            <div class="descricao">
                                <h2><?php echo $produto['produto'] ?></h2>
                                <p><?php echo $produto['descricao'] ?></p>
                            </div>


                            <div class="infos">
                                <span>Preço: R$<?= $produto['preco'] ?></span>
                                <p>Confiabilidade</p>
                            </div>


                            <div class="botao-remover">
                                <form action="removercarrinho.php" method="POST">
                                    <input type="hidden" name="id_remove" value="<?= $produto['id'] ?>">
                                    <button type="submit" class="lixeira" value="remover" name="tipo">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>

                                </form>
                            </div>
                        </div>

            <?php
                        $i++;
                    }
                } else {
                    echo "Nenhum produto no carrinho.";
                }
            } else {
                echo "Nenhum produto no carrinho.";
            }

            ?>
        </section>

        <section class="pagamento">
            <form action="pagamento.php" method="post">
                <div>
                    <p>Total: R$<?= $precoTotal ?></p>

                    <div>
                        <input type="hidden" name="preco" value="<?= $precoTotal ?>">
                        <button type="submit" class="btn btn-success">Finalizar compra</button>
                    </div>
                </div>
            </form>
        </section>
    </main>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>