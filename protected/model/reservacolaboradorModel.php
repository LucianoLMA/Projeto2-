<?php

class ReservacolaboradorModel extends Conexao {

    function __construct() {
        parent::__construct();
    }
    public function updateReserva($idreserva, $condicao){
        date_default_timezone_set('America/Sao_Paulo');
        $horasaida =  date('H:i', time());
        $datasaida =  date('d/m/Y', time());
        
        $sqlatualiza = "UPDATE reserva SET idcondicao = $condicao,
                                           horasaida = '$horasaida',
                                           datasaida = '$datasaida'
                                     WHERE id = $idreserva";
        $sqlatualizareserva = $this->bd->prepare($sqlatualiza);
        $sqlatualizareserva->execute();
        if($sqlatualizareserva->execute() == 1){?>
            <script language="JavaScript"> 
                window.location="painel.php?controle=reservacolaboradorController&acao=listartodos"; 
            </script> 
        <?php }
    }

    public function buscarFiltroReservaColaborador($cpf) {
        $sql = "select v.placa,
                        r.destino,
                        r.motivo,
                        c.descricao,
                        r.kmfinal,
                        r.id as idreserva
                   from reserva r
                  inner join veiculo v
                     on r.idveiculo = v.id
                  inner join condicaoveiculo c
                     on r.idcondicao = c.id
                  inner join reservacolaborador rc
                     on rc.idreserva = r.id
                  inner join colaborador co
                     on rc.idcolaborador = co.id
                  inner join usuario us
                     on co.idusuario = us.id
                  where us.cpf = '$cpf'";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }
    
    public function buscarTodos() {
        $sql = "select v.placa,
                        r.destino,
                        r.motivo,
                        c.descricao,
                        r.kmfinal,
                        r.id as idreserva,
                        to_char(r.datasaida, 'dd/MM/yyyy') as datasaida,
                        r.horasaida
                   from reserva r
                  inner join veiculo v
                     on r.idveiculo = v.id
                  inner join condicaoveiculo c
                     on r.idcondicao = c.id
                  inner join reservacolaborador rc
                     on rc.idreserva = r.id
                  inner join colaborador co
                     on rc.idcolaborador = co.id
                  inner join usuario us
                     on co.idusuario = us.id
                  order by r.datasaidaprev";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }
}