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
$anunciante = $_SESSION['usuario'];

$produto2 = [];
$info_produto = [];
$confiabilidade = 0;

//recebendo variaveis do formulario
$produto = $_POST['produto'];
$descricao = $_POST['descricao'];
$categoria = $_POST['categoria'];
$material = $_POST['material'];
$tamanho = $_POST['tamanho'];
$condicao = $_POST['condicao'];
$preco = $_POST['preco'];
$imagem = $_POST['img'];



if (!empty($produto)) {
    $confiabilidade += 5;
}
if (!empty($descricao)) {
    $confiabilidade += 5;
}
if (!empty($categoria)) {
    $confiabilidade += 5;
}
if (!empty($material)) {
    $confiabilidade += 3;
}
if (!empty($tamanho)) {
    $confiabilidade += 3;
}
if (!empty($condicao)) {
    $confiabilidade += 5;
}
if (!empty($imagem)) {
    $confiabilidade += 10;
}

$produto2[0] = $produto;
$produto2[1] = $descricao;
$produto2[2] = $categoria;
$produto2[3] = $material;
$produto2[4] = $tamanho;
$produto2[5] = $condicao;
$produto2[6] = $preco;
$produto2[7] = $imagem;

$info_produto[0] = $id_usuario;
$info_produto[1] = $anunciante;
$info_produto[2] = $confiabilidade;

if (!empty($produto)){
    
    $usuario = $Cadastro->insert_produto($info_produto, $produto2);

}

header("Location: ../view/principal.php");