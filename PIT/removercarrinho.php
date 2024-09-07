<?php
include('conexao.php');
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    die("Você não está logado.<p><a href='index.php'>Logar</a></p>");
}

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}
$id_usuario = $_SESSION['id'];


//Remover
$id_remove = $_POST['id_remove'];

// Encontrando a chave do valor a ser removido
$chave = array_search($id_remove, $_SESSION['carrinho']);

// Verificando se o valor foi encontrado no array
if ($chave !== false) {
    unset($_SESSION['carrinho'][$chave]);
}

// Reindexando o array para reorganizar as chaves
$_SESSION['carrinho'] = array_values($_SESSION['carrinho']);

var_dump($_SESSION['carrinho']);

header("Location: carrinho.php");