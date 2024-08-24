<?php 

include('conexao.php');

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    die("Você não está logado.<p><a href='index.php'>Logar</a></p>");
}

$id_usuario = $_SESSION['id'];
$usuario = $_SESSION['usuario'];

$busca = $_GET['busca'];



// Obter parâmetros de busca e ordenação
$busca = isset($_GET['busca']) ? $_GET['busca'] : '';
$ordenarPor = isset($_GET['ordenar_por']) ? $_GET['ordenar_por'] : 'id';


$_SESSION['ordem'] = $ordenarPor;




// Definir a coluna de ordenação com base no parâmetro recebido
switch ($ordenarPor) {
    case 'alfa':
        $ordem = 'produto';
        $sql = "SELECT * FROM produtos WHERE produto LIKE '%$busca%' ORDER BY produto";
        break;
    case 'conf':
        $ordem = 'pontos';
        $sql = "SELECT * FROM produtos WHERE produto LIKE '%$busca%' ORDER BY confiabilidade DESC, id DESC";
        break;
    case 'novo':
    default:
        $ordem = 'id';
        $sql = "SELECT * FROM produtos WHERE produto LIKE '%$busca%' ORDER BY id DESC";
        break;
}

// Preparar a consulta
$resultado = $conn->query($sql);

// Verificar se há resultados
if ($resultado->num_rows > 0) {
    while($produto = $resultado->fetch_assoc()) {
        ?>
            <div class="card m-3">
                <picture>
                    <img src="<?php echo $produto['link-img'] ?>"
                     class="card-img-top"
                     onerror="this.src='images/no-image.svg'">>
                </picture>
                
                <div class="card-body">
                    <h5 class="card-title placeholder-glow"><?php echo $produto['produto'] ?></h5>
                    <p class="card-text"><?php echo $produto['descricao'] ?></p>
                    <a href="perfil.php?id_perfil=<?php echo $produto['id_usuario'] ?>"><?php echo $produto['anunciante'] ?></a><br>
                    <a href="produto.php?id=<?php echo $produto['id'] ?>" class="btn btn-primary">Ver Produto</a>
                </div>
            </div>
    <?php

    }
} else {
    echo "Nenhum produto encontrado.";
}


$resultado = $conn->query($sql);


?>