<?php
include('conexao.php');

if(!isset($_SESSION)){
    session_start();
  }

  $usuario = $_POST['usuariologin'];

  $senha = $_POST['usuariosenha'];

  

  //Criar o comando
  $sql = "SELECT * FROM cadastro WHERE usuario = '$usuario' AND senha = '$senha'";

  //executar o comando
  $resultado = $conn->query($sql);

  $quantidade = $resultado->num_rows;

  if($quantidade == 1){

  $user = $resultado->fetch_assoc();

  

  $_SESSION['id'] = $user['id'];
  $_SESSION['usuario'] = $user['usuario'];

  header("Location: principal.php");

} else {
 
?>

<div class="alert alert-danger" role="alert">
  Falha ao logar! E-mail ou senha incorretos. <a href="cadastro.php" class="alert-link">Cadastre-se aqui!</a>
</div>

<?php
}
?>