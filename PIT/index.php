<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Market Tiger</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

    <!-- Erro login -->
    <div class="erro-login"></div>


    <!-- Conteúdo principal -->
    <main>

        <div class="title">
            <h1 class="text-center">Market Tiger</h1>
        </div>


        <!-- Login Form -->
        <form class="login" action="login.php" method="post" class="needs-validation" novalidate>
            <div id="principal">

                <div>
                    <label for="inputUsuario">Usuário</label>
                    <input type="text" name="usuariologin" class="form-control" id="inputUsuario" required>
                </div>

                <div>
                    <label for="inputSenha">Senha</label>
                    <input type="password" name="usuariosenha" class="form-control" id="inputSenha" required>
                </div>
            </div>

            <div class="buttons">

                <button type="button" class="btn btn-outline-primary mt-3" onclick="validacaoForm()">Login</button>

                <a href="cadastro.php" class="btn btn-outline-primary mt-3">Cadastrar</a>
            </div>

        </form>

    </main>

</body>
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



        //AJAX
        let login = document.getElementById("inputUsuario").value
        let senha = document.getElementById("inputSenha").value
        $.ajax({

            url: 'login.php', // Mesma página
            type: 'POST',
            data: {
                usuariologin: login,
                usuariosenha: senha,
                ajax: 1
            },
            success: function(response) {
                if(response == "sucesso"){
                    window.location.href = "principal.php";
                } else {
                    $(".erro-login").html(response);
                }
            }
        });
    }

</script>
</html>