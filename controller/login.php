<?php
include '../model/Conexao.class.php';
include '../model/Manager.class.php';
$Cadastro = new Cadastro();

if (!isset($_SESSION)) {
  session_start();
}

$resultado = $Cadastro->entrar_conta($_POST);
if ($resultado == "sucesso") {

  echo $resultado;

} else {
?>
  <div class="alert alert-danger erro-cadastro" role="alert">
    Erro ao logar. Usuário ou senha incorretos.
  </div>
 <?php 
}
