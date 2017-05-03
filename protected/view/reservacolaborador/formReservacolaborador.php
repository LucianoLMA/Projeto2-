<div id="fundo">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Saída Veículo</div>
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
            
            <h3 style="margin-left: 20px;">Dados referente a Reserva</h3>
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
                    <form action="<?php echo $acao; ?>" name="formReservacolaborador" id="formReservacolaborador" method="POST" class="form" role="form" onchange="return checarDatas()">
                        <input type="hidden" name="idreserva" value="<?php echo $item['idreserva'];?>">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="idveiculo">Placa</label>
                                <input type="text" class="form-control" id="idveiculo" name="placa" value="<?php echo $item['placa'];?>" readonly="true">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="destino">Destino</label>
                                <input type="text" class="form-control" id="destino" name="destino" value="<?php echo $item['destino'];?>" readonly="true">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="motivo">Motivo</label>
                                <input type="text" class="form-control" id="motivo" name="motivo" value="<?php echo $item['motivo'];?>" readonly="true">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="condicao">Condição</label>
                                <?php
                                    if($item['descricao'] == 'OK'){ ?>
                                        <input type="radio" name="condicao" value="1" checked="true"> OK &nbsp
                                        <input type="radio" name="condicao" value="2"> AVARIADO
                                    <?php }else{ ?>
                                        <input type="radio" name="condicao" value="1"> OK &nbsp
                                        <input type="radio" name="condicao" value="2" checked="true"> AVARIADO 
                                   <?php }
                                ?>
                                
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="kmfinal">Km Atual - Final</label>
                                <input type="text" class="form-control" id="kmfinal" readonly="true" name="kmfinal" value="<?php echo $item['kmfinal'];?>">
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
                     Não existe reserva para este CPF informado!
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
            }
        },
        messages: {
            cpf: {
                required: "Por favor, informe o CPF desejado"
            }
        }
    });
</script>


