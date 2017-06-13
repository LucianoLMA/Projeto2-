<?php

class ListartodasreservasModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    public function buscarTodos() {
    	$sql = "select (to_char(r.datasaida, 'dd/MM/yyyy') || ' - ' || to_char(r.horasaida, 'HH24:MI')) as datahorasaida,
                        (to_char(r.dataretorno, 'dd/MM/yyyy') || ' - ' || to_char(r.horaretorno, 'HH24:MI')) as datahoraretorno,
                        r.kminicial,
                        r.kmfinal,
                        r.motivo,
                        r.destino,
                        r.observacao,
                        st.id as status
                   from reserva r
                  inner join condicaoveiculo cond
                     on r.idcondicao = cond.id
                  inner join status st
                     on r.idstatus = st.id
                  order by r.datasaida, r.horasaida, idstatus asc;";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }
}