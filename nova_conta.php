<?php

require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once 'DAO/ContaDAO.php';

if(isset($_POST['btnSalvar'])){
    $banco = trim($_POST['banco']);
    $agencia = trim($_POST['agencia']);
    $numero = trim($_POST['numero']);
    $saldo = trim($_POST['saldo']);

    $objdao = new ContaDAO();

    $ret = $objdao -> CadastrarConta($banco, $agencia, $numero, $saldo);

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
                        <h2>Cadastrar Conta Bancária</h2>
                        <h5>Aqui você pode Cadastrar todas as suas Contas Bancárias. </h5>
                    </div>
                </div>
                <hr />
                <form action="nova_conta.php" method="POST">
                <div class="form-group">
                    <label>Digite o Nome do Banco:</label>
                    <input class="form-control" name="banco" id="banco" placeholder="Digite o Nome do Banco aqui..."  value="<?= isset($banco) ? $banco : '' ?>"/>
                </div>
                <div class="form-group">
                    <label>Digite a Agência:</label>
                    <input type="number" class="form-control" name="agencia" id="agencia" placeholder="Digite a Agência qui..." value="<?= isset($agencia) ? $agencia : '' ?>"/>
                </div>
                <div class="form-group">
                    <label>Digite o Número da Conta:</label>
                    <input class="form-control" name="numero" id="numero" placeholder="Digite o Número da conta aqui..." value="<?= isset($numero) ? $numero : '' ?>"/>
                </div>
                <div class="form-group">
                    <label>Digite o Saldo Bancário:</label>
                    <input class="form-control" name="saldo" id="saldo" placeholder="Digite o Saldo aqui Bancário aqui..." value="<?= isset($saldo) ? $saldo : '' ?>"/>
                </div>
                <button type="submit" name="btnSalvar" class="btn btn-success" onclick="return ValidarConta()" >Salvar</button>
                </form>
            </div> 
        </div>  
    </div>
</body>
</html>