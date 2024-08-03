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


$id_item = $_POST['id_item'];
$comentario = $_POST['comentario'];

$sql = "INSERT INTO comentarios VALUES(
    NULL,
    'perfil',
    '$comentario',
    '$id_item',
    '$id_usuario',
    '$usuario')";

$resultado = $conn->query($sql);


header("Location: perfil.php?id_perfil=$id_item");


?>