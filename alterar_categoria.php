<?php

require_once 'DAO/CategoriaDAO.php';

$dao = new CategoriaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $idCategoria = $_GET['cod'];

    $dados = $dao->DetalharCategoria($idCategoria);

    //Se tem alguma coisa dentro do ARRAY $dados
    if (count($dados) == 0) {
        header('location: consultar_categoria.php');
        exit;
    }
} else if (isset($_POST['btnSalvar'])) {
    $nome = trim($_POST['nome']);
    $idCategoria = trim($_POST['cod']);

    $objdao = new CategoriaDAO();
    $ret = $objdao->AlterarCategoria($nome, $idCategoria);

    header('location: consultar_categoria.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExcluir'])) {
    $idCategoria = $_POST['cod'];
    $ret = $dao->ExcluirCategoria($idCategoria);

    header('location: consultar_categoria.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_categoria.php');
    exit;
}


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include_once '_head.php';
?>

<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php' ?>
                        <h2>Alterar ou Excluir Categoria Financeira.</h2>
                        <h5>Aqui você poderá alterar ou excluir suas Categorias. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="alterar_categoria.php" method="POST">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_categoria'] ?>">
                    <div class="form-group">
                        <label>Nome da Categoria:</label>
                        <input class="form-control" name="nome" placeholder="Digite o nome da categoria. Exemplo: Conta de Luz" maxlength="45" id="nomecategoria" value="<?= $dados[0]['nome_categoria'] ?>" />
                    </div>
                    <button type="submit" name="btnSalvar" class="btn btn-success" onclick="return ValidarCategoria()">Salvar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Excluir</button>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Você realmente deseja Excluir?</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a Categoria:<b><?= $dados[0]['nome_categoria']  ?> ?</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Não, Cancelar!</button>
                                    <button type="submit" name="btnExcluir" class="btn btn-danger">Sim, Excluir!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>


</body>

</html>