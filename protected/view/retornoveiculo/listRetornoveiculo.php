<div id="fundo">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Relação dos Retornos de Veículos</div>
            <div class="table-responsive">
                <table class="table" id="example1">
                    <thead>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Placa</th>
                        <th>Destino</th>
                        <th>Motivo</th>
                        <th>Km. Inicial</th>
                        <th>Km. Final</th>
                        <th>Observação</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaDados as $item) {
                            echo '<tr>';
                            echo '<td style="padding-left: 12px;">' . $item['dataretorno'];
                            echo '<td style="padding-left: 12px;">' . $item['horaretorno'];
                            echo '<td>' . $item['placa'];
                            echo '<td style="padding-left: 20px;">' . $item['destino'];
                            echo '<td style="padding-left: 20px;">' . $item['motivo'];
                            echo '<td style="width: 131px; padding-left: 32px;">' . $item['kminicial'];
                            echo '<td style="padding-left: 32px;">' . $item['kmfinal'];
                            echo '<td>' . $item['observacao'];
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>