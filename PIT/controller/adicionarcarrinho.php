<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
}

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}
$id_usuario = $_SESSION['id'];



//Adiciona
$id_produto = $_POST['id_produto'];

//$carrinho = $_SESSION['carrinho'];

if (!in_array($id_produto, $_SESSION['carrinho'])) {
    array_push($_SESSION['carrinho'], $id_produto);
}


var_dump($_SESSION['carrinho']);

header("Location: ../view/carrinho.php");
