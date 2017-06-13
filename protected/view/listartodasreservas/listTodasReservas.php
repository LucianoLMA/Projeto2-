<div id="fundo">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Relação de Todas as Reservas</div>
            <div class="table-responsive">
                <table class="table" id="example1">
                    <thead>
                        <th>Data Hora Saída</th>
                        <th>Data Hora Retorno</th>
                        <th>Km Inicial</th>
                        <th>Km Final</th>
                        <th>Motivo</th>
                        <th>Destino</th>
                        <th>Observação</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaDados as $item) {
                            echo '<tr>';
                            echo '<td>' . $item['datahorasaida'];
                            echo '<td>' . $item['datahoraretorno'];
                            echo '<td>' . $item['kminicial'];
                            echo '<td>' . $item['kmfinal'];
                            echo '<td>' . $item['motivo'];
                            echo '<td>' . $item['destino'];
                            echo '<td>' . $item['observacao'];
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
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>