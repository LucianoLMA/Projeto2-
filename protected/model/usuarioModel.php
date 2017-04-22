<?php

class UsuarioModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    }

    public function excluir($id) {
        $sql = "DELETE FROM usuario WHERE id = :id";
        $query = $this->bd->prepare($sql);
        return $query->execute(array('id' => $id));
    }
}