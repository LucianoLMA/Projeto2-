<?php

class ReservacolaboradorController {
    private $bd, $model;
    public $controleSql;
    public $dados;
    private $reservacolaboradorModel;
    
    function __construct() {
        require './protected/model/reservacolaboradorModel.php';
        $this->model = new ReservacolaboradorModel();
    }
    
    
    public function listar() {
        if(isset($_POST['placa']) != null){
            $idreserva = $_POST['idreserva'];
            $condicao = $_POST['condicao'];
            $atualizaDados = $this->model->updateReserva($idreserva, $condicao);
        }else{
            
            $acao = "painel.php?controle=reservacolaboradorController&acao=filtroReservacolaborador";
            
            //pesquisa pelo filtro
            if(isset($this->dados['fazBusca'])){
                $listaDados = $this->model->buscarFiltroReservaColaborador($this->dados['cpf']);
            }
            require './protected/view/reservacolaborador/formReservacolaborador.php';
        }
    }
    
    public function filtroReservacolaborador(array $dados){
            $dados['fazBusca'] = true;
            $this->dados = $dados;
            $this->listar();
            
    }
    
    public function buscar($id) {
        $reservacolaborador   = $this->model->buscar($id);
        $acao = 'painel.php?controle=reservacolaboradorController&acao=filtroReservacolaborador';
        require './protected/view/reservacolaborador/formReservacolaborador.php';
    }
    
    public function listartodos(){
        $listaDados = $this->model->buscarTodos();
        require './protected/view/reservacolaborador/listReservacolaborador.php';
    }
}