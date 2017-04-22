<?php

class UsuarioController {
    private $bd, $model;
    
    function __construct() {
        require './protected/model/usuarioModel.php';
        $this->model = new UsuarioModel();
    }
    
    public function novo() {
        $acao = 'index.php?controle=usuarioController&acao=inserir';
        require './protected/view/usuario/formUsuario.php';
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
        require './protected/view/usuario/listUsuario.php';
    }
    
    public function buscar($id) {
        $usuario = $this->model->buscar($id);
        $acao = 'index.php?controle=usuarioController&acao=atualizar';
        require './protected/view/usuario/formUsuario.php';
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
                    Dados removidos com <strong>Sucesso</strong>.
                  </div>';
        }else{
            echo '<div class="alert alert-danger">
                    Não foi possível excluir o Usuário.
                  </div>';
        }
        $this->listar();
    }
}