<?php

class ReservacolaboradorModel extends Conexao {

    function __construct() {
        parent::__construct();
    }
    public function updateReserva($idreserva, $condicao){
        date_default_timezone_set('America/Sao_Paulo');
        $horasaida =  date('H:i', time());
        $datasaida =  date('d/m/Y', time());
        $status = 3;
        
        $sqlatualiza = "UPDATE reserva SET idcondicao = $condicao,
                                           horasaida  = '$horasaida',
                                           datasaida  = '$datasaida',
                                           idstatus   = $status
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
           // colaborador
          $sqlcolaborador = "select v.placa,
                                    r.destino,
                                    r.motivo,
                                    c.descricao,
                                    r.kmfinal,
                                    r.id as idreserva,
                                    (to_char(r.datasaidaprev, 'dd/MM/yyyy')) as datasaidaprev,
                                    (to_char(r.horasaidaprev, 'HH24:MI')) as horasaidaprev,
                                    r.id as idreserva,
                                    st.id as status
                               from reservacolaborador rc
                              inner join reserva r
                                 on rc.idreserva = r.id
                              inner join veiculo v
                                 on r.idveiculo = v.id
                              inner join condicaoveiculo c
                                 on r.idcondicao = c.id
                              inner join colaborador co
                                 on co.idusuario = rc.idcolaborador
                              inner join usuario usu
                                 on co.idusuario = usu.id
                              inner join status st
                                 on r.idstatus = st.id
                              where usu.cpf = '$cpf'
                                and st.id = 1
                                    limit 10";
        $querycolaborador = $this->bd->query($sqlcolaborador);
        $contemregistrocolaborador = $querycolaborador->fetchAll();
        if(count($contemregistrocolaborador) > 0){
            return $contemregistrocolaborador;
        }else{
            //gerente
         $sqlgerente = "select v.placa,
                               r.destino,
                               r.motivo,
                               c.descricao,
                               r.kmfinal,
                               r.id as idreserva,
                               (to_char(r.datasaidaprev, 'dd/MM/yyyy')) as datasaidaprev,
                               (to_char(r.horasaidaprev, 'HH24:MI')) as horasaidaprev,
                               CASE WHEN st.id=1 THEN '1'
                                    WHEN st.id=2 THEN '2'
                                    WHEN st.id=3 THEN '3'
                                    WHEN st.id=4 THEN '4'
                                  END as status
                          from reservagerente rg
                         inner join reserva r
                            on rg.idreserva = r.id
                         inner join veiculo v
                            on r.idveiculo = v.id
                         inner join condicaoveiculo c
                            on r.idcondicao = c.id
                         inner join gerente ge
                            on ge.idusuario = rg.idusuario
                         inner join usuario usu
                            on ge.idusuario = usu.id
                         inner join status st
                            on r.idstatus = st.id
                         where usu.cpf = '$cpf'
						 and st.id = 1
                               limit 10";
         
        $querygerente = $this->bd->query($sqlgerente);
        $contemregistrogerente = $querygerente->fetchAll();
            if(count($contemregistrogerente) > 0){
                return $contemregistrogerente;
            }
        }
    }
    
    //Pegar Informações da reserva conforme parâmetro do id da reserva
    public function buscar($id) {
         $sql = "select r.id as idreserva,
                        r.kmfinal,
                        r.motivo,
                        r.destino,
                        v.placa,
                        c.descricao,
                        (select usu.cpf
                           from reserva res
                          inner join reservacolaborador resc
                             on res.id = resc.idreserva
                          inner join usuario usu
                             on resc.idcolaborador = usu.id
                          inner join colaborador col
                             on col.idusuario = usu.id
                          where res.id = :id	
                         UNION 
                         select usua.cpf
                           from reserva res
                          inner join reservagerente resg
                             on res.id = resg.idreserva
                          inner join usuario usua
                             on resg.idusuario = usua.id
                          where res.id = :id) as cpf
                   from reserva r
                  inner join veiculo v
                     on r.idveiculo = v.id
                  inner join condicaoveiculo c
                     on r.idcondicao = c.id
                  where r.id = :id";
         $query = $this->bd->prepare($sql);
         $query->execute(array('id' => $id));
         return $query->fetch();
    }
    
    public function buscarTodos() {
        $sql = "select v.placa,
                       r.destino,
                       r.motivo,
                       c.descricao,
                       r.kmfinal,
                       r.id as idreserva,
                       to_char(r.datasaida, 'dd/MM/yyyy') as datasaida,
                       r.horasaida,
                       st.id as status
                  from reserva r
                  left join status st
                    on r.idstatus = st.id
                  left join veiculo v
                    on r.idveiculo = v.id
                  left join condicaoveiculo c
                    on r.idcondicao = c.id
                  left join reservacolaborador rc
                    on rc.idreserva = r.id
                  left join colaborador co
                    on rc.idcolaborador = co.id
                  left join usuario us
                    on co.idusuario = us.id
                 order by r.datasaidaprev";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }
}