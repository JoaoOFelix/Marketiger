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
    <title>Produto</title>

    <link rel="stylesheet" href="css/produto.css">
    <link rel="stylesheet" href="css/cabecalho.css">
</head>

<body>
    <?php
    $id_usuario = $_SESSION['id'];

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
    }

    //Criar o comando
    $sql = "SELECT * FROM produtos WHERE id = $id";

    //executar o comando
    $resultado = $conn->query($sql);

    $item = $resultado->fetch_assoc();;
    ?>


    <!-- Cabeçalho -->
    <?php include('header.php') ?>

    <main>
        <section class="text-center">
            <img src="<?php echo $item['link-img'] ?>" class="rounded" alt="...">
        </section>

        <section class="infos">
            <div>
                <h1>
                    <?php echo $item['produto'] ?>
                </h1>
            </div>

            <p>
                <?php echo $item['descricao'] ?>
            </p> <br>

            
            

            <span>
                Material: <?php echo $item['material'] ?>
            </span><br>

            <span>
                Tamanho: <?php echo $item['tamanho'] ?>
            </span><br>

            <span>
                Condição do produto: <?php echo $item['condicao'] ?>
            </span><br>

            <div class="confiabilidade">
                <div>
                    <p>Confiabilidade</p>
                </div>
                <div id="container"></div>
            </div>

            <span>
                Anunciante: <a href="perfil.php?id_perfil=<?php echo $item['id_usuario'] ?>"><?php echo $item['anunciante'] ?> </a> 
            </span>
        </section>
        
    </main>
    

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Script barra de progresso -->
<!-- https://stackoverflow.com/questions/42477756/build-semi-circle-progress-bar-with-round-corners-and-shadow-in-java-script-and -->
<script src="https://rawgit.com/kimmobrunfeldt/progressbar.js/1.0.0/dist/progressbar.js"></script>
<script>
    var bar = new ProgressBar.SemiCircle(container, {
        strokeWidth: 5,
        color: '#15ff00',
        trailColor: '#eee',
        trailWidth: 5,
        easing: 'easeInOut',
        duration: 2400,
        svgStyle: null,
        text: {
            value: '',
            alignToBottom: false
        },

        // Set default step function for all animate calls
        step: (state, bar) => {
            bar.path.setAttribute('stroke', state.color);
            var value = Math.round(bar.value() * 100);
            if (value === 0) {
                bar.setText('');
            } else {
                bar.setText(value + "%");
            }

            bar.text.style.color = state.color;
        }
    });

    bar.text.style.fontSize = '3rem';

    bar.animate(<?php echo $item['confiabilidade']/100 ?>); // Number from 0.0 to 1.0
</script>

</html>