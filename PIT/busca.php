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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Market Tiger</title>
    <link rel="stylesheet" href="css/busca.css">
    <link rel="stylesheet" href="css/cabecalho.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>
<?php
$id_usuario = $_SESSION['id'];
$usuario = $_SESSION['usuario'];

$busca = $_GET['busca'];

$sql = "SELECT * FROM produtos WHERE produto LIKE '%$busca%' ORDER BY id DESC";

$resultado = $conn->query($sql);
$ordem = "";

if(!isset($_SESSION['ordem'])){
    $_SESSION['ordem'] = '';
}

?>

    <!-- Cabeçalho -->
    <?php include('header.php') ?>

    <!-- Resultados -->
    <section class="ordenar">
        <div class="dropdown">
            <button id="btn-ordem" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Ordenar por:
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item ordena-item" href="" onclick="searchProducts('novo')">Mais novos</a></li>
                <li><a class="dropdown-item ordena-item" href="" onclick="searchProducts('alfa')">Alfabética</a></li>
                <li><a class="dropdown-item ordena-item" href="" onclick="searchProducts('conf')">Confiabilidade</a></li>
            </ul>
        </div>
    </section>

    <!-- RESULTADOS -->
    <section class="resultados">

        <div>
            <h2>Resultados (<?php echo $resultado->num_rows ?>) </h2>
        </div>

        <div class="produtos" id="produto">
            
        </div>

    </section>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    function preventDefaultAction(event) {
        event.preventDefault(); // Previne o comportamento padrão do link
    }

    // Adiciona o evento de clique a todos os links com a classe 'prevent-link'
    window.onload = function() {
        var links = document.querySelectorAll('.ordena-item');
        links.forEach(function(link) {
            link.addEventListener('click', preventDefaultAction);
        });
    };


    function searchProducts(ordem) {

        let list = document.getElementsByClassName("ordena-item")

        switch(ordem){
            case 'alfa': 
                list[1].classList.add("selecionaOrdem")
                list[0].classList.remove("selecionaOrdem")
                list[2].classList.remove("selecionaOrdem")
                document.getElementById('btn-ordem').textContent = "Ordenar por: Alfabética";
                
                
                break;

            case 'conf':
                list[0].classList.remove("selecionaOrdem")
                list[2].classList.add("selecionaOrdem")
                list[1].classList.remove("selecionaOrdem")
                document.getElementById('btn-ordem').textContent = "Ordenar por: Confiabilidade";

                
                break;

            case 'novo':
                default:
                list[1].classList.remove("selecionaOrdem")
                list[2].classList.remove("selecionaOrdem")
                list[0].classList.add("selecionaOrdem")
                document.getElementById('btn-ordem').textContent = "Ordenar por: Mais novos";

                break;
        }



        var query = "<?php echo $busca; ?>";
        var orderBy = ordem;
        $.ajax({
            
            url: 'selectbusca.php', // Mesma página
            type: 'GET',
            data: {
                busca: query,
                ordenar_por: orderBy,
                ajax: 1
            },
            success: function(response) {
                $("#produto").html(response);
            }
        });
    }
    searchProducts('<?php echo $_SESSION['ordem']; ?>');

    // $(document).ready(function() {
    //     // Carregar resultados iniciais se houver uma busca prévia
    //     searchProducts();
    // });

    
</script>
</html>