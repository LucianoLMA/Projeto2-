<?php

class SetorModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    public function inserir(array $dados) {
    	$sql = "INSERT INTO setor(nome) VALUES(:nome)";
        unset($dados['id']);
        $query = $this->bd->prepare($sql);
        return $query->execute($dados);
    }

    public function buscarTodos() {
    	$sql = "select id,
                       nome as nomesetor
                  from setor
                  order by nome asc;";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }

    public function buscar($id) {
        $sql = "SELECT id, nome FROM setor WHERE id = :id";
        $query = $this->bd->prepare($sql);
        $query->execute(array('id' => $id));

        return $query->fetch();
    }

    public function atualizar(array $dados) {
        $sql = "UPDATE setor 
                   SET nome = :nome
                 WHERE id = :id";
        $query = $this->bd->prepare($sql);
        return $query->execute($dados);
    }

    public function excluir($id) {
        $sql = "DELETE FROM setor WHERE id = :id";
        $query = $this->bd->prepare($sql);
        return $query->execute(array('id' => $id));
    }
}