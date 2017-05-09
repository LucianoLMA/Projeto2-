<?php

class ReservaController {
    private $bd, $model;
    private $veiculoModel;
    
    function __construct() {
        require './protected/model/reservaModel.php';
        require './protected/model/veiculoModel.php';
        $this->model = new ReservaModel();
        $this->modelVeiculos = new VeiculoModel();
    }
    
    public function novo() {
        $listaVeiculos  = $this->modelVeiculos->buscarTodos();
        $acao = 'painel.php?controle=reservaController&acao=inserir';
        require './protected/view/reserva/formReserva.php';
    }
    
    public function inserir(array $dados) {
        $r = $this->model->inserir($dados);
        if($r){
            echo '<div class="alert alert-success">
                    Dados cadastrados com <strong>Sucesso</strong>.
                  </div>';
        }else{
            echo '<div class="alert alert-danger">
                    Não foi possível cadastrar os dados.
                  </div>';
        }
        $this->listar();
    }
    
    public function listar() {
        $listaDados = $this->model->buscarTodos();
        require './protected/view/reserva/listReserva.php';
    }
    
    public function buscar($id) {
        $reserva = $this->model->buscar($id);
        $acao = 'painel.php?controle=reservaController&acao=atualizar';
        require './protected/view/reserva/formReserva.php';
    }
    
    public function atualizar(array $dados) {
        $r = $this->model->atualizar($dados);
        if($r){
            echo '<div class="alert alert-success">
                    Dados atualizados com <strong>Sucesso</strong>.
                  </div>';
        }else{
            echo '<div class="alert alert-danger">
                   Não foi possível atualizar os dados.
                  </div>';
        }
        $this->listar();
    }
    
    public function cancelarreserva($id){
        $r = $this->model->cancelarreserva($id);
        if($r){
            echo '<div class="alert alert-success">
                    Reserva Cancelada com <strong>Sucesso</strong>.
                  </div>';
        }else{
            echo '<div class="alert alert-danger">
                    Não é permitido cancelar a reserva antes de 24 horas da saída.
                  </div>';
        }
        $this->listar();
    }
}