<?php 
include('conexao.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die("Você não está logado.<p><a href='index.php'>Logar</a></p>");
}


$id_comment = $_POST['valor'];
$id_item = $_POST['id_item'];

$sql = "DELETE FROM `comentarios` WHERE `comentarios`.`id` = $id_comment";
$conn->query($sql);

echo "Comentário excluído com sucesso!";
?>

<a href="perfil.php?id_perfil=<?php echo $id_item ?>">Voltar</a>