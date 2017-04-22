<?php

require './config/config.php';

class Conexao {
    public $bd;
    
    function __construct() {
        $this->estabeleceConexao();
    }
    
    public function estabeleceConexao(){
        try{
            $this->bd = new PDO(BD_TIPO .':host='.BD_HOST
                    .';dbname='.BD_NOME, BD_USER, BD_SENHA);
        }  catch (PDOException $e){
            echo $e;
        }
    }    
}
