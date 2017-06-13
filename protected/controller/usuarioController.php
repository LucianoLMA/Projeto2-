<?php

class UsuarioController {
    private $bd, $model;
    
    function __construct() {
        require './protected/model/usuarioModel.php';
        $this->model = new UsuarioModel();
    }
}