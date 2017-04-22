<div class="col-md-12 col-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">Cadastro de Colaborador</div>
        <div class="panel-body">
            <form action="<?php echo $acao; ?>" name="formColaborador" id="formColaborador" method="POST" class="form" role="form">
                <div class="row">
                    <div class="col-md-1">
                        <label for="id">Id</label>
                        <input type="text" class="form-control" id="id" name="id" readonly="true" 
                               value="<?php if (isset($colaborador)) echo $colaborador['id']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="idgerente">Gerente</label>
                        <select class="form-control" name="idgerente" id="idgerente" required>
                            <option value="">Selecione o Gerente</option>
                            <?php
                                foreach ($listaGerentes as $gerentes) {
                                    $selected = (isset($colaborador) && $colaborador['idgerente'] == $gerentes['id']) ? 'selected' : '';
                                    ?>
                                    <option value='<?php echo $gerentes['idgerente']; ?>'
                                            <?php echo $selected; ?>> 
                                                <?php echo $gerentes['nomegerente']; ?>
                                    </option>
                                <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="idsetor">Setor</label>
                        <select class="form-control" name="idsetor" id="idsetor" required>
                            <option value="">Selecione o Setor</option>
                            <?php
                                foreach ($listaSetores as $setores) {
                                    $selected = (isset($colaborador) && $colaborador['idsetor'] == $setores['id']) ? 'selected' : '';
                                    ?>
                                    <option value='<?php echo $setores['id']; ?>'
                                            <?php echo $selected; ?>> 
                                                <?php echo $setores['nomesetor']; ?>
                                    </option>
                                <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Nome" 
                               value="<?php if (isset($colaborador)) echo $colaborador['nome']; ?>" required minlength="3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="sobrenome">Sobrenome</label>
                        <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Digite o Sobrenome" 
                               value="<?php if (isset($colaborador)) echo $colaborador['sobrenome']; ?>" required minlength="3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="datanascimento">Data Nascimento</label>
                        <input type="text" class="form-control" id="data" name="datanascimento" placeholder="Informe a Data/Nascimento" 
                                       value="<?php if (isset($colaborador)) echo $colaborador['datanascimento']; ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" id="cpf_atualizado" name="cpf" placeholder="Informe o CPF" 
                                       onkeypress="return Onlynumbers(event)" value="<?php if (isset($colaborador)) echo $colaborador['cpf']; ?>" required maxlength="14">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite o Telefone" 
                                       value="<?php if (isset($colaborador)) echo $colaborador['telefone']; ?>" required maxlength="20">
                    </div>
                    <div class="col-md-3">
                        <label for="celular">Celular</label>
                        <input type="text" class="form-control" attrname="telephone1" name="celular" placeholder="Digite o Celular" 
                                        value="<?php if (isset($colaborador)) echo $colaborador['celular']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="cnh">CNH</label>
                        <input type="text" class="form-control" id="cnh" name="cnh" placeholder="Digite a CNH" 
                                       value="<?php if (isset($colaborador)) echo $colaborador['cnh']; ?>" required maxlength="20">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Digite o Endereço" 
                                       value="<?php if (isset($colaborador)) echo $colaborador['endereco']; ?>" required maxlength="80">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label for="cidade">Cidade</label>
                        <select class="form-control" name="idcidade" id="idcidade" required>
                            <option value="">Selecione a Cidade</option>
                            <?php
                                foreach ($listaCidades as $cidades) {
                                    $selected = (isset($colaborador) && $colaborador['idcidade'] == $cidades['id']) ? 'selected' : '';
                                    ?>
                                    <option value='<?php echo $cidades['id']; ?>'
                                            <?php echo $selected; ?>> 
                                                <?php echo $cidades['nome']; ?>
                                    </option>
                                <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digiteo E-mail" 
                                       value="<?php if (isset($colaborador)) echo $colaborador['email']; ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" attrname="senha" name="senha" placeholder="Digite a Senha" 
                                        value="<?php if (isset($colaborador)) echo $colaborador['senha']; ?>">
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
    $("#formColaborador").validate({
        rules: {
            idgerente: {
                required: true
            },
            idsetor: {
                required: true
            },
            nome: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            sobrenome: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            datanascimento: {
                required: true
            },
            cpf: {
                required: true,
                minlength: 14,
                maxlength: 14
            },
            telefone: {
                required: true
            },
            cnh: {
                required: true
            },
            endereco: {
                required: true,
                maxlength: 80
            },
            idcidade: {
                required: true
            },
            senha: {
                required: true,
                minlength: 8,
                maxlength: 20
            },
            idestado: {
                required: true
            }
        },
        messages: {
            idgerente: {
                required: "Por favor, Selecione um Gerente"
            },
            idsetor: {
                required: "Por favor, Selecione um Setor"
            },
            nome: {
                required: "Por favor, informe o Nome",
                minlength: "O Nome do Colaborador deve ter no mínimo 3 caracteres",
                maxlength: "O Nome do Colaborador deve ter no máximo 50 caracteres"
            },
            sobrenome: {
                required: "Por favor, informe o Sobrenome",
                minlength: "O Sobrenome do Colaborador deve ter no mínimo 3 caracteres",
                maxlength: "O Sobrenome do Colaborador deve ter no máximo 50 caracteres"
            },
            datanascimento: {
                required: "Por favor, informe a Data de Nascimento"
            },
            cpf: {
                required: "Por favor, informe o CPF",
                minlength: "O CPF deve ter no mínimo 14 caracteres",
                maxlength: "O CPF deve ter no máximo 14 caracteres"
            },
            telefone: {
                required: "Por favor, informe o Telefone"
            },
            cnh: {
                required: "Por favor, informe a CNH"
            },
            endereco: {
                required: "Por favor, informe o Endereço",
                maxlength: "O Endereço deve ter no máximo 80 caracteres"
            },
            cidade: {
                required: "Por favor, Selecione uma Cidade"
            },
            senha: {
                required: "Por favor, informe a Senha",
                minlength: "A Senha deve ter no mínimo 8 caracteres",
                maxlength: "A Senha deve ter no máximo 20 caracteres"
            },
            idestado: {
                required: "Por favor, Selecione um Estado"
            }
        }
    });
</script>
