<?php

class RetornoveiculoController {
    private $bd, $model;
    public $controleSql;
    public $dados;
    
    function __construct() {
        require './protected/model/retornoveiculoModel.php';
        $this->model = new RetornoveiculoModel();
    }
    
    
    public function listar() {
        if(isset($_POST['placa']) != null){
            $idreserva = $_POST['idreserva'];
            $placa = $_POST['placa'];
            $observacao = $_POST['observacao'];
            $motivo = $_POST['motivo'];
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
            
            # Executa uma busca pelo filtro de situacao
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
    
    public function listartodos(){
        $listaDados = $this->model->buscarTodos();
        require './protected/view/retornoveiculo/listRetornoveiculo.php';
    }
}