<?php

include('conexao.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die("Você não está logado");
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Market Tiger</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap');
        body {
            margin: 20px;
            font-family: "Rajdhani", sans-serif;
            font-weight: 600;
        }
    </style>
</head>

<body>
   
<?php
    //recebendo variaveis do formulario
    $produto = $_POST['produto'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $material = $_POST['material'];
    $tamanho = $_POST['tamanho'];
    $condicao = $_POST['condicao'];
    $imagem = $_POST['img'];


    $anunciante = $_SESSION['usuario'];
    $id_usuario = $_SESSION['id'];


    $confiabilidade = 0;
  
   
    if(!empty($produto)){
        $confiabilidade += 5;
    }
    if(!empty($descricao)){
        $confiabilidade += 5;
    }
    if(!empty($categoria)){
        $confiabilidade += 5;
    }
    if(!empty($material)){
        $confiabilidade += 3;
    }
    if(!empty($tamanho)){
        $confiabilidade += 3;
    }
    if(!empty($condicao)){
        $confiabilidade += 5;
    }
    if(!empty($imagem)){
        $confiabilidade += 10;
    }


    
 if (empty($produto)):
    ?>
        <div class="alert alert-warning" role="alert">
            Dados nao podem ficar vazios!
        </div>
    <?php
    else :


        //Criar o comando
        $sql = "INSERT INTO produtos VALUES(
            NULL,
            '$id_usuario',
            '$anunciante',
            '$confiabilidade',
            '$produto',
            '$descricao',
            '$categoria',
            '$material',
            '$tamanho',
            '$condicao',
            '$imagem')";

        //executar o comando
        $resultado = $conn->query($sql);

    ?>
        <?php if ($resultado) : ?>
            <div class="alert alert-success" role="alert">
                Dado inserido com sucesso!
            </div>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                Erro ao inserir o dado!
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <a href="principal.php" class="btn btn-outline-primary">Início</a>


</body>

</html>