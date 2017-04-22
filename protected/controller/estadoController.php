<?php

class EstadoController {
    private $bd, $model;
    
    function __construct() {
        require './protected/model/estadoModel.php';
        $this->model = new EstadoModel();
    }
}