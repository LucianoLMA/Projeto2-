<div class="col-md-12 col-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">Cadastro de Veículo</div>
        <div class="panel-body">
            <form action="<?php echo $acao; ?>" name="formVeiculo" id="formVeiculo" method="POST" class="form" role="form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-1">
                        <label for="id">Id</label>
                        <input type="text" class="form-control" id="id" name="id" readonly="true" 
                               value="<?php if (isset($veiculo)) echo $veiculo['id']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="modelo">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Digite o Modelo" 
                               value="<?php if (isset($veiculo)) echo $veiculo['modelo']; ?>" required minlength="3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="chassi">Chassi</label>
                        <input type="text" class="form-control" id="chassi" name="chassi" placeholder="Digite o Chassi" 
                               value="<?php if (isset($veiculo)) echo $veiculo['chassi']; ?>" required minlength="17" maxlength="20" style="text-transform: uppercase">
                    </div>
                    <div class="col-md-3">
                        <label for="placa">Placa</label>
                        <input type="text" class="form-control" id="placa" name="placa" placeholder="Digite a Placa" 
                               value="<?php if (isset($veiculo)) echo $veiculo['placa']; ?>" required minlength="3" style="text-transform: uppercase">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <label for="versao">Versão</label>
                        <input type="text" class="form-control" id="versao" name="versao" placeholder="Digite a Versão do Veículo" 
                               value="<?php if (isset($veiculo)) echo $veiculo['versao']; ?>" required minlength="3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="anofabricacao">Ano Fabricação</label>
                        <input type="text" class="form-control" id="anofabricacao" name="anofabricacao" placeholder="Digite o Ano de Fabricação" 
                               value="<?php if (isset($veiculo)) echo $veiculo['anofabricacao']; ?>" required minlength="4">
                    </div>
                    <div class="col-md-3">
                        <label for="anomodelo">Ano Modelo</label>
                        <input type="text" class="form-control" id="anomodelo" name="anomodelo" placeholder="Digite o Ano Modelo" 
                               value="<?php if (isset($veiculo)) echo $veiculo['anomodelo']; ?>" required minlength="4">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="kminicial">Km. Inicial</label>
                        <input type="text" class="form-control" id="kmmascarainicial" maxlength="9" onkeyup="removervirgulapornada()" name="kminicial" placeholder="Digite o Km. Inicial" 
                               value="<?php if (isset($veiculo)) echo $veiculo['kminicial']; ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label for="kmfinal">Km. Final</label>
                        <input type="text" class="form-control" id="kmmascarafinal" name="kmfinal" maxlength="9" onkeyup="removervirgulapornada()" placeholder="Digite o Km. Final" 
                               value="<?php if (isset($veiculo)) echo $veiculo['kmfinal']; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="imagem">Imagem do Veículo</label>
                        <input name="arquivo" type="file" required=""/>
                        <?php
                            //Cairá neste teste sempre que o usuário for alterar um registro
                            if(isset($veiculo['nomefoto']) != null){
                                if($veiculo['nomefoto'] == ''){
                                    if( isset($_SERVER['HTTPS'] ) ) {
                                        $prefixo = 'https://';
                                    }else{
                                        $prefixo = 'http://';
                                    }
                                    $urlbase = $prefixo . ''. $_SERVER['HTTP_HOST']. '/locadoraveiculos/protected/imagens/noimagens/noimagem.png';
                                    echo '<img src = "' . "$urlbase". '" style="width: 100px;"/>';   
                                }else{
                                    echo '<img src = "' . $veiculo['caminhonomefoto'] . '" style="width: 100px; heigth: 80px;"/>';
                                }
                            }//Cairá nesse teste sempre que o usuário for inserir um novo veículo
                            else{
                                if(isset($_SERVER['HTTPS'] ) ) {
                                    $prefixo = 'https://';
                                }else{
                                    $prefixo = 'http://';
                                }
                                $urlbase = $prefixo . ''. $_SERVER['HTTP_HOST']. '/locadoraveiculos/protected/imagens/noimagens/noimagem.png';
                                echo '<img src = "' . "$urlbase". '" style="width: 100px;"/>';   
                            }
                        ?>
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
    $("#formVeiculo").validate({
        rules: {
            modelo: {
                required: true,
                minlength: 2,
                maxlength: 40
            },
            chassi: {
                required: true,
                maxlength: 20
            },
            placa: {
                required: true
            },
            versao: {
                required: true
            },
            anofabricacao: {
                required: true
            },
            anomodelo: {
                required: true
            },
            kminicial: {
                required: true
            },
            kmfinal: {
                required: true
            },
            arquivo: {
                required: true
            }
        },
        messages: {
            modelo: {
                required: "Por favor, informe o Modelo",
                minlength: "O Modelo do Veículo deve ter no mínimo 2 caracteres",
                maxlength: "O Modelo do Veículo deve ter no máximo 40 caracteres"
            },
            chassi: {
                required: "Por favor, informe o Chassi",
                minlength: "O Chassi do Veículo deve ter no mínimo 17 caracteres",
                maxlength: "O Chassi do Veículo deve ter no máximo 20 caracteres"
            },
            placa: {
                required: "Por favor, informe a Placa do Veículo",
                maxlength: "A Placa do Veículo deve ter no máximo 8 caracteres"
            },
            versao: {
                required: "Por favor, informe a Versão do Veículo"
            },
            anofabricacao: {
                required: "Por favor, informe o Ano de Fabricação"
            },
            anomodelo: {
                required: "Por favor, informe o Ano do Modelo"
            },
            kminicial: {
                required: "Por favor, informe a Km. Inicial"
            },
            kmfinal: {
                required: "Por favor, informe a Km. Final"
            },
            arquivo: {
                required: "Por favor, informe a Imagem do Veículo."
            }
        }
    });
</script>
