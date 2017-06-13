<?php

class GerenteController {
    private $bd, $model;
    private $estadoModel;
    private $setorModel;
    private $cidadeModel;
    
    function __construct() {
        require './protected/model/estadoModel.php';
        require './protected/model/setorModel.php';
        require './protected/model/gerenteModel.php';
        require './protected/model/cidadeModel.php';
        $this->model = new GerenteModel();
        $this->modelEstados = new EstadoModel();
        $this->modelSetor = new SetorModel();
        $this->modelCidade = new CidadeModel();
    }
    
    public function novo() {
        $listaEstados = $this->modelEstados->buscarTodos();
        $listaSetores = $this->modelSetor->buscarTodos();
        $listaCidades = $this->modelCidade->buscarTodos();
        $acao = 'painel.php?controle=gerenteController&acao=inserir';
        require './protected/view/gerente/formGerente.php';
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
        require './protected/view/gerente/listGerente.php';
    }
    
    public function buscar($id) {
        $listaEstados = $this->modelEstados->buscarTodos();
        $listaSetores = $this->modelSetor->buscarTodos();
        $listaCidades = $this->modelCidade->buscarTodos();
        $gerente = $this->model->buscar($id);
        $acao = 'painel.php?controle=gerenteController&acao=atualizar';
        require './protected/view/gerente/formGerente.php';
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
                    Não é possível excluir o Gerente pois, possui registros dependentes.
                  </div>';
        }
        $this->listar();
    }
}