<div id="fundo">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Relação de Saída de Veículo</div>
            <div class="table-responsive">
                <table class="table" id="example1">
                    <thead>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Placa</th>
                        <th>Destino</th>
                        <th>Motivo</th>
                        <th>Condição</th>
                        <th>Km. Final</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaDados as $item) {
                            echo '<tr>';
                            echo '<td style="padding-left: 12px;">' . $item['datasaida'];
                            echo '<td style="padding-left: 12px;">' . substr($item['horasaida'], 0, -3);
                            echo '<td>' . $item['placa'];
                            echo '<td>' . $item['destino'];
                            echo '<td>' . $item['motivo'];
                            echo '<td>' . $item['descricao'];
                            echo '<td>' . $item['kmfinal'];
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