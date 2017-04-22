<?php

class VeiculoController {
    private $bd, $model;
    
    function __construct() {
        require './protected/model/veiculoModel.php';
        $this->model = new VeiculoModel();
    }
    
    public function novo() {
        $acao = 'painel.php?controle=veiculoController&acao=inserir';
        require './protected/view/veiculo/formVeiculo.php';
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
        require './protected/view/veiculo/listVeiculo.php';
    }
    
    public function buscar($id) {
        $veiculo = $this->model->buscar($id);
        $acao = 'painel.php?controle=veiculoController&acao=atualizar';
        require './protected/view/veiculo/formVeiculo.php';
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
    
    public function excluir($id){
        $r = $this->model->excluir($id);
        if($r){
            echo '<div class="alert alert-success">
                    Dados Removidos com <strong>Sucesso</strong>.
                  </div>';
        }else{
            echo '<div class="alert alert-danger">
                    Não foi possível excluir o Veículo.
                  </div>';
        }
        $this->listar();
    }
}