<div id="fundo">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Saída Veículo</div>
            <div class="table-responsive">
                <table class="table" id="example1">
                    <thead>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Placa</th>
                        <th>Destino</th>
                        <th>Motivo</th>
                        <th>Descrição</th>
                        <th>Km. Final</th>
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
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>