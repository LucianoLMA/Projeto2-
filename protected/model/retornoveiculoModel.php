<?php

class RetornoveiculoModel extends Conexao {

    function __construct() {
        parent::__construct();
    }
    public function updateRetornoveiculo($idreserva, $kmretorno, $observacao, $condicao){
        date_default_timezone_set('America/Sao_Paulo');
        $horaretorno =  date('H:i', time());
        $dataretorno =  date('d/m/Y', time());
        
        $status = 5;
        $sqlatualizareserva = "UPDATE reserva SET idstatus = $status
                                      WHERE id = $idreserva";
        $sqlatualizareservastatus = $this->bd->prepare($sqlatualizareserva);
        $verificaatualizacaostatus = $sqlatualizareservastatus->execute();
        
        if($verificaatualizacaostatus == 1){
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
        }
        
    
    public function filtroRetornoveiculo($cpf) {
        $sqlcolaborador = "select v.placa,
                                  r.destino,
                                  r.motivo,
                                  c.descricao,
                                  r.kminicial,
                                  r.kmfinal,
                                  r.observacao,
                                  r.id as idreserva,
                                  (to_char(r.datasaida, 'dd/MM/yyyy')) as datasaida,
                                  (to_char(r.horasaida, 'HH24:MI')) as horasaida,
                                  r.id as idreserva,
                                  r.observacao
                             from reservacolaborador rc
                            inner join reserva r
                               on rc.idreserva = r.id
                            inner join status st
                               on st.id = r.idstatus
                            inner join veiculo v
                               on r.idveiculo = v.id
                            inner join condicaoveiculo c
                               on r.idcondicao = c.id
                            inner join colaborador co
                               on co.idusuario = rc.idcolaborador
                            inner join usuario usu
                               on co.idusuario = usu.id
                              and r.datasaida is not null
                            where usu.cpf = '$cpf'
                              and st.id = 3
                                  limit 10";
        $querycolaborador = $this->bd->query($sqlcolaborador);
        $contemregistrocolaborador = $querycolaborador->fetchAll();
        if(count($contemregistrocolaborador) > 0){
            
            return $contemregistrocolaborador;
        }else{
            $sqlgerente = "select v.placa,
                                  r.destino,
                                  r.motivo,
                                  c.descricao,
                                  r.kminicial,
                                  r.kmfinal,
                                  r.id as idreserva,
                                  (to_char(r.datasaida, 'dd/MM/yyyy')) as datasaida,
                                  (to_char(r.horasaida, 'HH24:MI')) as horasaida,
                                  r.id as idreserva,
                                  r.observacao
                             from reservagerente rg
		            inner join reserva r
			       on rg.idreserva = r.id
                            inner join status st
                               on st.id = r.idstatus
			    inner join veiculo v
			       on r.idveiculo = v.id
			    inner join condicaoveiculo c
			       on r.idcondicao = c.id
			    inner join gerente ge
			       on ge.idusuario = rg.idusuario
			    inner join usuario usu
			       on ge.idusuario = usu.id
                              and r.datasaida is not null
                            where usu.cpf = '$cpf'
                              and st.id = 3
                                    limit 10";
            $querygerente = $this->bd->query($sqlgerente);
            $contemregistrogerente = $querygerente->fetchAll();
            if(count($contemregistrogerente) > 0){
                
                return $contemregistrogerente;
            }
        }
    }
    
    public function buscar($id) {
         $sql = "select r.id as idreserva,
                        r.kminicial,
                        r.kmfinal,
                        r.motivo,
                        r.destino,
                        v.placa,
                        r.observacao,
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
                    and r.datasaida is not null
                  where r.id = :id";
         $query = $this->bd->prepare($sql);
         $query->execute(array('id' => $id));
         return $query->fetch();
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
                  where r.dataretorno is not null
                  order by r.datasaidaprev desc;";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }
}