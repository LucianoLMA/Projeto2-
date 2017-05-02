<div id="fundo">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Listagem de Reserva</div>
            <div class="panel-body">
            </div>
            <div class="table-responsive">
                <table class="table" id="example1">
                    <thead>
                        <th>Veículo</th>
                        <th>Data Saída Prev</th>
                        <th>Hora Saída Prev</th>
                        <th>Data Retorno Prev</th>
                        <th>Hora Retorno Prev</th>
                        <th style="width: 230px;">Status</th>
                        <th>Imagem</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaDados as $item) {
                            echo '<tr>';
                            echo '<td style="padding-top: 25px;">' . $item['modeloveiculo'];
                            echo '<td style="padding-top: 25px; padding-left: 30px;">' . $item['datasaidaprevista'];
                            echo '<td style="padding-top: 25px; padding-left: 30px;">' . $item['horasaidaprev'];
                            echo '<td style="padding-top: 25px; padding-left: 30px;">' . $item['dataretornoprevista'];
                            echo '<td style="padding-top: 25px; padding-left: 30px;">' . $item['horaretprev'];
                            if($item['status'] == 1){
                                echo '<td style="padding-top: 25px;"><span class="label label-info">RESERVADO</span></td>';;
                            }else if($item['status'] == 2){
                                echo '<td style="padding-top: 25px;"><span class="label label-warning">CANCELADO</span></td>';
                            }else{
                                echo '<td style="padding-top: 25px;"><span class="label label-sucess">ATIVADO</span></td>';
                            }
                            
                            if($item['nomefoto'] != null){
                                echo '<td>' . '<img src = "' . $item['caminhonomefoto'] . '" style="width: 100px; heigth: 80px;"/>';
                            }else{
                                echo '<td>' . '<img src = "http://localhost/locadoraveiculos/protected/imagens/noimagens/noimagem.png" style="width: 100px;"/>';   
                            }
                            $id = $item['id'];

                            echo "<td> <a onclick='cancelarreserva(\"cancelarreserva\",\"reservaController\",$id)' href='#'>"
                            . " <span class='glyphicon glyphicon-trash customDialog'> </span>"
                            . "</a> </td>";
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>