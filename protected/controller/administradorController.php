<?php

class AdministradorController {
    private $bd, $model;
    private $usuarioModel;
    private $administradorModel;
    
    function __construct() {
        require './protected/model/administradorModel.php';
        require './protected/model/usuarioModel.php';
        $this->model = new AdministradorModel();
        $this->modelUsuario = new UsuarioModel();
    }
    
    public function novo() {
        $listaUsuario  = $this->modelUsuario->buscarTodos();
        $acao = 'painel.php?controle=administradorController&acao=inserir';
        require './protected/view/administrador/formAdministrador.php';
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
        require './protected/view/administrador/listAdministrador.php';
    }
    
    public function buscar($id) {
        $administrador   = $this->model->buscar($id);
        $listaUsuario  = $this->modelUsuario->buscarTodos();
        $acao = 'painel.php?controle=administradorController&acao=atualizar';
        require './protected/view/administrador/formAdministrador.php';
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
                    Não é possível excluir o Administrador, pois possui registros dependentes.
                  </div>';
        }
        $this->listar();
    }
}