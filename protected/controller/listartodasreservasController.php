<?php

class ListartodasreservasController {
    private $bd, $model;
    
    function __construct() {
        require './protected/model/listartodasreservasModel.php';
        $this->model = new ListartodasreservasModel();
    }
    
    public function listar() {
        $listaDados = $this->model->buscarTodos();
        require './protected/view/listartodasreservas/listTodasReservas.php';
    }
}