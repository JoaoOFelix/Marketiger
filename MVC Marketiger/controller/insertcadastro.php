<?php
include '../model/Conexao.class.php';
include '../model/Manager.class.php';
$Cadastro = new Cadastro();

//recebendo variaveis do formulario
$user = $_POST['usuario'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$senha = $_POST['senha'];


if (empty($user) || empty($email) || empty($telefone) || empty($senha)) {
?>
    <div class="alert alert-warning" role="alert">
        Preencha todos os campos!
    </div>
    <?php
} else {


    $resultado = $Cadastro->insert_cadastro($_POST);

    if ($resultado == "sucesso") {

        echo "sucesso";

    } else {

    ?><div class="alert alert-danger" role="alert">Usuário já existe!</div>
<?php
    }
}
