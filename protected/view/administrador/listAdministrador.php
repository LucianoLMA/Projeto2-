<div id="fundo">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Listagem de Administradores</div>
            <div class="panel-body">
                <a href="painel.php?controle=administradorController&acao=novo">
                    <span class='glyphicon glyphicon-plus'> Adicionar</span>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table" id="example1">
                    <thead>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaDados as $item) {
                            echo '<tr>';
                            echo '<td style="border-left-width: 10px; padding-right: 0px;    padding-left: 21px;">' . $item['id'];
                            echo '<td>' . $item['nomeusuario'];
                            echo '<td>' . $item['cpf'];
                            echo '<td>' . $item['telefone'];
                            $id = $item['id'];
                            
                             echo "<td> <a href='painel.php?controle=administradorController&acao=buscar&id=$id'>"
                            . " <span class='glyphicon glyphicon-pencil'> </span>"
                            . "</a> </td>";
                            echo "<td> <a onclick='excluir(\"excluir\",\"administradorController\",$id)' href='#'>"
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