<?php

class EstadoModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    public function buscarTodos() {
        $sql = "SELECT id, nomeestado, uf FROM estado order by nomeestado asc;";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }

}
