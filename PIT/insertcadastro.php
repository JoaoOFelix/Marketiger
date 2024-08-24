<?php
include('conexao.php');

//recebendo variaveis do formulario
$user = $_POST['usuario'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$senha = $_POST['senha'];


if (empty($user) || empty($email) || empty($telefone) || empty($senha)):
?>
    <div class="alert alert-warning" role="alert">
        Preencha todos os campos!
    </div>
    <?php
else :


    //Criar o comando
    $sqlSelect = "SELECT * FROM cadastro WHERE usuario = '$user'";

    $sqlInsert = "INSERT INTO cadastro VALUES(NULL, '$user', '$email', '$telefone', '$senha', NULL)";



    //executar o comando
    $resultado = $conn->query($sqlSelect);
    $quantidade = $resultado->num_rows;

    if ($quantidade == 0) {

        $resultado = $conn->query($sqlInsert);

        echo "sucesso";
    } else {

    ?>
        <div class="alert alert-danger" role="alert">
            Erro ao cadastrar! Usuário já existe.
        </div>
    <?php


    } ?><?php endif ?>