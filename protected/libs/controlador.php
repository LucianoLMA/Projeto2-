<?php

require_once './protected/conexao.php';
Class Controlador extends Conexao{
    function __construct() {
        parent::__construct();
        
        if(isset($_GET['controle'])){
            $ctrlNome = $_GET['controle'];
            
            $arquivo  = './protected/controller/'.$ctrlNome.'.php';
            if(file_exists($arquivo)){
                
                require $arquivo;
                
                $controle = new $ctrlNome();              
                
                if($_GET['acao']=="novo" || $_GET['acao']=="listar" || $_GET['acao']=="listartodos"){
                    $controle->{$_GET['acao']}();
                }else if($_GET['acao']=="inserir" || $_GET['acao']=="atualizar" || $_GET['acao']=="bloquear"){
                    $controle->{$_GET['acao']}($_POST);
                }else if($_GET['acao']=="buscar" || $_GET['acao']=="excluir" || $_GET['acao']=="cancelarreserva"){
                    $controle->{$_GET['acao']}($_GET['id']);
                }else if($_GET['acao']=="filtroReservacolaborador" || $_GET['acao']=="filtroRetornoveiculo"){
                    $controle->{$_GET['acao']}($_POST);
                }else if($_POST['acao']=="filtroReservacolaborador" || $_POST['acao']=="filtroRetornoveiculo"){
                    $controle->{$_GET['acao']}($_POST);
                }
            }
        }else{?>
            <html>
                <head>
                    <link href="../../includes/css/style.css" rel="stylesheet">
                    <link href="../../includes/css/bootstrap.min.css" rel="stylesheet">
                    <link rel="stylesheet" href="../../includes/css/datatables.min.css">
                </head>
                
                <?php
                    $cpflogado = $_SESSION['cpf'];
                    
                    //Se for segurança nao pode incluir reserva, home dele eh a lista completa
                    $sqlverificatipousuario = "select tipousuario from usuario where cpf = '$cpflogado'";
                    $sqlverificatipo = $this->bd->prepare($sqlverificatipousuario);
                    $sqlverificatipo->execute();

                    if ($sqlverificatipo->rowCount() > 0) {
                        foreach ($sqlverificatipo as $rs){
                            $tipousuario = $rs["tipousuario"];
                        }
                    }
                    
                    if($tipousuario == 'S'){?>
                        <div id="fundo">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Relação de Todas as Reservas</div>
                                    <div class="table-responsive">
                                        <table class="table" id="example1">
                                            <thead>
                                                <th>Data Hora Saída</th>
                                                <th>Data Hora Retorno</th>
                                                <th>Km Inicial</th>
                                                <th>Km Final</th>
                                                <th>Motivo</th>
                                                <th>Destino</th>
                                                <th>Observação</th>
                                                <th>Status</th>
                                            </thead>
                                            <tbody>
                                            <?php
                                                
                                                $sqlseguranca = "select (to_char(r.datasaida, 'dd/MM/yyyy') || ' - ' || to_char(r.horasaida, 'HH24:MI')) as datahorasaida,
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
                                                $queryseguranca = $this->bd->query($sqlseguranca);
                                                if ($queryseguranca->rowCount() > 0) {
                                                        foreach ($queryseguranca as $rsseguranca) {
                                                             echo '<tr>';
                                                                echo '<td>' . $rsseguranca['datahorasaida'];
                                                                echo '<td>' . $rsseguranca['datahoraretorno'];
                                                                echo '<td>' . $rsseguranca['kminicial'];
                                                                echo '<td>' . $rsseguranca['kmfinal'];
                                                                echo '<td>' . $rsseguranca['motivo'];
                                                                echo '<td>' . $rsseguranca['destino'];
                                                                echo '<td>' . $rsseguranca['observacao'];
                                                                if($rsseguranca['status'] == 1){
                                                                    echo '<td style="padding-top: 5px;"><span class="label label-warning">RESERVADO</span></td>';
                                                                }else if($rsseguranca['status'] == 2){
                                                                    echo '<td style="padding-top: 5px;"><span class="label label-danger">CANCELADO</span></td>';
                                                                }else if($rsseguranca['status'] == 3){
                                                                    echo '<td style="padding-top: 5px;"><span class="label label-success">ATIVADO</span></td>';
                                                                }else if($rsseguranca['status'] == 4){
                                                                    echo '<td style="padding-top: 5px;"><span class="label label-default">NÃO COMPARECEU</span></td>';
                                                                }else if($rsseguranca['status'] == 5){
                                                                    echo '<td style="padding-top: 5px;"><span class="label label-primary">FINALIZADO</span></td>';
                                                                }
                                                                echo '</tr>';
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                   
                   
                   
                    if($tipousuario != 'S'){?>
                        <h2>Minhas Reservas</h2>
                        <hr/>
                        <a href="painel.php?controle=reservaController&acao=novo" class="btn btn-success" role="button">Incluir Reserva</a>
                   <?php }
                ?>
                
                
                <div class="table-responsive">
                <table class="table" id="example1">
                    <thead>
                        <th>Prev. de Saída</th>
                        <th>Prev. de Retorno</th>
                        <th>Motivo</th>
                        <th>Destino</th>
                        <th>Modelo</th>
                        <th>Placa</th>
                        <th>Veículo</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                            if( isset($_SERVER['HTTPS'] ) ) {
                                $prefixo = 'https://';
                            }else{
                                $prefixo = 'http://';
                            }
                            $cpflogado = $_SESSION['cpf'];
                            
                            //URL BASE
                            $urlbase = $prefixo . ''. $_SERVER['HTTP_HOST']. '/';
                            //busca reserva desse colaborador
                             $sqlcolaborador = "select v.modelo,
                                                       r.id,
                                                        (to_char(r.datasaidaprev, 'dd/MM/yyyy') || ' - ' || TO_CHAR(r.horasaidaprev, 'HH24:MI')) as datasaida,
                                                        (to_char(r.dataretprev, 'dd/MM/yyyy') || ' - ' || TO_CHAR(r.horaretprev, 'HH24:MI')) as dataretorno,
                                                        r.motivo,
                                                        r.idstatus  as status,
                                                        r.destino,
                                                        usu.cpf,
                                                        v.modelo,
                                                        v.placa,
                                                        ('$urlbase' || '' || v.caminhofoto || '' || v.nomefoto) as caminhonomefoto
                                                   from reservacolaborador rc
                                                  inner join colaborador co
                                                     on rc.idcolaborador = co.idusuario
                                                  inner join usuario usu
                                                     on co.idusuario = usu.id
                                                  inner join reserva r
                                                     on rc.idreserva = r.id
                                                  inner join veiculo v
                                                     on r.idveiculo = v.id
                                                  where usu.cpf = '$cpflogado'";
                            $querycolaborador = $this->bd->query($sqlcolaborador);
                            if ($querycolaborador->rowCount() > 0) {
                                foreach ($querycolaborador as $rs) {
                                    if($rs['cpf'] != ''){
                                        echo '<tr>';
                                            echo '<td>' . $rs['datasaida'] . '</td>';
                                            echo '<td>' . $rs['dataretorno'] . '</td>';
                                            echo '<td>' . $rs['motivo'] . '</td>';
                                            echo '<td>' . $rs['destino'] . '</td>';
                                            echo '<td>' . $rs['modelo'] . '</td>';
                                            echo '<td>' . $rs['placa'] . '</td>';
                                            echo '<td>' . '<img src = "' . $rs['caminhonomefoto'] . '" style="width: 120px; heigth: 80px;"' . '</td>';
                                            $status = $rs['status'];
                                            if($status != 2){
                                                $id = $rs['id'];
                                                echo "<td> <a onclick='cancelarreserva(\"cancelarreserva\",\"reservaController\",$id)' href='#'>"
                                                    . " <span class='glyphicon glyphicon-trash customDialog'> </span>"
                                                . "</a> </td>";
                                            }
                                        echo '</tr>';
                                    }
                                }
                            }else{
                                //busca reservas desse gerente 
                                $urlbase = $prefixo . ''. $_SERVER['HTTP_HOST']. '/';
                                $sqlgerente = "select vei.modelo,
                                                      r.id,
                                                      (to_char(r.datasaidaprev, 'dd/MM/yyyy') || ' - ' || TO_CHAR(r.horasaidaprev, 'HH24:MI')) as datasaida,
                                                      (to_char(r.dataretprev, 'dd/MM/yyyy') || ' - ' || TO_CHAR(r.horaretprev, 'HH24:MI')) as dataretorno,
                                                      r.motivo,
                                                      r.idstatus as status,
                                                      r.destino,
                                                      vei.modelo,
                                                      vei.placa,
                                                      usu.cpf,
                                                      ('$urlbase' || '' || vei.caminhofoto || '' || vei.nomefoto) as caminhonomefoto
                                                 from reservagerente rg
                                                inner join reserva r
                                                   on rg.idreserva = r.id  
                                                inner join veiculo vei
                                                   on r.idveiculo = vei.id
                                                inner join usuario usu
                                                   on rg.idusuario = usu.id
                                                where usu.cpf = '$cpflogado'";
                               $querygerente = $this->bd->query($sqlgerente);
                               if ($querygerente->rowCount() > 0) {
                                   foreach ($querygerente as $rs) {
                                       if($rs['cpf'] != ''){
                                           echo '<tr>';
                                               echo '<td>' . $rs['datasaida'] . '</td>';
                                               echo '<td>' . $rs['dataretorno'] . '</td>';
                                               echo '<td>' . $rs['motivo'] . '</td>';
                                               echo '<td>' . $rs['destino'] . '</td>';
                                               echo '<td>' . $rs['modelo'] . '</td>';
                                               echo '<td>' . $rs['placa'] . '</td>';
                                               $id = $rs['id'];
                                               echo '<td>' . '<img src = "' . $rs['caminhonomefoto'] . '" style="width: 120px; heigth: 80px;"' . '</td>';
                                               $status = $rs['status'];
                                               if($status != 2){
                                                    echo "<td> <a onclick='cancelarreserva(\"cancelarreserva\",\"reservaController\",$id)' href='#'>"
                                                     . " <span class='glyphicon glyphicon-trash customDialog'> </span>"
                                                 . "</a> </td>";
                                               }
                                            echo '</tr>';
                                       }
                                   }
                               }
                            }
                        ?>
                    </tbody>
                </table>
            </div>    
            </html>
        <?php }
    }
}
?>