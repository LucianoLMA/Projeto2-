<div class="col-md-12 col-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">Cadastro de Administrador</div>
        <div class="panel-body">
            <form action="<?php echo $acao; ?>" name="formAdministrador" id="formAdministrador" method="POST" class="form" role="form">
                <div class="row">
                    <div class="col-md-1">
                        <label for="id">Id</label>
                        <input type="text" class="form-control" id="id" name="id" readonly="true" 
                               value="<?php if (isset($administrador)) echo $administrador['id']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label for="idusuario">Usuário</label>
                        <select class="form-control" name="idusuario" id="idusuario" required>
                            <option value="">Selecione o Usuário</option>
                            <?php
                                foreach ($listaUsuario as $usuarios) {
                                    $selected = (isset($administrador) && $administrador['idusuario'] == $usuarios['id']) ? 'selected' : '';
                                    ?>
                                    <option value='<?php echo $usuarios['id']; ?>'
                                            <?php echo $selected; ?>> 
                                                <?php echo $usuarios['nomeusuario']; ?>
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
    $("#formAdministrador").validate({
        rules: {
            idusuario: {
                required: true
            }
        },
        messages: {
            idusuario: {
                required: "Por favor, Selecione um Usuário"
            }
        }
    });
</script>
