<?php

class ReservaModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    public function inserir(array $dados) {
        $cpfusuarioreserva = $dados['cpf'];
        
        $idveiculo = $_POST['idveiculo'];
        //
        $verificareservaveiculo = "select count(*) as reservado 
                                     from reserva 
                                    where idveiculo = $idveiculo
                                      and dataretorno is null 
                                      and horaretorno is null
                                      and datasaida is not null
                                      and horasaida is not null;";
        $sqlreservaveiculo = $this->bd->prepare($verificareservaveiculo);
        $sqlreservaveiculo->execute();
        if ($sqlreservaveiculo->rowCount() > 0) {
            foreach ($sqlreservaveiculo as $rs) {
                    $possuireserva = $rs["reservado"];
            }
        }
                
        if($possuireserva > 0){
            
            echo "<script>alert('Este Veículo já encontra-se reservado');</script>";
            
            echo "<body onload='window.history.back();'>";
        }else{
            
            //Pegar data atual
            date_default_timezone_set('America/Sao_Paulo');
            $dataatual = date('d/m/Y');

            $idveiculo = $_POST['idveiculo'];
            $datasaidaprev = $_POST['datasaidaprev'];
            $horasaidaprev = $_POST['horasaidaprev'];
            $dataretprev = $_POST['dataretprev'];
            $horaretprev = $_POST['horaretprev'];
            $motivo = $_POST['motivo'];
            $destino = $_POST['destino'];
            
            
            //Verifica a hora e data
            if($datasaidaprev > $dataretprev){
                echo "<script>alert('A Data de Saída Prevista não pode ser maior que a Data de Retorno');</script>";
                echo "<body onload='window.history.back();'>";
            }else if($horasaidaprev > $horaretprev){
                if($datasaidaprev == $dataretprev){
                    echo "<script>alert('A Data e a Hora de Saída Prevista não pode ser maior que a Data e a Hora de Retorno');</script>";
                    echo "<body onload='window.history.back();'>";
                }
            }else if($datasaidaprev < $dataatual){
                echo "<script>alert('A Data de Saída Prevista não pode ser menor que a Data Atual');</script>";
                    echo "<body onload='window.history.back();'>";
            }else{
                
                $consultainformacoesveiculo = "select kminicial, kmfinal from veiculo where id = " . $idveiculo;

                $sqlconsultainformacoesveiculo = $this->bd->prepare($consultainformacoesveiculo);
                $sqlconsultainformacoesveiculo->execute();

                if ($sqlconsultainformacoesveiculo->rowCount() > 0) {
                    foreach ($sqlconsultainformacoesveiculo as $rs){
                        $kminicial = $rs["kminicial"];
                        $kmfinal = $rs["kmfinal"];
                    }
                }
                
                //Verifique se a hora de saida prevista é menor que a hora de retorno prevista
                $verificareservasaidaprevultimo = "select to_char(horaretprev, 'HH24mi') as horaretprevultimo,
                                                          to_char(dataretprev, 'ddMMyyyy') as dataretprevultimo
                                                     from reserva 
                                                    where idveiculo = $idveiculo
                                                    group by horaretprev, dataretprev;";
                $sqlverificareservaprevultimo = $this->bd->prepare($verificareservasaidaprevultimo);
                $sqlverificareservaprevultimo->execute();
                if ($sqlverificareservaprevultimo->rowCount() > 0) {
                    foreach ($sqlverificareservaprevultimo as $rs) {
                            $horaretprevconsulta = $rs["horaretprevultimo"];
                            $dataretprevconsulta = $rs["dataretprevultimo"];
                    }
                }else{
                    date_default_timezone_set('America/Sao_Paulo');
                    $horaretprevconsulta = date('Hi', time());
                    $dataretprevconsulta = date('dmY', time());
                }
                
                $horaretformatado = str_replace(":", "", $horaretprev);
                $horaretprevformato = str_replace(":", "", $horaretprevconsulta);
                $dataretformatado = str_replace("/", "", $dataretprev);
                $dataretprevformato = str_replace("/", "", $dataretprevconsulta);
                $horasaidaprevformato = str_replace(":", "", $horasaidaprev);
                $datasaidaprevformato = str_replace("/", "", $datasaidaprev);
                
                if(($datasaidaprevformato >= $dataretprevformato) || ($horasaidaprevformato >= $horaretprevformato) || ($datasaidaprevformato >= $dataretprevformato) || ($horasaidaprevformato >= $horaretprevformato)) {
                    
                    $verificareservacolaborador = "select usu.cpf as cpf,
                                                          to_char(rs.horaretprev, 'HH24mi') as horaretprev,
                                                          to_char(rs.dataretprev, 'ddMMyyyy') as dataretprev
                                                     from reservacolaborador res
                                                    inner join colaborador col
                                                       on res.idcolaborador = col.idusuario
                                                    inner join usuario usu
                                                       on col.idusuario = usu.id 
                                                    inner join reserva rs
                                                       on res.idreserva = rs.id  
                                                    where usu.cpf = '$cpfusuarioreserva'";
                    $sqlverificareservacolaborador = $this->bd->prepare($verificareservacolaborador);
                    if ($sqlverificareservacolaborador->rowCount() > 0) {
                        foreach ($sqlverificareservacolaborador as $rs) {
                            if($rs['cpf'] != ''){
                                $horaretprevconsulta = $rs['horaretprev'];
                                $dataretprevconsulta = $rs['dataretprev'];
                            }
                        }
                    }else{
                        
                        $verificareservagerente = "select usu.cpf as cpf,
                                                          to_char(rs.horaretprev, 'HH24mi') as horaretprev,
                                                          to_char(rs.dataretprev, 'ddMMyyyy') as dataretprev
                                                     from reservagerente rg
                                                    inner join usuario usu
                                                       on rg.idusuario = usu.id
                                                    inner join reserva rs
                                                       on rg.idreserva = rs.id 
                                                    where usu.cpf = '$cpfusuarioreserva'";
                        $sqlverificareservagerente = $this->bd->prepare($verificareservagerente);
                        if ($sqlverificareservagerente->rowCount() > 0) {
                            foreach ($sqlverificareservagerente as $rs) {
                                if($rs['cpf'] != ''){
                                    $horaretprevconsulta = $rs['horaretprev'];
                                    $dataretprevconsulta = $rs['dataretprev'];
                                }
                            }
                        }
                    }
                    if(($horaretprevconsulta >= $horaretprevconsulta) && ($dataretprevconsulta >= $dataretprevconsulta)){
                        $sql = "INSERT INTO reserva(idveiculo, 
                                                    datasaidaprev, 
                                                    horasaidaprev, 
                                                    dataretprev, 
                                                    horaretprev, 
                                                    motivo, 
                                                    kminicial,
                                                    kmfinal,
                                                    destino,
                                                    idcondicao,
                                                    idstatus) VALUES($idveiculo, 
                                                                    '$datasaidaprev', 
                                                                    '$horasaidaprev', 
                                                                    '$dataretprev', 
                                                                    '$horaretprev', 
                                                                    '$motivo', 
                                                                     $kminicial,
                                                                     $kmfinal,
                                                                    '$destino',
                                                                    1,
                                                                    1)";
                        unset($dados['id']);
                        unset($dados['idveiculo']);
                        unset($dados['datasaidaprev']);
                        unset($dados['horasaidaprev']);
                        unset($dados['dataretprev']);
                        unset($dados['horaretprev']);
                        unset($dados['motivo']);
                        unset($dados['kminicial']);
                        unset($dados['kmfinal']);
                        unset($dados['destino']);
                        unset($dados['idcondicao']);
                        unset($dados['idstatus']);
                        unset($dados['cpf']);
                        $query = $this->bd->prepare($sql);
                        $queryinsert = $query->execute($dados);

                        if($queryinsert == 1){
                            $cpf = $_POST['cpf'];
                            
                            $registroreserva = "select max(id) as idreserva from reserva";
                            $sqlregistroreserva = $this->bd->prepare($registroreserva);
                            $sqlregistroreserva->execute();
                            if ($sqlregistroreserva->rowCount() > 0) {
                                foreach ($sqlregistroreserva as $rs) {
                                        $idreserva = $rs["idreserva"];
                                }
                            }

                            //id do col pelo cpf
                            $registrousuario = "select u.id as idusuario
                                                  from usuario u 
                                                 where cpf = '$cpf'";

                            $sqlregistrousuario = $this->bd->prepare($registrousuario);
                            $sqlregistrousuario->execute();
                            if ($sqlregistrousuario->rowCount() > 0) {
                                    foreach ($sqlregistrousuario as $rs) {
                                            $idusuario = $rs["idusuario"];
                                    }
                            }

                            //Ve se o ID DO USUÁRIO é Colaborador ou Gerente
                            $verificaidusuario = "select g.idusuario as usuariogerente,
                                                         c.idusuario as usuariocolaborador
                                                    from usuario u
                                                    left join gerente g
                                                      on g.idusuario = u.id
                                                    left join colaborador c
                                                      on c.idusuario = u.id
                                                    where u.id = $idusuario";

                            $sqlregistroverificausuario = $this->bd->prepare($verificaidusuario);
                            $sqlregistroverificausuario->execute();
                            if ($sqlregistroverificausuario->rowCount() > 0) {
                                    foreach ($sqlregistroverificausuario as $rs) {
                                            $usuariogerente = $rs["usuariogerente"];
                                            $usuariocolaborador = $rs["usuariocolaborador"];
                                    }
                            }

                            //Se for Usuario Gerente
                            if($usuariogerente != null){
                                $sqlreservgerente = "INSERT INTO reservagerente(idusuario, idreserva) VALUES($usuariogerente, 
                                                                                                             $idreserva)";
                                unset($dados['id']);
                                unset($dados['idgerente']);
                                unset($dados['idreserva']);
                                $query = $this->bd->prepare($sqlreservgerente);
                                return $query->execute($dados);
                            }else if($usuariocolaborador != null){
                                //Se for usuario Colaborador
                                $sqlreservcolaborador = "INSERT INTO reservacolaborador(idcolaborador, idreserva) VALUES($usuariocolaborador, 
                                                                                                                         $idreserva)";
                                unset($dados['id']);
                                unset($dados['idcolaborador']);
                                unset($dados['idreserva']);
                                $query = $this->bd->prepare($sqlreservcolaborador);
                                return $query->execute($dados);
                            }
                        }
                    }
                }
            }
        }
    }

    public function buscarTodos() {
        if( isset($_SERVER['HTTPS'] ) ) {
            $prefixo = 'https://';
        }else{
            $prefixo = 'http://';
        }
        
        //URL BASE
        $urlbase = $prefixo . ''. $_SERVER['HTTP_HOST']. '/';
        
    	$sql = "select r.id,
                       v.modelo as modeloveiculo,
                       ('$urlbase' || '' || v.caminhofoto || '' || v.nomefoto) as caminhonomefoto,
                       v.nomefoto as nomefoto,
                       to_char(r.datasaidaprev, 'dd/MM/yyyy') as datasaidaprevista,
                       r.horasaidaprev,
                       to_char(r.dataretprev, 'dd/MM/yyyy') as dataretornoprevista,
                       to_char(r.horaretprev, 'HH24:MI') as horaretprev,
                       r.motivo,
                       r.destino,
                       r.idstatus as status
                  from reserva r
                 inner join veiculo v
                    on r.idveiculo = v.id
                 where r.idstatus = 1
                 order by v.modelo asc;";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }

    public function cancelarreserva($id) {
        //Status Cancelado
        $statuscancelado = 2;
        
        $sql = "UPDATE reserva  SET idstatus = $statuscancelado WHERE id = $id";
        $query = $this->bd->prepare($sql);
        $query->execute();
        
        if($query->execute() == 1){
            if( isset($_SERVER['HTTPS'] ) ) {
                    $prefixo = 'https://';
                }else{
                    $prefixo = 'http://';
                }
                
                $urlbase = $prefixo . ''. $_SERVER['HTTP_HOST']. '/';
            ?>
            <script language="JavaScript"> 
                window.location="<?php echo $urlbase;?>locadoraveiculos/painel.php"; 
            </script> 
        <?php }
    }
}