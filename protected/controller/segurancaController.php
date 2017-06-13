<?php

class SegurancaController {
    private $bd, $model;
    private $segurancaModel;
    private $cidadeModel;
    
    function __construct() {
        require './protected/model/segurancaModel.php';
        require './protected/model/cidadeModel.php';
        $this->model = new SegurancaModel();
        $this->modelCidade = new CidadeModel();
    }
    
    public function novo() {
        $listaCidades  = $this->modelCidade->buscarTodos();
        $acao = 'painel.php?controle=segurancaController&acao=inserir';
        require './protected/view/seguranca/formSeguranca.php';
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
        require './protected/view/seguranca/listSeguranca.php';
    }
    
    public function buscar($id) {
        $seguranca   = $this->model->buscar($id);
        $listaCidades  = $this->modelCidade->buscarTodos();
        $acao = 'painel.php?controle=segurancaController&acao=atualizar';
        require './protected/view/seguranca/formSeguranca.php';
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
                    Não é possível excluir o Segurança, pois possui registros dependentes.
                  </div>';
        }
        $this->listar();
    }
}