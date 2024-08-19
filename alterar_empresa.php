<?php

require_once 'DAO/EmpresaDAO.php';

$dao = new EmpresaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $idEmpresa = $_GET['cod'];
    $dados = $dao->DetalharEmpresa($idEmpresa);

    if (count($dados) == 0) {
        header('location: consultar_empresa.php');
        exit;
    }
} else if (isset($_POST['btnSalvar'])) {
    $idEmpresa = $_POST['cod'];
    $empresa = trim($_POST['empresa']);
    $telefone = trim($_POST['telefone']);
    $endereco = trim($_POST['endereco']);

    $objdao = new EmpresaDAO();

    $ret = $objdao->AlterarEmpresa($idEmpresa, $empresa, $telefone, $endereco);

    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExcluir'])) {
    $idEmpresa = $_POST['cod'];

    $ret = $dao->ExcluirEmpresa($idEmpresa);

    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_empresa.php');
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
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php require_once '_msg.php' ?>
                        <h2>Alterar ou Excluir Empresa</h2>
                        <h5>Aqui você pode Alterar ou Excluir sua Empresa. </h5>
                    </div>
                </div>
                <hr />
                <form action="alterar_empresa.php" method="POST">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_empresa'] ?>">
                    <div class="form-group">
                        <label>Nome da Empresa:</label>
                        <input class="form-control" id="empresa" name="empresa" placeholder="Digite o Nome da Empresa. Exemplo:Casas Bahia..." value="<?= $dados[0]['nome_empresa'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Telefone/Whatsapp:</label>
                        <input type="number" class="form-control" id="telefone" name="telefone" placeholder="Digite Telefone/Whatsapp da Empresa..." value="<?= $dados[0]['telefone_empresa'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Endereço:</label>
                        <input class="form-control" id="endereco" name="endereco" placeholder="Digite o Endereço da Empresa..." value="<?= $dados[0]['endereco_empresa'] ?>" />
                    </div>
                    <button type="submit" name="btnSalvar" class="btn btn-success" onclick="return ValidarEmpresa()">Salvar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Excluir</button>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Você realmente deseja Excluir?</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a Empresa:<b><?= $dados[0]['nome_empresa']  ?> ?</b>
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
        </div>
    </div>
</body>

</html>

Digite o Nome da Empresa. Exemplo:Casas Bahia...