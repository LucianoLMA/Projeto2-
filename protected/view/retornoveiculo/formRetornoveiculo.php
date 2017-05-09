<div id="fundo">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Retorno de Veículo</div>
            <div style="margin-left: 20px; height: 190px">
                <form action="<?php echo $acao; ?>" name="formFiltrarplaca" id="formFiltrarplaca" method="POST" class="form" role="form">
                    <br/>
                    <div class="row">
                        <label>Filtrar por:</label>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf_atualizado" name="cpf" required="">
                        </div>
                        <div style="padding-top: 23px;">
                           <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
            
            <h3 style="margin-left: 20px;">Dados da Reserva</h3>
            <hr/>
            
            <?php if($_POST != null){
                foreach ($listaDados as $item) {
                        $item['idreserva'];
                        $item['placa'];
                        $item['destino'];
                        $item['motivo'];
                        $item['descricao'];
                        $item['kmfinal'];
                        
                    }
                ?>
            <?php if(isset($item['placa']) != ''){ ?>
                <div style=" margin-left: 20px;">
                    <form action="<?php echo $acao; ?>" name="formReservacolaborador" id="formReservacolaborador" method="POST" class="form" role="form">
                        <input type="hidden" name="idreserva" value="<?php echo $item['idreserva'];?>">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="idveiculo">Placa</label>
                                <input type="text" class="form-control" id="idveiculo" name="placa" value="<?php echo $item['placa'];?>" readonly="true">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="destino">Destino</label>
                                <input type="text" class="form-control" id="destino" name="destino" value="<?php echo $item['destino'];?>" readonly="true">
                            </div>
                            <div class="col-md-4">
                                <label for="motivo">Motivo</label>
                                <input type="text" class="form-control" id="motivo" name="motivo" value="<?php echo $item['motivo'];?>" readonly="true">
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
                                    if($item['descricao'] == 'OK'){ ?>
                                
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
                                <input type="text" class="form-control" id="observacao" name="observacao" value="<?php echo $item['observacao'];?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="kmsaida">Km Saída</label>
                                <input type="text" class="form-control" id="kmsaida" readonly="true" name="kmsaida" value="<?php echo $item['kmfinal'];?>">
                            </div>
                            <div class="col-md-2">
                                <label for="kmretorno">Km Retorno</label>
                                <input type="text" class="form-control" id="kmretorno" name="kmretorno" required="" value="<?php echo $item['kmfinal'];?>">
                            </div>
                        </div>
                        <div style="padding-top: 23px;">
                            <button type="submit" class="btn btn-success">Confirmar</button>
                            <button type="submit" class="btn btn-danger">Cancelar</button>
                        </div>
                    </form>
            </div>
            <?php }else{?>
                <div class="alert alert-danger">
                     Não existe retorno de reserva para o CPF informado!
                </div>
            <?php }?>
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


