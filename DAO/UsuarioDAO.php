<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class UsuarioDAO extends Conexao{
    public function ValidarLogin($email, $senha){
        if($email == '' || $senha == ''){
            return 0;
        }else if(strlen($senha) < 6 || strlen($senha) > 8){
            return -2;
        }else{
            // return 1;
            $conexao = parent::retornarConexao();
            $comando_sql = 'select id_usuario, nome_usuario from tb_usuario where email_usuario = ? and senha_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $email);
            $sql->bindValue(2, $senha);
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();
            $user = $sql->fetchAll();

            if(count($user) == 0){
                return -6;
            }

            $cod = $user[0]['id_usuario'];
            $nome = $user[0]['nome_usuario'];
            UtilDAO::CriarSessao($cod, $nome);
            header('location: tela_inicial.php');
            exit;

        }
    }

    public function CadastrarUsuario($nome, $email, $senha, $rsenha){
        if($nome == '' || $email == '' || $senha == '' || $rsenha == ''){
            return 0;
        }else if(strlen($senha) < 6 || strlen($senha) > 8 ){
            return -2;
        }else if(($senha) != ($rsenha)){
            return -3;
        }else{

            if($this->VerificarEmailDuplicadoCadastro($email) != 0){
                return -5;
            }

            // return 1;
            $conexao = parent::retornarConexao();
            $comando_sql = 'insert into tb_usuario(nome_usuario, email_usuario, senha_usuario, data_cadastro) values    (?, ?, ?, ?)';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $nome);
            $sql->bindValue(2, $email);
            $sql->bindValue(3, $senha);
            $sql->bindValue(4, date('Y-m-d'));

            try{
                $sql->execute();
                return 2;   
            }catch(Exception $ex){
                echo $ex->getMessage();
                return -1;
            }
        }
    }

    public function CarregarMeusDados(){
        $conexao = parent::retornarConexao();

        $comando_sql = 'select nome_usuario, email_usuario, senha_usuario from tb_usuario where id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::UsuarioLogado());

        //Remove os index dentro do array, permanecendo somente com as colunas do Banco de Dados;
        // Realizar uma consulta via PDO de todos os dados solicitados pelo Script SQL;
        //Essa consulta realizada via PDO, retorna os dados de um Array;
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();        

        return $sql->fetchAll();

    }

    public function GravarMeusDados($nome, $email, $senha){
        if($nome == '' || $email == '' || $senha == ''){
            return 0;
        }else if(strlen($senha) < 6 || strlen($senha) > 8){
            return -2;
        }else{

            if($this->VerificarEmailDuplicadoAlteracao($email) != 0){
                return -5;
            }

             // return 1;

             $conexao = parent::retornarConexao();
             $comando_sql = 'update tb_usuario set nome_usuario = ?, email_usuario = ?, senha_usuario = ? where id_usuario = ?';
 
             $sql = new PDOStatement();
             $sql = $conexao->prepare($comando_sql);
 
             $sql->bindValue(1, $nome);
             $sql->bindValue(2, $email);
             $sql->bindValue(3, $senha);
             $sql->bindValue(4, UtilDAO::UsuarioLogado());
 
            try{
                $sql->execute();
                return 1;   
            }catch(Exception $ex){
                echo $ex->getMessage();
                return -1;
            }
        }
    }

    public function VerificarEmailDuplicadoCadastro($email){
        if($email == ''){
            return 0;
        }else{
            $conexao = parent::retornarConexao();
            $comando_sql = 'select count(email_usuario) as contar from tb_usuario where email_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $email);
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();
            $contar = $sql->fetchAll();
            return $contar[0]['contar'];
        }
    }

    public function VerificarEmailDuplicadoAlteracao($email){
        if($email == ''){
            return 0;
        }else{
            $conexao = parent::retornarConexao();
            $comando_sql = 'select count(email_usuario) as contar from tb_usuario where email_usuario = ? and id_usuario != ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $email);
            $sql->bindValue(2, UtilDAO::UsuarioLogado());
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();
            $contar = $sql->fetchAll();
            return $contar[0]['contar'];
        }
    }
}