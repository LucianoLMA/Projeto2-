<?php
    include("../config/confloginrel.php");
    
    $cpf = $_SESSION['cpf'];
    $result = pg_query("select r.id as idreserva,
                                to_char(r.dataretprev, 'dd/MM/yyyy') as dataretornoprevisto,
                                to_char(r.horaretprev, 'HH24:MI') as horaretornoprevisto,
                               (select usu.cpf
                                  from reserva res
                                 inner join reservacolaborador resc
                                    on res.id = resc.idreserva
                                 inner join usuario usu
                                    on resc.idcolaborador = usu.id
                                 inner join colaborador col
                                    on col.idusuario = usu.id
                                 where usu.cpf = '$cpf'	
                                UNION 
                                select usua.cpf
                                  from reserva res
                                 inner join reservagerente resg
                                    on res.id = resg.idreserva
                                 inner join usuario usua
                                    on resg.idusuario = usua.id
                                 where usua.cpf = '$cpf') as cpf
                          from reserva r
                         where r.idstatus = 1");
    while ($registroreserva = pg_fetch_array($result)) {
        $idreserva = $registroreserva["idreserva"];
        $dataretorno = $registroreserva["dataretornoprevisto"];
        $horaretorno = $registroreserva["horaretornoprevisto"];
        $cpf = $registroreserva["cpf"];
        
        //Data atual
        date_default_timezone_set('America/Sao_Paulo');
        $horaatual =  date('H:i', time());
        $dataatual =  date('d/m/Y', time());
        
        //Remove ponto e barra
        $horaatualformatada = str_replace(":", "", $horaatual);
        $dataatualformatada = str_replace("/", "", $dataatual);
        $horaretornoformatada = str_replace(":", "", $horaretorno);
        $dataretornoformatada = str_replace("/", "", $dataretorno);
        
        if(($dataretornoformatada <= $dataatualformatada) && ($horaretornoformatada <= $horaatualformatada)){
          //Atualiza o Status 1 reservado para 4 nao compareceu
          $atualizareserva = "UPDATE reserva SET idstatus = 4 WHERE id = $idreserva";
          $executa= pg_query($atualizareserva);      
        }
    }
?>