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
                    <h3 style="margin-left: 20px;">Relação de Reservas</h3>
                    <hr/>
                    <div class="table-responsive">
                        <table class="table" id="example1" style="width: 98%;">
                            <thead>
                                <th>Placa</th>
                                <th>Destino</th>
                                <th>Motivo</th>
                                <th>Km Final</th>
                                <th>Data Saída Prev</th>
                                <th>Hora Saída Prev</th>
                                <th>Status</th>
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
                                    echo '<td>' . $item['datasaidaprev'];
                                    echo '<td>' . $item['horasaidaprev'];
                                    if($item['status'] == 1){
                                        echo '<td style="padding-top: 5px;"><span class="label label-warning">RESERVADO</span></td>';;
                                    }else if($item['status'] == 2){
                                        echo '<td style="padding-top: 5px;"><span class="label label-danger">CANCELADO</span></td>';
                                    }else if($item['status'] == 3){
                                        echo '<td style="padding-top: 5px;"><span class="label label-success">ATIVADO</span></td>';
                                    }else if($item['status'] == 4){
                                        echo '<td style="padding-top: 5px;"><span class="label label-default">NÃO COMPARECEU</span></td>';
                                    }else if($item['status'] == 5){
                                        echo '<td style="padding-top: 5px;"><span class="label label-primary">FINALIZADO</span></td>';
                                    }
                                    $id = $item['idreserva'];
                                    
                                    if($item['status'] == 1){?>
                                        <td> <a href='painel.php?controle=reservacolaboradorController&acao=buscar&id=<?php echo $id ?>'>
                                        <span disabled class='glyphicon glyphicon-pencil'> </span>
                                        </a> </td>
                                    <?php }
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php }else{?>
                    <div class="alert alert-danger">
                         Não existe reserva para este CPF informado!
                    </div>
                <?php }
            }
            ?>
                
                <?php
                    if(isset($reservacolaborador['idreserva']) != ''){?>
                        <h3 style="margin-left: 20px;">Reservar Veículo</h3>
                        <hr/>
                        <div style=" margin-left: 20px;">
                            <form action="<?php echo $acao; ?>" name="formReservacolaborador" id="formReservacolaborador" method="POST" class="form" role="form" onchange="return checarDatas()">
                                <input type="hidden" name="idreserva" value="<?php echo $reservacolaborador['idreserva'];?>">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="cpf">CPF</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $reservacolaborador['cpf'];?>" readonly="true">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="placa">Placa</label>
                                        <input type="text" class="form-control" id="placa" name="placa" value="<?php echo $reservacolaborador['placa'];?>" readonly="true">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="destino">Destino</label>
                                        <input type="text" class="form-control" id="destino" name="destino" value="<?php echo $reservacolaborador['destino'];?>" readonly="true">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="motivo">Motivo</label>
                                        <input type="text" class="form-control" id="motivo" name="motivo" value="<?php echo $reservacolaborador['motivo'];?>" readonly="true">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="condicao">Condição</label>
                                        <input type="radio" name="condicao" value="1" checked="true"> OK &nbsp
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="kmfinal">Km Atual</label>
                                        <input type="text" class="form-control" id="kmfinal" readonly="true" name="kmfinal" value="<?php echo $reservacolaborador['kmfinal'];?>">
                                    </div>
                                </div>
                                <div style="padding-top: 23px;">
                                    <button type="submit" class="btn btn-success">Confirmar</button>
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
            }
        },
        messages: {
            cpf: {
                required: "Por favor, informe o CPF para filtrar o registro"
            }
        }
    });
</script>


