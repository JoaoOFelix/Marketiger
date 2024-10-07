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

$id_comentario = $_POST['valor'];
$id_perfil = $_POST['id_perfil'];


$Cadastro->deletar_comentarios($id_comentario);

header("Location: ../view/perfil.php?id_perfil=$id_perfil");