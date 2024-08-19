<?php

require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once 'DAO/MovimentoDAO.php';
require_once 'DAO/CategoriaDAO.php';
require_once 'DAO/EmpresaDAO.php';
require_once 'DAO/ContaDAO.php';

$dao_cat = new CategoriaDAO();
$dao_emp = new EmpresaDAO();
$dao_con = new ContaDAO();


$tipo = '';
$categoria = '';
$empresa = '';
$conta = '';

if(isset($_POST['btnFinalizar'])){
    $tipo = trim($_POST['tipo']);
    $data = trim($_POST['data']);
    $valor = trim($_POST['valor']);
    $obs = trim($_POST['obs']);
    $categoria = trim($_POST['categoria']);
    $empresa = trim($_POST['empresa']);
    $conta = trim($_POST['conta']);

    $objdao = new MovimentoDAO();

    $ret = $objdao -> RealizarMovimento($tipo, $data, $valor, $obs, $categoria, $empresa, $conta);
}

$categorias = $dao_cat -> ConsultarCategoria();
$empresas = $dao_emp -> ConsultarEmpresa();
$contas = $dao_con -> ConsultarConta();

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
                        <h2>Realizar Movimento</h2>
                        <h5>Aqui você poderá realizar os seus Movimentos de ENTRADA ou SAÍDA. </h5>
                    </div>
                </div>
                <hr />
                <form action="realizar_movimento.php" method="POST">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tipo do Movimento:</label>
                        <select class="form-control" name="tipo" id="tipo" >
                            <option value="">Selecione</option>
                            <option value="1" <?= $tipo == 1 ? 'selected' : '' ?>>Entrada</option>
                            <option value="2" <?= $tipo == 2 ? 'selected' : '' ?>>Saída</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Data:</label>
                        <input type="date" class="form-control" name="data" id="data" placeholder="Coloque a Data do Movimento..." value="<?= isset($data) ? $data : '' ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Valor do Movimento:</label>
                        <input class="form-control" name="valor" id="valor" placeholder="Digite o valor do Movimento..." value="<?= isset($valor) ? $valor : '' ?>"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Categoria:</label>
                        <select class="form-control" name="categoria" id="categoria">
                            <option value="">Selecione</option>
                            <?php foreach($categorias as $item) { ?>
                            <option value="<?= $item['id_categoria'] ?>">
                            <?= $item['nome_categoria'] ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Empresa:</label>
                        <select class="form-control" name="empresa" id="empresa">
                            <option value="">Selecione</option>
                            <?php foreach($empresas as $item) { ?>
                            <option value="1" <?= $item['id_empresa'] ?>>
                            <?= $item['nome_empresa'] ?> 
                        </option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Conta:</label>
                        <select class="form-control" name="conta" id="conta">
                            <option value="">Selecione</option>
                            <?php foreach($contas as $item){ ?>
                            <option value="<?= $item['id_conta'] ?>"> 
                            <?= $item['banco_conta']?> / R$ <?= number_format($item['saldo_conta'], 2, ',', '.')?>
                        </option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Observação (Opcional):</label>
                        <textarea class="form-control" rows="3" name="obs" id="obs"></textarea>
                    </div>
                    <button type="submit" name="btnFinalizar" class="btn btn-success"  onclick="return ValidarMovimento()">Finalizar Lançamento</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>