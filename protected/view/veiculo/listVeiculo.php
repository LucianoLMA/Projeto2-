<div id="fundo">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Veículos Cadastrados</div>
            <div class="panel-body">
                <a href="painel.php?controle=veiculoController&acao=novo">
                    <span class='glyphicon glyphicon-plus'> Adicionar</span>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table" id="example1">
                    <thead>
                        <th>Modelo</th>
                        <th>Placa</th>
                        <th>Chassi</th>
                        <th>Versão</th>
                        <th>Ano Modelo</th>
                        <th>Ano Fabricação</th>
                        <th>Km. Inicial</th>
                        <th>Km. Final</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaDados as $item) {
                            echo '<tr>';
                            echo '<td>' . $item['modelo'];
                            echo '<td>' . $item['placa'];
                            echo '<td>' . $item['chassi'];
                            echo '<td>' . $item['versao'];
                            echo '<td>' . $item['anomodelo'];
                            echo '<td>' . $item['anofabricacao'];
                            echo '<td>' . $item['kminicial'];
                            echo '<td>' . $item['kmfinal'];
                            $id = $item['id'];

                             echo "<td> <a href='painel.php?controle=veiculoController&acao=buscar&id=$id'>"
                            . " <span class='glyphicon glyphicon-pencil'> </span>"
                            . "</a> </td>";
                            echo "<td> <a onclick='excluir(\"excluir\",\"veiculoController\",$id)' href='#'>"
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