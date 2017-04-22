<?php

require_once './protected/conexao.php';

Class Controlador{
   
    function __construct() {
        
        if(isset($_GET['controle'])){
            $ctrlNome = $_GET['controle'];
            
            $arquivo  = './protected/controller/'.$ctrlNome.'.php';
            
            if(file_exists($arquivo)){ ?>
                <?php
                require $arquivo;
                
                $controle = new $ctrlNome();                
                
                if($_GET['acao']=="novo" || $_GET['acao']=="listar"){
                    $controle->{$_GET['acao']}();
                }else if($_GET['acao']=="inserir" || $_GET['acao']=="atualizar" || $_GET['acao']=="bloquear"){
                    $controle->{$_GET['acao']}($_POST);
                }else if($_GET['acao']=="buscar" || $_GET['acao']=="excluir"){
                    $controle->{$_GET['acao']}($_GET['id']);
                }
            }
        }
    }
} ?>