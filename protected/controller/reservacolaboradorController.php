<?php

class ReservacolaboradorController {
    private $bd, $model;
    public $controleSql;
    public $dados;
    
    function __construct() {
        require './protected/model/reservacolaboradorModel.php';
        $this->model = new ReservacolaboradorModel();
    }
    
    
    public function listar() {
        if(isset($_POST['placa']) != null){
            $idreserva = $_POST['idreserva'];
            $placa = $_POST['placa'];
            $destino = $_POST['destino'];
            $motivo = $_POST['motivo'];
            $condicao = $_POST['condicao'];
            $kmfinal = $_POST['kmfinal'];
            $atualizaDados = $this->model->updateReserva($idreserva, $condicao);
            
        }else{
            $acao = "painel.php?controle=reservacolaboradorController&acao=filtroReservacolaborador";
            
            # Executa uma busca pelo filtro de situacao
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
    
    public function listartodos(){
        $listaDados = $this->model->buscarTodos();
        require './protected/view/reservacolaborador/listReservacolaborador.php';
    }
}