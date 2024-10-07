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


$id_produto = $_GET['id'];
$id_perfil = $_GET['perfil'];



$Cadastro->delete_produto($id_produto, $id_perfil);




header("Location: ../view/perfil.php?id_perfil=$id_perfil");