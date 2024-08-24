<?php 
require('conexao.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die("Você não está logado.<p><a href='index.php'>Logar</a></p>");
}

//id do produto
$id_produto = $_POST['id'];
$id_perfil = $_POST['perfil'];


$descricao = $_POST['descricao'];
$material = $_POST['material'];
$tamanho = $_POST['tamanho'];
$condicao = $_POST['condicao'];
$foto = $_POST['foto'];


$sqlPerfil = "SELECT * FROM produtos WHERE id = $id_produto AND id_usuario = $id_perfil";
$resultado = $conn->query($sqlPerfil);

if($resultado->num_rows == 1){
    $sqlUpdate = "UPDATE `produtos` SET `descricao` = '$descricao',
        `material` = '$material',
        `tamanho` = '$tamanho',
        `condicao` = '$condicao',
        `link-img` = '$foto'
        WHERE `produtos`.`id` = $id_produto;";

    $conn->query($sqlUpdate);

    echo "Produto alterado com sucesso!";
}







header("Location: produto.php?id=$id_produto");
?>



