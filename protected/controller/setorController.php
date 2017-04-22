<?php

class SetorController {
    private $bd, $model;
    
    function __construct() {
        require './protected/model/setorModel.php';
        $this->model = new SetorModel();
    }
    
    public function novo() {
        $acao = 'painel.php?controle=setorController&acao=inserir';
        require './protected/view/setor/formSetor.php';
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
        require './protected/view/setor/listSetor.php';
    }
    
    public function buscar($id) {
        $setor = $this->model->buscar($id);
        $acao = 'painel.php?controle=setorController&acao=atualizar';
        require './protected/view/setor/formSetor.php';
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
                    Não foi possível excluir o Setor.
                  </div>';
        }
        $this->listar();
    }
}