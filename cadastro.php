<?php

require_once 'DAO/UsuarioDAO.php';

if(isset($_POST['btnFinalizar'])){
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $rsenha = trim($_POST['rsenha']);

    $objdao = new UsuarioDAO();
    $ret = $objdao -> CadastrarUsuario($nome, $email, $senha, $rsenha);

    if($ret == 2){
        header("location: index.php?ret=$ret");
        exit;
    }
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>
<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br />
                <br />
                <?php include_once '_msg.php' ?>
                <h2> Controle Financeiro : Cadastro</h2>
                <h5>( Faça seu cadastro )</h5>
                <br />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Preencher todos os campos </strong>
                    </div>
                    <div class="panel-body">
                        <form action="cadastro.php" method="POST">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" class="form-control" name="nome" id="nome"  placeholder="Digite seu Nome aqui..." value="<?= isset($nome) ? $nome : '' ?>"/>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Seu e-mail" value="<?= isset($email) ? $email : '' ?>"/>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="senha" id="senha"  placeholder="Crie uma senha (mínimo 6 caracteres)" value="<?= isset($senha) ? $senha : '' ?>"/>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="rsenha" id="rsenha"  placeholder="Repita a senha criada" value="<?= isset($rsenha) ? $rsenha : '' ?>"/>
                            </div>
                            <button name="btnFinalizar" onclick="return ValidarCadastro()" class="btn btn-success ">Finalizar Cadastro</button>
                            <hr />
                            <span>Já possui cadastro ?</span> <a href="index.php">Clique aqui!</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>