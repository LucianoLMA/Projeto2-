<?php

class UsuarioModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    public function buscarTodos() {
        $sql = "SELECT id, (nome || ' ' || sobrenome) as nomeusuario FROM usuario order by nomeusuario asc;";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }

}
