<?php

    // Caso exista na aplicação, a chave ret na URL, essa condição lógica executa a verificação

    if(isset($_GET['ret'])){
        $ret = $_GET['ret'];
    }

    // Caso não existe na URL a chave ret, ele vai pular a condição anterior e verififcar o valor de ret, para emitir a mensagem!
    if(isset($ret)){
        switch($ret){
            case 1:
                echo '<div class="alert alert-success">Ação realizada com Sucesso!</div>';
            break;
            case 2:
                echo '<div class="alert alert-success">Cadastro realizado com Sucesso!</div>';
            break;
            case 0:
                echo '<div class="alert alert-warning">Preencha TODOS os campos obrigatórios!</div>';
            break;
            case -1:
                echo '<div class="alert alert-danger">Ocorreu um erro na operação. Tente mais tarde!</div>';
            break;
            case -2:
                echo '<div class="alert alert-warning">A Senha deverá conter entre 6 e 8 caracteres!</div>';
            break;
            case -3:
                echo '<div class="alert alert-warning">As SENHAS devem ser iguais!</div>';
            break;
            case -4:
                echo '<div class="alert alert-danger">O registro não poderá ser excluido, pois está em uso!</div>';
            break;
            case -5:
                echo '<div class="alert alert-danger">E-mail já cadastrado. Coloque um outro e-mail!</div>';
            break;
            case -6:
                echo '<div class="alert alert-danger">Usuário não encontrado!</div>';
            break;
            case -7:
                echo '<div class="alert alert-danger">E-mail inválido!</div>';
            break;
        }
    }