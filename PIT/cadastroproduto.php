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
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="css/cadastroproduto.css">
    <link rel="stylesheet" href="css/cabecalho.css">
</head>

<body>

    <form action="insertproduto.php" method="post" class="needs-validation" novalidate>

        <div id="principal">
            <h1 class="title">Cadastrar Produto</h1>

            <!-- Barra de confiabilidade -->
            <div class="confiabilidade">
                <span>
                    Confiabilidade:
                </span>

                <div class="progressbar-back">
                    <div class="progressbar-color">

                    </div>
                </div>

                <span class="conf-value"><b>0%</b></span>
            </div>

            <!-- Nome do produto -->
            <div>
                <label for="inputNome">Nome do Produto (+5)</label>
                <input type="text" name="produto" class="form-control" id="inputNome" required>
            </div>

            <!-- Descrição -->
            <div>
                <label for="inputDescricao">Descrição do produto (+5)</label>
                <textarea class="form-control" name="descricao" id="inputDescricao" rows="3"></textarea>
            </div>

            <!-- Categoria -->
            <div>
                <label for="inputCategoria">Categoria (+5)</label>
                <select name="categoria" class="form-select" id="inputCategoria">
                    <option selected></option>
                    <option disabled>Selecione a categoria do produto</option>
                    <option value="action figure">Action Figure</option>
                    <option value="esportivo">Esportivo</option>
                    <option value="quadrinhos">Quadrinhos</option>
                    <option value="cards">Cards</option>
                    <option value="funko">Funko</option>
                </select>
            </div>

            <!-- Material do produto -->
            <div>
                <label for="inputMaterial">Material do produto (+3)</label>
                <input type="text" name="material" class="form-control" id="inputMaterial">
            </div>

            <!-- Tamanho -->
            <div>
                <label for="inputTamanho">Tamanho do produto (+3)</label>
                <input type="text" name="tamanho" class="form-control" id="inputTamanho">
            </div>

            <!-- Condição -->
            <div>
                <label for="inputCondicao">Condição (+5)</label>
                <select name="condicao" class="form-select" id="inputCondicao">
                    <option selected></option>
                    <option disabled>Selecione a condição do produto</option>
                    <option value="novo">Novo</option>
                    <option value="usado">Usado</option>
                    <option value="lacrado">Lacrado</option>
                </select>
            </div>

            <!-- Preview da imagem -->
            <div class="img-preview">
                <img id="nova-img" src="">
            </div>
            <!-- onerror="this.src = 'images/default2.png'" -->

            <!-- Link da imagem -->
            <div>
                <label for="inputLink">Link da imagem (+10)</label>
                <input type="text" name="img" class="form-control" id="inputLink" onchange="atualizafoto()">
            </div>

            <div>
                <label for="inputPreco">Preço estimado</label>
                <input type="text" name="preco" class="form-control" id="inputPreco">
            </div>

            <!-- Botões -->
            <div>
                <button type="submit" class="btn btn-success mt-3" onclick="validacaoForm()">Cadastrar produto</button>
                <a href="principal.php" class="btn btn-danger mt-3">Voltar</a>
            </div>


        </div>
    </form>
</body>
<script>
    //Variável de pontos de confiabilidade
    var confiabilidade = 0;

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

    function atualizafoto() {
        link = document.getElementById("inputLink").value
        novaFoto.src = link
        novaFoto.error = function() {

            console.log('Erro')
        }
    }

    //Verificação de imagem
    var lastInstance = "erro"

    novaFoto.onload = function() {
        verificarImg('load')
    };
    novaFoto.onerror = function() {
        verificarImg('erro')
    };
    
    function verificarImg(e) {
        
        if (e == 'erro' && lastInstance != "erro") {
            confiabilidade -= 10
            lastInstance = "erro"
            

        } else if(e == 'load' && lastInstance != "load") {
            confiabilidade += 10
            lastInstance = "load"
        }
        if (confiabilidade < 0) {
            confiabilidade = 0
        }
        barColor.style.width = `${confiabilidade}%`
        barNumber.innerHTML = `${confiabilidade}%`
    }


    //Progresso da barra de confiabilidade
    const barNumber = document.querySelector('.conf-value>b')
    const barColor = document.getElementsByClassName('progressbar-color')[0]

    function load() {
        var form = document.getElementsByClassName("form-control");


        updateValue('inputNome', 5)
        updateValue('inputDescricao', 5)
        updateValue('inputCategoria', 5)
        updateValue('inputMaterial', 3)
        updateValue('inputTamanho', 3)
        updateValue('inputCondicao', 5)
    }
    load();


    function updateValue(inputId, valor) {
        const inputElement = document.getElementById(inputId)

        inputElement.addEventListener('change', function() {

            // Verifica se o campo foi preenchido
            if (inputElement.value != "") {
                if(!inputElement.classList.contains('pontuado')){
                    confiabilidade += valor
                    inputElement.classList.add('pontuado')
                }
            } else {
                confiabilidade -= valor
                inputElement.classList.remove('pontuado')
            }

            barColor.style.width = `${confiabilidade}%`
            barNumber.innerHTML = `${confiabilidade}%`
        });
    }
</script>

</html>