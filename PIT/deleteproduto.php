<?php 
require('conexao.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die("Você não está logado.<p><a href='index.php'>Logar</a></p>");
}


$id_produto = $_GET['id'];
$id_perfil = $_GET['perfil'];



$sqlPerfil = "SELECT * FROM produtos WHERE id = $id_produto AND id_usuario = $id_perfil";
$resultado = $conn->query($sqlPerfil);

if($resultado->num_rows == 1){
    $sql = "DELETE FROM `produtos` WHERE `produtos`.`id` = $id_produto";
    $conn->query($sql);
    echo "Produto excluído com sucesso!";
}







header("Location: perfil.php?id_perfil=$id_perfil");
?>



