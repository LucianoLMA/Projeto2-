<?php

class RetornoveiculoModel extends Conexao {

    function __construct() {
        parent::__construct();
    }
    public function updateRetornoveiculo($idreserva, $kmretorno, $observacao, $condicao){
        //Grava com a hora atual
        date_default_timezone_set('America/Sao_Paulo');
        $horaretorno =  date('H:i', time());
        $dataretorno =  date('d/m/Y', time());
       
        $sqlatualiza = "UPDATE reserva SET idcondicao = $condicao,
                                           observacao = '$observacao',
                                           kmfinal = $kmretorno,
                                           dataretorno = '$dataretorno',
                                           horaretorno = '$horaretorno'
                                     WHERE id = $idreserva";
        $sqlatualizaretorno = $this->bd->prepare($sqlatualiza);
        $sqlatualizaretorno->execute();
        if($sqlatualizaretorno->execute() == 1){?>
            <script language="JavaScript"> 
                window.location="painel.php?controle=retornoveiculoController&acao=listartodos"; 
            </script> 
        <?php }
    }
    
    public function filtroRetornoveiculo($cpf) {
        $sql = "select v.placa,
                        r.destino,
                        r.motivo,
                        c.descricao,
                        r.kminicial,
                        r.kmfinal,
                        r.id as idreserva,
                        r.observacao
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
                        c.descricao as descricaocondicao,
                        r.kminicial,
                        r.kmfinal,
                        to_char(r.dataretorno, 'dd/MM/yyyy') as dataretorno,
                        r.horaretorno,
                        r.id as idreserva,
                        r.observacao
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
                  order by r.datasaidaprev asc;";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }
}