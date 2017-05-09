<?php

class ReservaModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    public function inserir(array $dados) {
        
        date_default_timezone_set('America/Sao_Paulo');
        $dataatual = date('d/m/Y');
        
        $idveiculo = $_POST['idveiculo'];
        $datasaidaprev = $_POST['datasaidaprev'];
        $horasaidaprev = $_POST['horasaidaprev'];
        $dataretprev = $_POST['dataretprev'];
        $horaretprev = $_POST['horaretprev'];
        $motivo = $_POST['motivo'];
        $destino = $_POST['destino'];
        
        
        //Faz a comparaçao da hora e data
        if($datasaidaprev > $dataretprev){
            echo "<script>alert('A Data de Saída Prevista não pode ser maior que a Data de Retorno');</script>";
            //Volta uma página javascript, limpa os dados
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
            //Data sao validas, busca o carro e grava
            $consultainformacoesveiculo = "select kminicial, kmfinal from veiculo where id = " . $idveiculo;

            $sqlconsultainformacoesveiculo = $this->bd->prepare($consultainformacoesveiculo);
            $sqlconsultainformacoesveiculo->execute();

            if ($sqlconsultainformacoesveiculo->rowCount() > 0) {
                foreach ($sqlconsultainformacoesveiculo as $rs){
                    $kminicial = $rs["kminicial"];
                    $kmfinal = $rs["kmfinal"];
                }
            }

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
                //pega o ultimo id da reserva para inserir no id da reserva do colaborador
                $registroreserva = "select max(id) as idreserva from reserva";
                $sqlregistroreserva = $this->bd->prepare($registroreserva);
                $sqlregistroreserva->execute();
                if ($sqlregistroreserva->rowCount() > 0) {
                    foreach ($sqlregistroreserva as $rs) {
                            $idreserva = $rs["idreserva"];
                    }
                }
                
                //Pega o id do colab. pelo do CPF
                $registrocolaborador = "select c.id as idcolaborador 
                                          from usuario u 
                                         inner join colaborador c 
                                            on c.idusuario = u.id
                                         where cpf = '$cpf'";
                $sqlregistrocolaborador = $this->bd->prepare($registrocolaborador);
                $sqlregistrocolaborador->execute();
                if ($sqlregistrocolaborador->rowCount() > 0) {
                        foreach ($sqlregistrocolaborador as $rs) {
                                $idcolaborador = $rs["idcolaborador"];
                        }
                }
                
                $sqlreservcolaborador = "INSERT INTO reservacolaborador(idcolaborador, idreserva) VALUES($idcolaborador, 
                                                                                                          $idreserva)";

                $query = $this->bd->prepare($sqlreservcolaborador);
                return $query->execute($dados);
            }
        }
    }

    public function buscarTodos() {
    	$sql = "select r.id,
                       v.modelo as modeloveiculo,
                       ('http://localhost/' || '' || v.caminhofoto || '' || v.nomefoto) as caminhonomefoto,
                       v.nomefoto as nomefoto,
                       to_char(r.datasaidaprev, 'dd/MM/yyyy') as datasaidaprevista,
                       r.horasaidaprev,
                       to_char(r.dataretprev, 'dd/MM/yyyy') as dataretornoprevista,
                       r.horaretprev,
                       r.motivo,
                       r.destino,
                       r.idstatus as status
                  from reserva r
                 inner join veiculo v
                    on r.idveiculo = v.id
                 order by v.modelo asc;";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }

    public function cancelarreserva($id) {
        // Status Cancelado
        $statuscancelado = 2;
        
        $sql = "UPDATE reserva  SET idstatus = $statuscancelado WHERE id = $id";
        $query = $this->bd->prepare($sql);
        return $query->execute();
    }
}