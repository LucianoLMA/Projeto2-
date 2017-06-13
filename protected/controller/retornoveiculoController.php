<?php

class RetornoveiculoController {
    private $bd, $model;
    public $controleSql;
    public $dados;
    private $retornoveiculoModel;
    
    function __construct() {
        require './protected/model/retornoveiculoModel.php';
        $this->model = new RetornoveiculoModel();
    }
    
    
    public function listar() {
        if(isset($_POST['placa']) != null){
            $idreserva = $_POST['idreserva'];
            $observacao = $_POST['observacao'];
            $condicao = $_POST['condicao'];
            $kmret = $_POST['kmretorno'];
            $kmretorno = str_replace("," , "" , $kmret);
            if($observacao == ''){
                $observacao = null;
            }else{
                $observacao = $observacao;
            }
            $atualizaDados = $this->model->updateRetornoveiculo($idreserva, $kmretorno, $observacao, $condicao);
            
        }else{
            $acao = "painel.php?controle=retornoveiculoController&acao=filtroRetornoveiculo";
            
            // busca pelo cpf
            if(isset($this->dados['fazBusca'])){
                $listaDados = $this->model->filtroRetornoveiculo($this->dados['cpf']);
            }
            require './protected/view/retornoveiculo/formRetornoveiculo.php';
        }
    }
    
    public function filtroRetornoveiculo(array $dados){
            $dados['fazBusca'] = true;

            $this->dados = $dados;

            $this->listar();
    }
    
    public function buscar($id) {
        $retornoveiculo   = $this->model->buscar($id);
        $acao = 'painel.php?controle=retornoveiculoController&acao=filtroRetornoveiculo';
        require './protected/view/retornoveiculo/formRetornoveiculo.php';
    }
    
    public function listartodos(){
        $listaDados = $this->model->buscarTodos();
        require './protected/view/retornoveiculo/listRetornoveiculo.php';
    }
}