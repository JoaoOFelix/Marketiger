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
            margin: 30px;
            font-family: "Rajdhani", sans-serif;
            font-weight: 600;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        #principal {
            width: 600px;
            margin: 0 auto;
        }

        .title {
            margin-top: 200px;
        }
    </style>
</head>
<body>
    <div class="title">
        <h1 class="text-center">Market Tiger</h1>
    </div>
    
    <form action="login.php" method="post" class="needs-validation" novalidate>
        <div id="principal">

            <div>
                <label for="inputUsuario">Usuário</label>
                <input type="text" name="usuariologin" class="form-control" id="inputUsuario" required>
            </div>

            <div>
                <label for="inputSenha">Senha</label>
                <input type="password" name="usuariosenha" class="form-control" id="inputSenha" required>
            </div>

            <div>

                <button type="submit" class="btn btn-outline-primary mt-3" onclick="validacaoForm()">Login</button>
            
                <a href="cadastro.php" class="btn btn-outline-primary mt-3">Cadastrar</a>
            </div>

        </div>
        
    </form>

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

    }

</script>
</html>