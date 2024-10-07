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

$user = $_POST['usuario'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$senha = $_POST['senha'];
$foto = $_POST['foto'];

$Cadastro->update_perfil($user, $email, $telefone, $senha, $foto);


header("Location: ../view/editarperfil.php?id_perfil=$id_perfil");