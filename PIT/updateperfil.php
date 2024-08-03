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

$user = $_POST['usuario'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$senha = $_POST['senha'];
$foto = $_POST['foto'];



$sqlSelect = "SELECT * FROM cadastro WHERE usuario = '$user'";




$resultadoBusca = $conn->query($sqlSelect);
$quantidade = $resultadoBusca->num_rows;

if ($quantidade == 1){

    $idTemp = $resultadoBusca->fetch_assoc();
    //echo "Um com o mesmo nome";

    if($idTemp['id'] == $id_usuario){
        //echo "Um alterando outra infos";
        
        atualizarCadastro();
        ?> <a href="editarperfil.php">Voltar</a>  <?php
    } else {
    
        echo "O nome de usuário já está em uso.";
    }
} else if($quantidade == 0){
    //echo "Nenhum com esse nome";
    atualizarCadastro();
}



function atualizarCadastro(){

    global $user;
    global $email;
    global $telefone;
    global $senha;
    global $foto;
    global $id_usuario;
    global $conn; 

    $sqlUpdate = "UPDATE `cadastro` SET `usuario` = '$user',
        `email` = '$email',
        `telefone` = '$telefone',
        `senha` = '$senha',
        `linkFoto` = '$foto'
        WHERE `cadastro`.`id` = $id_usuario;";
        $_SESSION['usuario'] = $user;
        $conn->query($sqlUpdate);
        echo "Dados alterados com sucesso.";
}




?>