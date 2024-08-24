<?php
include('conexao.php');

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    die("Você não está logado.<p><a href='index.php'>Logar</a></p>");
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Perfil</title>
    <link rel="stylesheet" href="css/cabecalho.css">
    <link rel="stylesheet" href="css/editarperfil.css">
</head>

<body>
    <?php

    $id_usuario = $_SESSION['id'];
    $usuario = $_SESSION['usuario'];

    //Busca dos mais recentes
    $sqlRecentes = "SELECT * FROM cadastro WHERE id = $id_usuario";
    $resultado = $conn->query($sqlRecentes);

    $usuario = $resultado->fetch_assoc();


    ?>

    <!-- Cabeçalho -->
    <?php include('header.php') ?>



    

    <section id="principal">
        <div class="titulo">
            <h2>Bem-vindo <b><?php echo $usuario['usuario'] ?></b></h2>
        </div>

        <div class="foto">
            <img id="nova-img" src="<?php echo $usuario['linkFoto'] ?>" class="rounded" alt="...">
        </div>

        <div class="formulario">
            <form action="updateperfil.php" method="post" class="needs-validation" novalidate>
                <div>

                    <div>
                        <label for="inputUsuario">Usuário</label>
                        <input type="text" name="usuario" class="form-control" id="inputUsuario" value="<?php echo $usuario['usuario'] ?>" required>
                    </div>

                    <div>
                        <label for="inputEmail">E-mail</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" value="<?php echo $usuario['email'] ?>" required>
                    </div>

                    <div>
                        <label for="inputTelefone">Telefone</label>
                        <input type="text" name="telefone" class="form-control" id="inputTelefone" value="<?php echo $usuario['telefone'] ?>" required maxlength="14">
                    </div>

                    <div>
                        <label for="inputSenha">Senha</label>
                        <input type="text" name="senha" class="form-control" id="inputSenha" value="<?php echo $usuario['senha'] ?>" required>
                    </div>

                    <div>
                        <label for="inputFoto">Link da foto de perfil</label>
                        <input id="link" type="text" name="foto" class="form-control" id="inputFoto" onchange="atualizafoto()" value="<?php echo $usuario['linkFoto'] ?>" required>
                    </div>


                    <div class="botoes">
                        <button type="submit" class="btn btn-outline-primary mt-3" onclick="validacaoForm()">Alterar Dados</button>

                        <a href="perfil.php?id_perfil=<?php echo $id_usuario ?>" class="btn btn-outline-primary mt-3">Ver Perfil</a>

                        <a href="principal.php" class="btn btn-outline-primary mt-3">Voltar</a>
                    </div>

                </div>
            </form>
        </div>

    </section>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    function validacaoForm() {

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })

    }

    const novaFoto = document.getElementById("nova-img")
    var link
function atualizafoto(){
    link = document.getElementById("link").value

    novaFoto.src = link
}
</script>
</html>