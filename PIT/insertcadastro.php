<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Market Tiger</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap');
    body {
      font-family: "Rajdhani", sans-serif;
      font-weight: 600;
    }
  </style>
</head>

<body>
    <?php
    //dados de conexao
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "marketiger";

    //Conectar ao banco de dados
    try {
        $conn = new mysqli($hostname, $username, $password, $database);
    } catch (Exception $e) {
        die("Erro ao conectar:" . $e->getMessage());
    }

    //recebendo variaveis do formulario
    $user = $_POST['usuario'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
   

    if (empty($user) || empty($email) || empty($telefone) || empty($senha)):
    ?>
        <div class="alert alert-warning" role="alert">
            Dados nao podem ficar vazios!
        </div>
    <?php
    else :


        //Criar o comando
        $sqlSelect = "SELECT * FROM cadastro WHERE usuario = '$user'";

        $sqlInsert = "INSERT INTO cadastro VALUES(NULL, '$user', '$email', '$telefone', '$senha')";

        

        //executar o comando
        $resultado = $conn->query($sqlSelect);
        $quantidade = $resultado->num_rows;

        if($quantidade == 0){

            $resultado = $conn->query($sqlInsert);
            ?>
                <div class="alert alert-success" role="alert">
                    Cadastro feito com sucesso!
                </div>

            <?php

        } else {
        ?>

            <div class="alert alert-danger" role="alert">
            Erro ao cadastrar! Usuário já existe.
            </div>

            <a href="cadastro.php" class="btn btn-outline-primary">Voltar</a>

        <?php } ?>

    <?php endif; ?>

    <a href="index.php" class="btn btn-outline-primary">Início</a>

</body>

</html>