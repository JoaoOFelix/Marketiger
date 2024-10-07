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


$id_usuario = $_POST['id_usuario'];
$id_produto = $_POST['id_produto'];

$Cadastro->favoritar($id_produto, $id_usuario);



header("Location: ../view/favoritos.php");
//header("Location: ../view/produto.php?id=$id_produto");


?>