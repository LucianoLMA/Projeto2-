<div class="col-md-12 col-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">Cadastro de Cidade</div>
        <div class="panel-body">
            <form action="<?php echo $acao; ?>" name="formCidade" id="formCidade" method="POST" class="form" role="form">
                <div class="row">
                    <div class="col-md-1">
                        <label for="id">Id</label>
                        <input type="text" class="form-control" id="id" name="id" readonly="true" 
                               value="<?php if (isset($cidade)) echo $cidade['id']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Nome" 
                               value="<?php if (isset($cidade)) echo $cidade['nome']; ?>" required minlength="3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="idestado">Estado</label>
                        <select class="form-control" name="idestado" id="idestado" required>
                            <option value="">Selecione o Estado</option>
                            <?php
                                foreach ($listaEstados as $estados) {
                                    $selected = (isset($cidade) && $cidade['idestado'] == $estados['id']) ? 'selected' : '';
                                    ?>
                                    <option value='<?php echo $estados['id']; ?>'
                                            <?php echo $selected; ?>> 
                                                <?php echo $estados['uf']; ?>
                                    </option>
                                <?php } ?>
                        </select>
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
    $("#formCidade").validate({
        rules: {
            nome: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            idestado: {
                required: true
            }
        },
        messages: {
            nome: {
                required: "Por favor, informe o Nome",
                minlength: "O Nome da Cidade deve ter no mínimo 3 caracteres",
                maxlength: "O Nome da Cidade deve ter no máximo 50 caracteres"
            },
            idestado: {
                required: "Por favor, Selecione um Estado"
            }
        }
    });
</script>
