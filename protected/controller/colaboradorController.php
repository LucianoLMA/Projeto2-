<?php

class ColaboradorController {
    private $bd, $model;
    private $gerenteModel;
    private $setorModel;
    private $cidadeModel;
    
    function __construct() {
        require './protected/model/colaboradorModel.php';
        require './protected/model/gerenteModel.php';
        require './protected/model/setorModel.php';
        require './protected/model/cidadeModel.php';
        $this->model = new ColaboradorModel();
        $this->modelGerente = new GerenteModel();
        $this->modelSetor = new SetorModel();
        $this->modelCidade = new CidadeModel();
    }
    
    public function novo() {
        $listaCidades  = $this->modelCidade->buscarTodos();
        $listaGerentes = $this->modelGerente->buscarTodos();
        $listaSetores  = $this->modelSetor->buscarTodos();
        $acao = 'painel.php?controle=colaboradorController&acao=inserir';
        require './protected/view/colaborador/formColaborador.php';
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
        require './protected/view/colaborador/listColaborador.php';
    }
    
    public function buscar($id) {
        $colaborador   = $this->model->buscar($id);
        $listaSetores  = $this->modelSetor->buscarTodos();
        $listaCidades  = $this->modelCidade->buscarTodos();
        $listaGerentes = $this->modelGerente->buscarTodos();
        $acao = 'painel.php?controle=colaboradorController&acao=atualizar';
        require './protected/view/colaborador/formColaborador.php';
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
                    Não é possível excluir o Colaborador, pois possui registros dependentes.
                  </div>';
        }
        $this->listar();
    }
}