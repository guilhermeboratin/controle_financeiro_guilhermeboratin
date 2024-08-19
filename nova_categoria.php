<?php

require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once 'DAO/CategoriaDAO.php';

if(isset($_POST['btnSalvar'])){
    $nome = trim($_POST['nome']);

    $objdao = new CategoriaDAO();
    $ret = $objdao -> CadastrarCategoria($nome);
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
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php' ?>
                        <h2>Cadastrar Categoria Financeira.</h2>
                        <h5>Aqui você poderá cadastrar todas as suas categorias Financeiras. </h5>
                    </div>
                </div>
                <hr />
                <form action="nova_categoria.php" method="POST">
                <div class="form-group">
                    <label>Nome da Categoria</label>
                    <input class="form-control" name="nome" placeholder="Digite o nome da categoria. Exemplo: Conta de Luz" id="nomecategoria" maxlength="45" value="<?= isset($nome) ? $nome : '' ?>"/>
                </div>
                <button type="submit" name="btnSalvar" onclick="return ValidarCategoria()" class="btn btn-success">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>