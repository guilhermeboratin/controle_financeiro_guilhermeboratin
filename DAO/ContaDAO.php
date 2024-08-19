<?php
require_once 'Conexao.php';

require_once 'UtilDAO.php';

class ContaDAO extends Conexao{
    public function CadastrarConta($banco, $agencia, $numero, $saldo){
        if($banco == '' || $agencia == '' || $numero == '' || $saldo == ''){
            return 0;
        }else{
            //return 1;

            $conexao = parent::retornarConexao();

            $comando_sql = 'insert into tb_conta(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario) values(?, ?, ?, ?, ?);';

            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $banco);
            $sql->bindValue(2, $agencia);
            $sql->bindValue(3, $numero);
            $sql->bindValue(4, $saldo);
            $sql->bindValue(5, UtilDAO::UsuarioLogado());

            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex){
                echo $ex->getMessage();
                return -1;
            }
        }
    }

    public function ConsultarConta(){
        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_conta, banco_conta, agencia_conta, numero_conta, saldo_conta from tb_conta where id_usuario = ? order by banco_conta';
        $sql = new PDOStatement();
        $sql = $conexao -> prepare($comando_sql);
        $sql -> bindValue(1, UtilDAO::UsuarioLogado());
        $sql -> setFetchMode(PDO::FETCH_ASSOC);
        $sql -> execute();
        return $sql->fetchAll();
    }

    public function DetalharConta($idConta){
        if($idConta == ''){
            return 0;
        }
        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_conta, banco_conta, agencia_conta, numero_conta, saldo_conta from tb_conta where id_conta = ? and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idConta);
        $sql->bindValue(2, UtilDAO::UsuarioLogado());
        $sql -> setFetchMode(PDO::FETCH_ASSOC);
        $sql -> execute();
        return $sql->fetchAll();
    }

    public function AlterarConta ($idConta, $banco, $agencia, $numero, $saldo){
            if($idConta == '' || $banco == '' || $agencia == '' || $numero == '' || $saldo == ''){
                return 0;
            }else{
                // return 1;
                $conexao = parent::retornarConexao();
                $comando_sql = 'update tb_conta set banco_conta = ?, agencia_conta = ?, numero_conta = ?, saldo_conta = ? where id_conta = ? and id_usuario = ?'; 
                $sql = new PDOStatement();
                $sql = $conexao->prepare($comando_sql);
                $sql -> bindValue(1, $banco);
                $sql -> bindValue(2, $agencia);
                $sql -> bindValue(3, $numero);
                $sql -> bindValue(4, $saldo);
                $sql -> bindValue(5, $idConta);
                $sql -> bindValue(6, UtilDAO::UsuarioLogado());   
                try{
                    $sql->execute();
                    return 1;
                }catch(Exception $ex){
                    echo $ex->getMessage();
                    return -1;
                }               
            }
    }

    public function ExcluirConta($idConta){
        if($idConta == ''){
            return 0 ;
        }
        $conexao = parent::retornarConexao();
        $comando_sql = 'delete from tb_conta where id_conta = ? and id_usuario = ?'; 
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql -> bindValue(1, $idConta);
        $sql -> bindValue(2, UtilDAO::UsuarioLogado());   
        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            echo $ex->getMessage();
            return -4;
        }  
        
    }
}