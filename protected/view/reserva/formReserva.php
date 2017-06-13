<div class="col-md-12 col-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">Cadastro de Reserva</div>
        <div class="panel-body">
            
            <form action="<?php echo $acao; ?>" name="formReserva" id="formReserva" method="POST" class="form" role="form">
                <input type="hidden" class="form-control" id="cpf" name="cpf" readonly="true" value="<?php echo $_SESSION['cpf']; ?>">
                <div class="row">
                    <div class="col-md-1">
                        <label for="id">Id</label>
                        <input type="text" class="form-control" id="id" name="id" readonly="true" 
                               value="<?php if (isset($reserva)) echo $reserva['id']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="idveiculo">Veículo</label>
                        <select class="form-control" name="idveiculo" id="idveiculo" required>
                            <option value="">Selecione o Veículo</option>
                            <?php
                                foreach ($listaVeiculos as $veiculos) {
                                    $selected = (isset($reserva) && $reserva['idveiculo'] == $veiculos['id']) ? 'selected' : '';
                                    ?>
                                    <option value='<?php echo $veiculos['id']; ?>'
                                            <?php echo $selected; ?>> 
                                                <?php echo $veiculos['modelo']; ?>
                                    </option>
                                <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="datasaidaprev">Data Previsão Saída</label>
                        <input type="text" class="form-control" id="data" name="datasaidaprev" placeholder="Informe a Data Prev. Saída" 
                               value="<?php if (isset($reserva)) echo $reserva['datasaidaprev']; ?>" onchange="validaDataPrevReserva();" required>
                        <div id="mensagemdataprevisaosaida"></div>
                    </div>
                    <div class="col-md-3">
                        <label for="horasaidaprev">Hora Previsão Saída</label>
                        <input type="text" class="form-control" id="horaprevsaida" name="horasaidaprev" placeholder="Informe a Hora Prev. Saída" 
                                      OnKeyUp="Mascara_Hora('horaprevsaida')" onchange="validaHoraPrevisaoSaida();" value="<?php if (isset($reserva)) echo $reserva['horasaidaprev']; ?>" required>
                        <div id="mensagemhoraprevisaosaida"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="dataretprev">Data Previsão Retorno</label>
                        <input type="text" class="form-control" id="dataprevretorno" name="dataretprev" placeholder="Informe a Data Retorno Saída" 
                                       value="<?php if (isset($reserva)) echo $reserva['dataretprev']; ?>" onchange="validaDataPrevRetorno();" required>
                        <div id="mensagemdataprevisaoretorno"></div>
                    </div>
                    <div class="col-md-3">
                        <label for="horaretprev">Hora Previsão Retorno</label>
                        <input type="text" class="form-control" id="horaprevretorno" name="horaretprev" placeholder="Informe a Hora Retorno Previsto" 
                                     OnKeyUp="Mascara_Hora('horaprevretorno')" onchange="validaHoraPrevisaoRetorno();"  value="<?php if (isset($reserva)) echo $reserva['horasaidaprev']; ?>" required>
                        <div id="mensagemhoraprevisaoretorno"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="motivo">Motivo</label>
                        <textarea class="form-control" id="motivo" required="" name="motivo" maxlength="2000"><?php if (isset($reserva)) echo $reserva['motivo']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="destino">Destino</label>
                        <input type="text" class="form-control" id="destino" name="destino" placeholder="Informe o Destino" 
                                       value="<?php if (isset($reserva)) echo $reserva['destino']; ?>" required>
                    </div>
                </div>
                <br/>
                <button type="submit" class="btn btn-success">Gravar</button>
                <button type="reset" class="btn btn-primary">Limpar</button>
            </form>
        </div>
    </div>
</div>
<script src="includes/js/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="includes/js/jquery.validate.min.js" type="text/javascript"></script>

<script>
    $("#formReserva").validate({
        rules: {
            idveiculo: {
                required: true
            },
            datasaidaprev: {
                required: true
            },
            horasaidaprev: {
                required: true
            },
            dataretprev: {
                required: true
            },
            horaretprev: {
                required: true
            },
            motivo: {
                required: true
            },
            destino: {
                required: true
            }
        },
        messages: {
            idveiculo: {
                required: "Por favor, Selecione um Veículo"
            },
            datasaidaprev: {
                required: "Por favor, Informe a Data Previsão da Saída"
            },
            horasaidaprev: {
                required: "Por favor, Informe a Hora Previsão de Saída"
            },
            dataretprev: {
                required: "Por favor, Informe a Data Previsão de Retorno"
            },
            horaretprev: {
                required: "Por favor, Informe a Hora Previsão de Retorno"
            },
            motivo: {
                required: "Por favor, Informe o Motivo"
            },
            destino: {
                required: "Por favor, Informe o Destino"
            }
        }
    });
</script>
