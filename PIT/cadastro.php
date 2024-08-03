<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Market Tiger</title>
    <link rel="stylesheet" href="css/cadastro.css">
</head>

<body>



    <main>

        <div class="title">
            <h1 class="text-center">Criar uma nova conta</h1>
            <p class="text-center">Você ja tem login? Clique em entrar</p>
        </div>

        <div class="cadastro">
            <form action="insertcadastro.php" method="post" class="needs-validation" novalidate>
                <div id="principal">

                    <div>
                        <label for="inputUsuario">Usuário</label>
                        <input type="text" name="usuario" class="form-control" id="inputUsuario"  maxlength="12"required>
                    </div>

                    <div>
                        <label for="inputEmail">E-mail</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" required>
                    </div>

                    <div>
                        <label for="telefone">Telefone</label>
                        <input type="tel" name="telefone" class="form-control" id="telefone" maxlength="15" oninput="mascara_telefone()" required>
                    </div>

                    <div>
                        <label for="inputSenha">Senha</label>
                        <input type="password" name="senha" class="form-control" id="inputSenha" maxlength="12" required>
                    </div>
                </div>

                <div class="buttons">
                    <button type="submit" onclick="validacaoForm()" class="btn btn-outline-primary mt-3">Cadastrar</button>

                    <a href="index.php" class="btn btn-outline-primary mt-3">Voltar</a>
                </div>
            </form>
        </div>
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

    }




    function mascara_telefone(){
    var tel = document.getElementById("telefone").value

    tel = tel.slice(0,14)

    document.getElementById("telefone").value = tel

    var tel_formatado = document.getElementById("telefone").value

    if(tel_formatado[0] != "("){

        if(tel_formatado[0] != undefined){
            document.getElementById("telefone").value = "(" + tel_formatado[0]
        }
    }

    if(tel_formatado[3] != ")"){
        
        if(tel_formatado[3] != undefined){
            document.getElementById("telefone").value=tel_formatado.slice(0,3) + ")" + tel_formatado[3]
        }
    }

    if(tel_formatado[9] != "-"){
        if(tel_formatado[9] != undefined){
            document.getElementById("telefone").value = tel_formatado.slice(0,9) + "-" + tel_formatado[9]
        }
    }

}




</script>

</html>