<?php 
include '../model/Conexao.class.php';
include '../model/Manager.class.php';
$Cadastro = new Cadastro();

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
}

$id_usuario = $_SESSION['id'];
$usuario = $_SESSION['usuario'];

$busca = $_GET['busca'];


// Obter parâmetros de busca e ordenação
$busca = isset($_GET['busca']) ? $_GET['busca'] : '';
$ordenarPor = isset($_GET['ordenar_por']) ? $_GET['ordenar_por'] : 'id';

$_SESSION['ordem'] = $ordenarPor;


if (isset($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
} else {
    $pagina = 1;
}
$offset = $pagina * 20 - 20;

// Obter parâmetros de busca e ordenação
$busca = isset($_GET['busca']) ? $_GET['busca'] : '';
$ordenarPor = isset($_GET['ordenar_por']) ? $_GET['ordenar_por'] : 'id';


$sql = "SELECT * FROM produtos WHERE produto LIKE '%$busca%' ORDER BY ";
// Definir a coluna de ordenação com base no parâmetro recebido
switch ($ordenarPor) {
    case 'alfa':
        $ordem = 'produto';
        $sql = $sql . " produto LIMIT 20 OFFSET $offset";
        break;
    case 'conf':
        $ordem = 'pontos';
        $sql = $sql . " confiabilidade DESC, id DESC LIMIT 20 OFFSET $offset";
        break;
    case 'novo':
    default:
        $ordem = 'id';
        $sql = $sql . " id DESC LIMIT 20 OFFSET $offset";
        break;
}

// Preparar a consulta
$resultado = $Cadastro->select_busca($sql);



// Verificar se há resultados
if ($resultado->num_rows > 0) {
    while($produto = $resultado->fetch_assoc()) {
        ?>
            <div class="card m-3">
                <picture>
                    <img src="<?php echo $produto['link-img'] ?>"
                     class="card-img-top"
                     onerror="this.src='../resources/images/no-image.svg'">>
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



?>