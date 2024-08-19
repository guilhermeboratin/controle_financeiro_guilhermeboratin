<?php

require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once 'DAO/MovimentoDAO.php';

$tipo = '';
$dtInicio = '';
$dtFinal = '';

if (isset($_POST['btnPesquisar'])) {
    $tipo = $_POST['tipo'];
    $dtInicio = $_POST['dtInicio'];
    $dtFinal = $_POST['dtFinal'];

    $objdao = new MovimentoDAO;
    $movs = $objdao->ConsultarMovimento($tipo, $dtInicio, $dtFinal);
    
}else if(isset($_POST['btnExcluir'])){
    $idMov = $_POST['idMov'];
    $idConta = $_POST['idConta'];
    $tipo = $_POST['tipo'];
    $valor = $_POST['valor'];

    $dao = new MovimentoDAO();
    $ret = $dao->ExcluirMovimento($idMov, $idConta, $valor, $tipo);
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
                        <h2>Consultar Movimentos</h2>
                        <h5>Aqui você irá consultar todos os movimentos financeiros de ENTRADA e SAÍDA.</h5>
                    </div>
                </div>
                <hr />
                <form action="consultar_movimento.php" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tipo do Movimento:</label>
                                        <select class="form-control" name="tipo" id="tipo">
                                            <option value="">Selecione</option>
                                            <option value="0" <?= $tipo == 0 ? 'selected' : '' ?>>Todos</option>
                                            <option value="1" <?= $tipo == 1 ? 'selected' : '' ?>>Entrada</option>
                                            <option value="2" <?= $tipo == 2 ? 'selected' : '' ?>>Saída</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Data Inicial:</label>
                                        <input type="date" class="form-control" name="dtInicio" id="data_inicial" placeholder="Coloque a Data do Movimento..." value="<?= isset($dtInicio) ? $dtInicio : '' ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Data Final:</label>
                                        <input type="date" class="form-control" name="dtFinal" id="data_final" placeholder="Coloque a Data do Movimento..." value="<?= isset($dtFinal) ? $dtFinal : '' ?>" />
                                    </div>
                                </div>
                                <center>
                                    <button class="btn btn-info" name="btnPesquisar" onclick="return ValidarConsultaPeriodo()">Pesquisar</button>
                                </center>
                </form>

                <hr>
                <?php if (isset($movs)) { ?>
                    <div class="panel-heading">
                        <span>Aqui você pode consultar todos os movimentos realizados ou se desejar, excluir.</span>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Data</th>
                                        <th>Valor</th>
                                        <th>Categoria</th>
                                        <th>Empresa</th>
                                        <th>Conta</th>
                                        <th>Observação</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    // O Motivo da Variável TOTAL, é somar todos os valores encontrados pelo ARRAY MOVS, Desta forma ele sempre ira somar os valores adicionados em cada posição do ARRAY;
                                    $total = 0;

                                    for ($i = 0; $i < count($movs); $i++) {
                                        if ($movs[$i]['tipo_movimento'] == 1) {
                                            $total = $total + $movs[$i]['valor_movimento'];
                                        } else {
                                            $total = $total - $movs[$i]['valor_movimento'];
                                        }


                                    ?>
                                        <tr>
                                            <td><?= $movs[$i]['tipo_movimento'] == 1 ? 'Entrada' : 'Saída' ?></td>
                                            <td><?= $movs[$i]['data_movimento'] ?></td>
                                            <td>R$<?= number_format($movs[$i]['valor_movimento'], 2, ',', '.') ?></td>
                                            <td><?= $movs[$i]['nome_categoria'] ?></td>
                                            <td><?= $movs[$i]['nome_empresa'] ?></td>
                                            <td><?= $movs[$i]['banco_conta'] ?> | Agen: <?= $movs[$i]['agencia_conta'] ?> | Num. Conta: <?= $movs[$i]['numero_conta'] ?> | R$ <?= number_format($movs[$i]['saldo_conta'], 2, ',', '.') ?> </td>
                                            <td><?= $movs[$i]['obs_movimento'] ?></td>
                                            <td>
                                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalExcluir<?= $i ?>">Excluir</a>
                                                <form action="consultar_movimento.php" method="POST">
                                                    <input type="hidden" name="idMov" value="<?= $movs [$i]['id_movimento'] ?>">
                                                    <input type="hidden" name="idConta" value="<?= $movs [$i]['id_conta'] ?>">
                                                    <input type="hidden" name="tipo" value="<?= $movs [$i]['tipo_movimento'] ?>">
                                                    <input type="hidden" name="valor" value="<?= $movs [$i]['valor_movimento'] ?>">
                                                <div class="modal fade" id="modalExcluir<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title" id="myModalLabel">Você realmente deseja Excluir?</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <center><b>Deseja excluir o Movimento:</b></center><br><br>
                                                                <b>Data do Movimento: </b><?= $movs[$i]['data_movimento'] ?><br>
                                                                <b>Tipo do Movimento: </b><?= $movs[$i]['tipo_movimento'] == 1 ? 'Entrada' : 'Saída' ?><br>
                                                                <b>Categoria: </b><?= $movs[$i]['nome_categoria'] ?><br>
                                                                <b>Empresa: </b><?= $movs[$i]['nome_empresa'] ?> <br>
                                                                <b>Conta:<b> <?= $movs[$i]['banco_conta'] ?> | Agen: <?= $movs[$i]['agencia_conta'] ?> | Num. Conta: <?= $movs[$i]['numero_conta'] ?><br>
                                                                <b>Valor:</b>R$ <?= number_format($movs[$i]['saldo_conta'], 2, ',', '.') ?><br>
                                                                <b>Observação Registrada:</b><?= isset($movs[$i]['obs_movimento']) ? $movs[$i]['obs_movimento'] : '' ?>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Não, Cancelar!</button>
                                                                <button type="submit" name="btnExcluir" class="btn btn-danger">Sim, Excluir!</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div style="text-align: center;">
                                <span style="color: <?= $total < 0 ? '#ff0000' : '#006400' ?>;"><strong>R$ <?= number_format($total, 2, ',', '.') ?></strong></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</body>

</html>