<?php

require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once 'DAO/EmpresaDAO.php';

if(isset($_POST['btnSalvar'])){
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);
    $endereco = trim($_POST['endereco']);

    $objdao = new EmpresaDAO();

    $ret = $objdao -> CadastrarEmpresa($nome, $telefone, $endereco);
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
                        <?php require_once '_msg.php' ?>
                        <h2>Nome da Empresa</h2>
                        <h5>Aqui você poderá Cadastrar os nomes das Empresas. </h5>
                    </div>
                </div>
                <hr />
                <form action="nova_empresa.php" method="POST">
                <div class="form-group">
                    <label>Nome da Empresa:</label>
                    <input class="form-control" name="nome" id="empresa" placeholder="Digite o Nome da Empresa. Exemplo:Casas Bahia..." value="<?= isset($nome) ? $nome : '' ?>"/>
                </div>
                <div class="form-group">
                    <label>Telefone/Whatsapp:</label>
                    <input type="number" class="form-control" name="telefone" id="telefone"  placeholder="Digite Telefone/Whatsapp da Empresa..." value="<?= isset($telefone) ? $telefone : '' ?>"/>
                </div>
                <div class="form-group">
                    <label>Endereço:</label>
                    <input class="form-control" name="endereco" id="endereco" placeholder="Digite o Endereço da Empresa..." value="<?= isset($endereco) ? $endereco : '' ?>"/>
                </div>
                <button type="submit" name="btnSalvar" class="btn btn-success" onclick="return ValidarEmpresa()" >Salvar</button>
                </form>
            </div> 
        </div>  
    </div>
</body>
</html>