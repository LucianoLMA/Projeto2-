<div class="col-md-12 col-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">Cadastro de Setor</div>
        <div class="panel-body">
            <form action="<?php echo $acao; ?>" name="formSetor" id="formSetor" method="POST" class="form" role="form">
                <div class="row">
                    <div class="col-md-1">
                        <label for="id">Id</label>
                        <input type="text" class="form-control" id="id" name="id" readonly="true" 
                               value="<?php if (isset($setor)) echo $setor['id']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Nome" 
                               value="<?php if (isset($setor)) echo $setor['nome']; ?>" required minlength="3">
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
    $("#formSetor").validate({
        rules: {
            nome: {
                required: true,
                minlength: 3,
                maxlength: 50
            }
        },
        messages: {
            nome: {
                required: "Por favor, informe o Nome do Setor",
                minlength: "O Nome do Setor deve ter no mínimo 3 caracteres",
                maxlength: "O Nome do Setor deve ter no máximo 50 caracteres"
            }
        }
    });
</script>
