<div id="fundo">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Listagem de Veículos</div>
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
                        <th>Imagem</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaDados as $item) {
                            echo '<tr>';
                            echo '<td style="padding-top: 25px;">' . $item['modelo'];
                            echo '<td style="padding-top: 25px;">' . $item['placa'];
                            echo '<td style="padding-top: 25px;">' . $item['chassi'];
                            echo '<td style="padding-top: 25px;">' . $item['versao'];
                            echo '<td style="padding-top: 25px;">' . $item['anomodelo'];
                            echo '<td style="padding-top: 25px;">' . $item['anofabricacao'];
                            echo '<td style="padding-top: 25px;">' . $item['kminicial'];
                            echo '<td style="padding-top: 25px;">' . $item['kmfinal'];
                            if($item['nomefoto'] != null){
                                echo '<td>' . '<img src = "' . $item['caminhonomefoto'] . '" style="width: 100px; heigth: 80px;"/>';
                            }else{
                                echo '<td>' . '<img src = "http://localhost/locadoraveiculos/protected/imagens/noimagens/noimagem.png" style="width: 100px;"/>';   
                            }
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