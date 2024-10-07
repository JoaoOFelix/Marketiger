<?php
class Cadastro extends Conexao
{

    public function __construct() {}

    public function insert_cadastro($cadastro)
    {
        //Declaracoes
        $conn = parent::get_instance();
        $retorno = "";

        //Criar o comando
        $sqlSelect = "SELECT * FROM cadastro WHERE usuario = '$cadastro[usuario]'";

        $sqlInsert = "INSERT INTO cadastro VALUES(NULL, '$cadastro[usuario]', '$cadastro[email]', '$cadastro[telefone]', '$cadastro[senha]', NULL)";

        //executar o comando
        $resultado = $conn->query($sqlSelect);
        $quantidade = $resultado->num_rows;


        if ($quantidade == 0) {

            $resultado = $conn->query($sqlInsert);

            $retorno = "sucesso";
        } else {
            $retorno = "erro";
        }
        return $retorno;
    }

    public function entrar_conta($login)
    {
        //Declaracoes
        $conn = parent::get_instance();

        //Criar o comando
        $sql = "SELECT * FROM cadastro WHERE usuario = '$login[usuariologin]' AND senha = '$login[usuariosenha]'";


        //executar o comando
        $resultado = $conn->query($sql);
        $infos = $resultado->fetch_assoc();


        $quantidade = $resultado->num_rows;


        if ($quantidade == 1) {

            $_SESSION['id'] = $infos['id'];
            $_SESSION['usuario'] = $infos['usuario'];

            return "sucesso";
        }
    }

    public function busca_principal($_busca)
    {
        //Declaracoes
        $conn = parent::get_instance();

        if ($_busca == 'recentes') {
            //Busca dos mais recentes
            $sqlRecentes = "SELECT * FROM produtos ORDER BY id DESC LIMIT 6";
            $resultadoRecentes = $conn->query($sqlRecentes);
            return $resultadoRecentes;
        }


        if ($_busca == 'confiaveis') {
            //Busca dos mais confiaveis
            $sqlConf = "SELECT * FROM produtos ORDER BY confiabilidade DESC LIMIT 6";
            $resultadoConf = $conn->query($sqlConf);
            return $resultadoConf;
        }
    }

    public function foto_cadastro($_idUsuario)
    {
        //Declaracoes
        $conn = parent::get_instance();

        $fotoHeader = "SELECT linkFoto FROM cadastro WHERE id = $_idUsuario";
        $foto = $conn->query($fotoHeader);
        $fotoPerfil = $foto->fetch_assoc();

        return $fotoPerfil;
    }

    public function perfil($_idUsuario)
    {
        //Declaracoes
        $conn = parent::get_instance();

        $sql = "SELECT * FROM cadastro WHERE id = $_idUsuario";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows == 0) {

            echo "<div class='alert alert-danger erro-cadastro' role='alert'>" .
                "ERRO! Esse perfil não existe e/ou foi excluído." .
                "</div>";
        }

        $perfil = $resultado->fetch_assoc();

        return $perfil;
    }

    public function produtos_perfil($_idUsuario)
    {
        //Declaracoes
        $conn = parent::get_instance();

        $sql = "SELECT * FROM produtos WHERE id_usuario = $_idUsuario ORDER BY id DESC";
        $produtos_user = $conn->query($sql);

        return $produtos_user;
    }

    public function selecionar_comentarios($_idPagina)
    {

        //Declaracoes
        $conn = parent::get_instance();

        $comentarios = "SELECT comentarios.id,
        comentarios.comentario,
        comentarios.id_comentador,
        cadastro.linkFoto,
        cadastro.usuario FROM comentarios JOIN cadastro ON
        comentarios.id_comentador = cadastro.id WHERE comentarios.secao = 'perfil' AND comentarios.id_item = $_idPagina";
        $comentado = $conn->query($comentarios);

        return $comentado;
    }

    public function deletar_comentarios($_id_comment)
    {
        //Declaracoes
        $conn = parent::get_instance();

        $sql = "DELETE FROM `comentarios` WHERE `comentarios`.`id` = $_id_comment";
        $conn->query($sql);
    }

    public function inserir_comentario($_id_item, $_comentario)
    {
        //Declaracoes
        $conn = parent::get_instance();


        $id_usuario = $_SESSION['id'];
        $usuario = $_SESSION['usuario'];


        $sql = "INSERT INTO comentarios VALUES(
        NULL,
        'perfil',
        '$_comentario',
        '$_id_item',
        '$id_usuario',
        '$usuario')";

        $conn->query($sql);
    }

    public function update_perfil($_user, $_email, $_telefone, $_senha, $_foto)
    {
        //Declaracoes
        $conn = parent::get_instance();

        $id_usuario = $_SESSION['id'];

        $sqlSelect = "SELECT * FROM cadastro WHERE usuario = '$_user'";
        $resultadoBusca = $conn->query($sqlSelect);

        $idTemp = $resultadoBusca->fetch_assoc();

        $quantidade = $resultadoBusca->num_rows;

        if ($quantidade == 1 && $idTemp['id'] == $id_usuario || $quantidade == 0) {

            $sqlUpdate = "UPDATE `cadastro` SET `usuario` = '$_user',
            `email` = '$_email',
            `telefone` = '$_telefone',
            `senha` = '$_senha',
            `linkFoto` = '$_foto'
            WHERE `cadastro`.`id` = $id_usuario;";
            $_SESSION['usuario'] = $_user;
            $conn->query($sqlUpdate);
            echo "Dados alterados com sucesso.";
        } else {
            echo "Nome de usuário já existe";
        }
    }

    public function insert_produto($_infos, $_produto)
    {
        //Declaracoes
        $conn = parent::get_instance();

        //Criar o comando
        $sql = "INSERT INTO produtos VALUES(
        NULL,
        '$_infos[0]',
        '$_infos[1]',
        '$_infos[2]',
        '$_produto[0]',
        '$_produto[1]',
        '$_produto[2]',
        '$_produto[3]',
        '$_produto[4]',
        '$_produto[5]',
        '$_produto[6]',
        '$_produto[7]'
        )";

        //executar o comando
        $conn->query($sql);
    }

    public function select_produto($_id_produto)
    {
        //Declaracoes
        $conn = parent::get_instance();

        //Criar o comando
        $sql = "SELECT * FROM produtos WHERE id = $_id_produto";

        //executar o comando
        $resultado = $conn->query($sql);

        $produto = $resultado->fetch_assoc();

        return $produto;
    }

    public function update_produto($_id_perfil, $_info_produto)
    {
        //Declaracoes
        $conn = parent::get_instance();

        $sqlPerfil = "SELECT * FROM produtos WHERE id = $_info_produto[0] AND id_usuario = $_id_perfil";
        $resultado = $conn->query($sqlPerfil);
        echo $sqlPerfil;
        if ($resultado->num_rows == 1) {
            $sqlUpdate = "UPDATE `produtos` SET `descricao` = '$_info_produto[1]',
            `material` = '$_info_produto[2]',
            `tamanho` = '$_info_produto[3]',
            `condicao` = '$_info_produto[4]',
            `link-img` = '$_info_produto[5]'
        WHERE `produtos`.`id` = $_info_produto[0];";

            $conn->query($sqlUpdate);
        }
    }

    public function delete_produto($_id_produto, $_id_perfil)
    {
        //Declaracoes
        $conn = parent::get_instance();


        $sqlPerfil = "SELECT * FROM produtos WHERE id = $_id_produto AND id_usuario = $_id_perfil";
        $resultado = $conn->query($sqlPerfil);

        if ($resultado->num_rows == 1) {
            $sql = "DELETE FROM `produtos` WHERE `produtos`.`id` = $_id_produto";
            $conn->query($sql);
            echo "Produto excluído com sucesso!";
        }
    }

    public function numero_produto($_busca)
    {
        //Declaracoes
        $conn = parent::get_instance();

        $sql = "SELECT * FROM produtos WHERE produto LIKE '%$_busca%' ORDER BY id DESC";

        $resultado = $conn->query($sql);

        return $resultado->num_rows;
    }

    public function select_busca($_sql)
    {
        //Declaracoes
        $conn = parent::get_instance();

        $resultado = $conn->query($_sql);

        return $resultado;
    }

    public function comprar_produto($_id_produto)
    {
        //Declaracoes
        $conn = parent::get_instance();

        $sql = "DELETE FROM `produtos` WHERE `produtos`.`id` = $_id_produto";

        $conn->query($sql);
    }

    public function select_favoritos($_id_usuario)
    {
        //Declaracoes
        $conn = parent::get_instance();

        $sql = "SELECT * FROM favoritar WHERE id_usuario = $_id_usuario";
        $favoritos = $conn->query($sql);

        return $favoritos;
    }

    public function favoritar($_id_produto, $_id_usuario)
    {
        //Declaracoes
        $conn = parent::get_instance();

        $sql = "SELECT * FROM `favoritar` WHERE id_produto = $_id_produto AND id_usuario = $_id_usuario";
        $busca = $conn->query($sql);
        $item = $busca->fetch_assoc();

        if ($busca->num_rows == 0) {
            $sql = "INSERT INTO `favoritar`(`id`, `id_produto`, `id_usuario`) VALUES (NULL, $_id_produto, $_id_usuario)";
            $conn->query($sql);
        } else {
            $sql = "DELETE FROM `favoritar` WHERE `favoritar`.`id` = $item[id]";
            $conn->query($sql);
        }
    }
}
