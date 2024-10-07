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

$id_item = $_POST['id_item'];
$comentario = $_POST['comentario'];

$Cadastro->inserir_comentario($id_item, $comentario);


header("Location: ../view/perfil.php?id_perfil=$id_item");
