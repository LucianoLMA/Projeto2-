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

                }
            }
        }else{?>
            <html>
                <head>
                    <link href="../../includes/css/style.css" rel="stylesheet">
                    <link href="../../includes/css/bootstrap.min.css" rel="stylesheet">
                    <link rel="stylesheet" href="../../includes/css/datatables.min.css">
                </head>
                
                <h2>Minhas Reservas</h2>
                <hr/>
                <a href="painel.php?controle=reservaController&acao=novo" class="btn btn-success" role="button">Incluir Reserva</a>
                <table class="table">
                    <?php
                            $sql = "select v.modelo,
                                                ('http://localhost/' || '' || v.caminhofoto || '' || v.nomefoto) as caminhonomefoto,
                                                to_char(r.datasaida, 'dd/MM/yyyy') as datasaida
                                        from veiculo v
                                       inner join reserva r
                                          on r.idveiculo = v.id
                                       --where r.idstatus = 3
                                       order by v.modelo, r.datasaida;";
                            $query = $this->bd->query($sql);
                            if ($query->rowCount() > 0) {
                                foreach ($query as $rs) {?>
                                    <th>
                                        <img src = "<?php echo $rs['caminhonomefoto'] ?>" style="width: 200px; heigth: 80px;"/>
                                        <label><?php echo $rs['modelo'];  echo $rs['datasaida']?></label>
                                    </th>
                                <?}
                            }
                        ?>
                </table>
            </html>
        <?php }
            }
        }
    }
}
?>