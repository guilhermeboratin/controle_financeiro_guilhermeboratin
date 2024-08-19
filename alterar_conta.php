<?php

require_once 'DAO/ContaDAO.php';

$dao = new ContaDAO();

if(isset($_GET['cod']) && is_numeric($_GET['cod'])){
    $idConta = $_GET['cod'];
    $dados = $dao->DetalharConta($idConta);

    if(count($dados) == 0){
    header('location: consultar_conta.php');
    exit;
    }
}
else if(isset($_POST['btnSalvar'])){
    $idConta = $_POST['cod'];
    $banco = trim($_POST['banco']);
    $agencia = trim($_POST['agencia']);
    $numero = trim($_POST['numero']);
    $saldo = trim($_POST['saldo']);

    $objdao = new ContaDAO();

    $ret = $objdao -> AlterarConta($idConta, $banco, $agencia, $numero, $saldo);

    header('location: consultar_conta.php?ret=' . $ret);
    exit;
}
else if(isset($_POST['btnExcluir'])){
    $idConta = $_POST['cod'];

    $ret = $dao->ExcluirConta($idConta);

    header('location: consultar_conta.php?ret=' . $ret);
    exit;
}
else{
    header('location: consultar_conta.php');
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
                        <h2>Alterar Contas</h2>
                        <h5>Aqui você pode Alterar ou Excluir suas Contas Bancárias. </h5>
                    </div>
                </div>
                <hr />
                <form action="alterar_conta.php" method="POST">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_conta'] ?>">
                <div class="form-group">
                    <label>Nome do Banco:</label>
                    <input class="form-control" id="banco" name="banco" placeholder="Digite o Nome do Banco..." value="<?= $dados[0]['banco_conta'] ?>" />
                </div>
                <div class="form-group">
                    <label>Agência:</label>
                    <input type="number" class="form-control" id="agencia" name="agencia" placeholder="Digite a Agência..." value="<?= $dados[0]['agencia_conta'] ?>" />
                </div>
                <div class="form-group">
                    <label>Número da Conta:</label>
                    <input class="form-control" id="numero" name="numero" placeholder="Digite o Número da Conta..." value="<?= $dados[0]['numero_conta'] ?>" />
                </div>
                <div class="form-group">
                    <label>Saldo:</label>
                    <input class="form-control" id="saldo" name="saldo" placeholder="Digite o Saldo..." value="<?= $dados [0]['saldo_conta'] ?>" />
                </div>
                <button type="submit" name="btnSalvar" class="btn btn-success" onclick="return ValidarConta()" >Salvar</button>
                <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Excluir</button>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Você realmente deseja Excluir?</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a Conta:<b><?= $dados[0]['banco_conta'] ?> / Agencia: <?= $dados[0]['agencia_conta'] ?> - Número: <?= $dados[0]['numero_conta'] ?> ?</b>
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