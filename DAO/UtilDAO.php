<?php

    // Futuramente, aqui nesta Classe será desenvolvido todo o processo de validação de sessões, loog do usuario e deslog!

    class UtilDAO{
        // public static function UsuarioLogado(){
           // return 1; // Esta function simula um usuário logado na aplicação!
        // }

        // 1º: Inicializa a construção da Sessão de Usuario Logado!
        private static function IniciarSessao(){
            if(!isset($_SESSION)){
                session_start();
            }
        }

        // 2º: Esta function vai chamar a function IniciarSessao para construir o log.
        public static function CriarSessao($cod, $nome){
            // Comando self chama uma Função Estática
            self::IniciarSessao();
    
            // Comando que identifica o numero e o nome do usuário que está realizando o acesso ao sistema
            $_SESSION['cod'] = $cod;
            $_SESSION['nome'] = $nome;
        }

        // 3º: Este processo chama a function anterior e identifica o NOME DO USUÁRIO que vai ser logadp.
        public static function NomeLogado(){
            self::IniciarSessao();
            return $_SESSION['nome'];
        }        

        // 4º: Este processo chama a function anterior e identifica o ID que vai ser logadp.
        public static function UsuarioLogado(){
            self::IniciarSessao();
            return $_SESSION['cod'];
        }

        // 5º: Este processo destroi toda a permissão construida através das sessões, removendo o USUÁRIO da aplicação.
        public static function Deslogar(){
            self::IniciarSessao();

            unset($_SESSION['cod']);
            unset($_SESSION['nome']);

            header('location: index.php');
            exit;
        }

        // 6º: Esta function realiza uma verificação se, existe dados do usuário na sessão, caso não, retorna para a tela de login (index.php).
        public static function VerificarLogado(){
            self::IniciarSessao();
            if(!isset($_SESSION['cod']) || $_SESSION['cod'] == ''){
    
                header('location: index.php');
                exit;
            }
        }
    }

?>