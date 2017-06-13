<?php
    require_once("../../../config/confloginrel.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Locadora Veículos</title>
        <link href="../../../includes/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="../../../includes/css/datatables.min.css">
        <link rel="stylesheet" href="../../../includes/css/redmond/jquery-ui-1.10.1.custom.css">
        <script src="../../../includes/js/jquery-1.9.1.js" type="text/javascript"></script>
        <script src="../../../includes/js/jquery-ui.js" type="text/javascript"></script>
        <script src="../../../includes/js/jquery.maskedinput.min.js" type="text/javascript"></script>
        
        <!-- Excluir Registro - Mensagem-->
        <script src="../../../includes/js/jquery-ui.js"></script>
        <link rel="stylesheet" href="../../../includes/css/jquery-ui.css" type="text/css" />
        <!-- JQuery formata Valores -->
        <script>
            jQuery(function ($) {
                $("#cpf").mask("999.999.999-99");
                $("#datasaidainicio").mask("99/99/9999");
                $("#datasaidafim").mask("99/99/9999");
                $("#datasaidainicio").datepicker({
                    dateFormat: 'dd/mm/yy',
                    dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                    dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                    dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                    nextText: 'Próximo',
                    prevText: 'Anterior'
                });
                $("#datasaidafim").datepicker({
                    dateFormat: 'dd/mm/yy',
                    dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                    dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                    dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                    nextText: 'Próximo',
                    prevText: 'Anterior'
                });
            });

        </script>
        <style>
            #menutitle{
                color: white;
                padding-left: 25px;
            }
            .ui-datepicker .ui-datepicker-header {
                position: relative;
                padding: .2em 0;
                background-color: #3D5B99;
            }
            div.ui-datepicker{
             font-size:12px;
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #3D5B99">
            <div class="container" style="padding-left: 0px">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#" style="height: 30px; width: 300px;"  id="menutitle">Filtro Relatório de Saída</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse" style="width: 120%;"></div>
            </div>
        </nav>
        <br/><br/><br/>
        <div class="container">
        <form name="filtrorelatoriosaida" id="filtrorelatoriosaida" action="rel_relatoriosaida.php" method="post">
            <div class="form-group">
                <label>Veículo</label>
                <select name="idveiculo" id="idveiculo" class="form-control">
                    <?php
                    $sqlVeiculo = "select distinct v.id as idveiculo,
                                            upper(v.modelo) as modelo
                                       from reserva r
                                      inner join veiculo v
                                         on r.idveiculo = v.id
                                         order by modelo asc;";
                    $sqlVeiculoResult = pg_query($sqlVeiculo);
                    echo '<option value="">
                            Selecione...
                        </option>';
                    while ($sqlVeiculoResultFim = pg_fetch_assoc($sqlVeiculoResult)) {
                        ?>
                        <option value="<?php echo $sqlVeiculoResultFim["idveiculo"] ?>">
                            <?php echo $sqlVeiculoResultFim["modelo"] ?>
                        </option>

                        <?php
                    }
                    ?>
                </select>
            </div>
            <br/>
            <div class="row">
                <div class="col-xs-5">
                    <label for="cpf">CPF </label>
                    <input class="form-control" id="cpf" name="cpf"/>
                </div>
            </div>            
            <br/>
            <div class="row">
                <div class="col-xs-5">
                    <label for="datasaidainicio">Data Saída Inicial >= </label>
                    <input class="form-control" id="datasaidainicio" name="datasaidainicio"/>
                </div>
                <div class="col-xs-5">
                    <label for="datasaidafim"><= Data Saída Final</label>
                    <input class="form-control" id="datasaidafim" name="datasaidafim"/>
                </div>
            </div>
            <br/>
            <button type="submit" class="btn btn-success">Gerar Relatório</button>
            <button type="reset" class="btn btn-primary">Limpar</button>
        </form>
    </div>
    </body>
</html>