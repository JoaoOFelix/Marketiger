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


$infos_usuario = [];
$infos_produto = [];

//id do produto
$id_produto = $_POST['id'];
$id_perfil = $_POST['perfil'];


$infos_produto[0] = $id_produto;
$infos_produto[1] = $_POST['descricao'];
$infos_produto[2] = $_POST['material'];
$infos_produto[3] = $_POST['tamanho'];
$infos_produto[4] = $_POST['condicao'];
$infos_produto[5] = $_POST['foto'];


$resultado = $Cadastro->update_produto($id_perfil, $infos_produto);


header("Location: ../view/editarproduto.php?id=$id_produto");