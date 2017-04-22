<?php

class CidadeController {
    private $bd, $model;
    private $estadoModel;
    private $cidadeModel;
    
    function __construct() {
        require './protected/model/cidadeModel.php';
        require './protected/model/estadoModel.php';
        $this->model = new CidadeModel();
        $this->modelEstados = new EstadoModel();
    }
    
    public function novo() {
        $listaEstados  = $this->modelEstados->buscarTodos();
        $acao = 'painel.php?controle=cidadeController&acao=inserir';
        require './protected/view/cidade/formCidade.php';
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
        require './protected/view/cidade/listCidade.php';
    }
    
    public function buscar($id) {
        $cidade   = $this->model->buscar($id);
        $listaEstados  = $this->modelEstados->buscarTodos();
        $acao = 'painel.php?controle=cidadeController&acao=atualizar';
        require './protected/view/cidade/formCidade.php';
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
                    Não foi possível excluir a Cidade.
                  </div>';
        }
        $this->listar();
    }
}