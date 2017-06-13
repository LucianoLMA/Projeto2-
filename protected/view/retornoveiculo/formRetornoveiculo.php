<div id="fundo">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Retorno Veículo</div>
            <div style="margin-left: 20px; height: 190px">
                <form action="<?php echo $acao; ?>" name="formFiltrarplaca" id="formFiltrarplaca" method="POST" class="form" role="form">
                    <br/>
                    <div class="row">
                        <label>Filtrar por:</label>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf_atualizado" value="<?php if (isset($_POST['cpf'])) echo $_POST['cpf']; ?>" name="cpf" required="">
                        </div>
                        <div style="padding-top: 23px;">
                           <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
            
            <?php 
                if($_POST != null){
                if($listaDados != NULL){?>
                    <h3 style="margin-left: 20px;">Relação de Retorno</h3>
                    <hr/>
                    <div class="table-responsive">
                        <table class="table" id="example1" style="width: 98%;">
                            <thead>
                                <th>Placa</th>
                                <th>Destino</th>
                                <th>Motivo</th>
                                <th>Km Saída</th>
                                <th>Data Saída</th>
                                <th>Hora Saída</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($listaDados as $item) {
                                    echo '<tr>';
                                    echo '<td>' . $item['placa'];
                                    echo '<td>' . $item['destino'];
                                    echo '<td>' . $item['motivo'];
                                    echo '<td>' . $item['kmfinal'];
                                    echo '<td>' . $item['datasaida'];
                                    echo '<td>' . $item['horasaida'];
                                    $id = $item['idreserva'];

                                     echo "<td> <a href='painel.php?controle=retornoveiculoController&acao=buscar&id=$id'>"
                                    . " <span class='glyphicon glyphicon-pencil'> </span>"
                                    . "</a> </td>";
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php }else{?>
                    <div class="alert alert-danger">
                         Não existe retorno para este CPF informado!
                    </div>
                <?php }
            }
            ?>
            
            <?php
                if(isset($retornoveiculo['idreserva']) != ''){?>
                    <h3 style="margin-left: 20px;">Retorno Veículo</h3>
                    <hr/>
                        <div style=" margin-left: 20px;">
                            <form action="<?php echo $acao; ?>" name="formReservacolaborador" id="formReservacolaborador" method="POST" class="form" role="form">
                                <input type="hidden" name="idreserva" value="<?php echo $retornoveiculo['idreserva'];?>">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="cpf">CPF</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $retornoveiculo['cpf'];?>" readonly="true">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="idveiculo">Placa</label>
                                        <input type="text" class="form-control" id="idveiculo" name="placa" value="<?php echo $retornoveiculo['placa'];?>" readonly="true">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="destino">Destino</label>
                                        <input type="text" class="form-control" id="destino" name="destino" value="<?php echo $retornoveiculo['destino'];?>" readonly="true">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="motivo">Motivo</label>
                                        <input type="text" class="form-control" id="motivo" name="motivo" value="<?php echo $retornoveiculo['motivo'];?>" readonly="true">
                                    </div>
                                </div>
                                <script>
                                     $(document).ready(function(){
                                        $("#jus").hide();
                                    });

                                    function loadSituation(val){
                                        if((val==="ok")){
                                            $("#esconderexibicaoobservacao").fadeOut(500);
                                        }else if(val==="avariado"){
                                            $("#observacao").attr("required", true);
                                            $("#esconderexibicaoobservacao").fadeIn(500);
                                        }
                                    }
                                </script>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="condicao">Condição</label>
                                        <?php
                                            if($retornoveiculo['descricao'] == 'OK'){ ?>

                                        <input type="radio" name="condicao" id="condicao" class="condicao" value="1" checked="true" onclick="loadSituation('ok')"> OK &nbsp
                                        <input type="radio" name="condicao" id="condicao" class="condicao" value="2" onclick="loadSituation('avariado')"> AVARIADO
                                            <?php }else{ ?>
                                        <input type="radio" name="condicao" id="condicao" class="condicao" value="1" onclick="loadSituation('ok')"> OK &nbsp
                                        <input type="radio" name="condicao" id="condicao" class="condicao" value="2" checked="true" onclick="loadSituation('avariado')"> AVARIADO 
                                           <?php }
                                        ?>
                                    </div>
                                </div>

                                <div class="row" id="esconderexibicaoobservacao" style="display: none;">
                                    <div class="col-md-8">
                                        <label for="observacao">Observação</label>
                                        <input type="text" class="form-control" id="observacao" name="observacao" value="<?php echo $retornoveiculo['observacao'];?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="kmsaida">Km Saída</label>
                                        <input type="text" class="form-control" id="kmsaida" readonly="true" name="kmsaida" value="<?php echo $retornoveiculo['kminicial'];?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="kmretorno">Km Retorno</label>
                                        <input type="text" class="form-control" id="kmretorno" name="kmretorno" required="" value="<?php echo $retornoveiculo['kmfinal'];?>">
                                    </div>
                                </div>
                                <div style="padding-top: 23px;">
                                    <button type="submit" class="btn btn-success">Confirmar</button
                                    
                                </div>
                            </form>
                    </div>
                <?php } ?>
        </div>
    </div>
</div>
<script src="includes/js/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="includes/js/jquery.validate.min.js" type="text/javascript"></script>

<script>
    $("#formFiltrarplaca").validate({
        rules: {
            cpf: {
                required: true
            },
            kmretorno: {
                required: true
            },
            observacao: {
                required: true
            }
        },
        messages: {
            cpf: {
                required: "Por favor, informe o CPF para filtrar o registro"
            },
            kmretorno: {
                required: "Por favor, informe o Km Retorno"
            },
            observacao: {
                required: "Por favor, informe a Observação"
            }
        }
    });
</script>


