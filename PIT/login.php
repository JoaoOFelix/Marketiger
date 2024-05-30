<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <title>Dados</title>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap');

    body{
      font-family: "Rajdhani", sans-serif ; 
      font-weight: 600;
    }
  </style>

</head>

<body>
<?php

  $hostname = "localhost";
  $username = "root";
  $password = "";
  $database = "marketiger";

  $usuario = $_POST['usuariologin'];

  $senha = $_POST['usuariosenha'];


  //Conectar ao banco de dados
  try {
    $conn = new mysqli($hostname, $username, $password, $database);
  } catch (Exception $e) {
    die("Erro ao conectar:" . $e->getMessage());
  }
  

  //Criar o comando
  $sql = "SELECT * FROM cadastro WHERE usuario = '$usuario' AND senha = '$senha'";

  //executar o comando
  $resultado = $conn->query($sql);

  $quantidade = $resultado->num_rows;

  if($quantidade == 1){

  $user = $resultado->fetch_assoc();

  if(!isset($_SESSION)){
    session_start();
  }

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

</body>

</html>