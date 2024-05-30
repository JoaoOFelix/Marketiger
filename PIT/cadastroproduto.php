<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die("Você não está logado");
}


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
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
            margin-top: 120px;
        }
    </style>
</head>
<body>

    <form action="insertproduto.php" method="post" class="needs-validation" novalidate>

        <div id="principal">
            <h1 class="title">Cadastrar Produto</h1>
            <div>
                <label for="inputNome">Nome do Produto</label>
                <input type="text" name="produto" class="form-control" id="inputNome" required>
            </div>

            <div>
                <label for="inputDescricao">Descrição do produto</label>
                <textarea class="form-control" name="descricao" id="inputDescricao" rows="3"></textarea>
            </div>

            <div>
                <label for="inputMaterial">Material do produto</label>
                <input type="text" name="material" class="form-control" id="inputMaterial">
            </div>

            <div>
                <label for="inputTamanho">Tamanho do produto</label>
                <input type="text" name="tamanho" class="form-control" id="inputTamanho">
            </div>

            <div>
                <label for="inputLink">Link da imagem</label>
                <input type="text" name="img" class="form-control" id="inputLink">
            </div>

            <div>
                <button type="submit" class="btn btn-success mt-3" onclick="validacaoForm()">Cadastrar produto</button>
                <a href="principal.php" class="btn btn-danger mt-3">Voltar</a>
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