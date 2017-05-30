$(document).ready(function ($) {
    $("#kmmascarainicial").maskMoney({decimal: '.'});
    $("#kmmascarafinal").maskMoney({decimal: '.'});
    $("#kmretorno").maskMoney({decimal: '.'});
    $("#cpf_atualizado").mask("999.999.999-99");
    $("#rg").mask("9999999999");
    $("#telefone").mask("(99)9999-9999");
    $("#celular").mask("(99)99999-9999");
    $("#cep").mask("99999-999");
    $("#placa").mask("aaa-9999");
    $("#anofabricacao").mask("9999");
    $("#anomodelo").mask("9999");
    $("#horaprevsaida").mask("99:99");
    $("#horaprevretorno").mask("99:99");
    $("#data").mask("99/99/9999");
    $("#dataprevretorno").mask("99/99/9999");
    
    //Data Calendar
    $("#data").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });
    
    $("#data").on("change",function(){
        if(typeof verificaIdade == 'function'){
            var selected = $(this).val();
            verificaIdade(selected);
        }
    });
    
    //Data Calendar Data Previsão Retorno
    $("#dataprevretorno").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });
    
    $("#dataprevretorno").on("change",function(){
        if(typeof verificaIdade == 'function'){
            var selected = $(this).val();
            verificaIdade(selected);
        }
    });
});

//Testar se a hora é válida
function Mascara_Hora(Campo){
    var hora01 = '';
    var Hora = document.getElementById(Campo).value;
    hora01 = hora01 + Hora;

    if (hora01.length == 2){ 
            hora01 = hora01 + ':'; 
            Hora = hora01; 
    } 
    if (hora01.length == 5)
    {
            Verifica_Hora(Campo);
    }
}

function Verifica_Hora(Campo){
    Hora = document.getElementById(Campo);
    hrs = (Hora.value.substring(0,2));
    min = (Hora.value.substring(3,5));

    estado = ""; 
    if ((hrs < 00 ) || (hrs > 23) || ( min < 00) ||( min > 59)){ 
            estado = "errada"; 
    } 
    if (Hora == ""){ 
            estado = "errada"; 
    } 
    if (estado == "errada"){ 
            alert("Hora inválida!"); 
            document.getElementById(Campo).value='';
            document.getElementById(Campo).focus(); 
    }
}

function removervirgulapornada(){ 
    var string = $('#kmmascarainicial').val();
    string = string.replace(',','');
    $('#kmmascarainicial').val(string);
    
    var string = $('#kmmascarafinal').val();
    string = string.replace(',','');
    $('#kmmascarafinal').val(string);
}
     
//Formatação CPF
function verifica_cpf_atualizado(valor) {
    valor = valor.toString();
    valor = valor.replace(/[^0-9]/g, '');
    if ( valor.length === 11 ) {
        return 'CPF';
    } else {
        return false;
    }
    
} 

function calc_digitos_posicoes(digitos, posicoes = 10, soma_digitos = 0) {
    digitos = digitos.toString();
    for (var i = 0; i < digitos.length; i++) {
        soma_digitos = soma_digitos + (digitos[i] * posicoes);
        posicoes--;
        if (posicoes < 2) {
            posicoes = 9;
        }
    }
    soma_digitos = soma_digitos % 11;
    if (soma_digitos < 2) {
        soma_digitos = 0;
    } else {
        soma_digitos = 11 - soma_digitos;
    }

    var cpf = digitos + soma_digitos;
    return cpf;
    
}

function valida_cpf(valor) {
    valor = valor.toString();
    valor = valor.replace(/[^0-9]/g, '');
    var digitos = valor.substr(0, 9);
    var novo_cpf = calc_digitos_posicoes(digitos);
    var novo_cpf = calc_digitos_posicoes(novo_cpf, 11);
    if (novo_cpf === valor) {
        return true;
    } else {
        return false;
    }
}

function valida_cpf_atualizado(valor) {
    var valida = verifica_cpf_atualizado(valor);
    valor = valor.toString();
    valor = valor.replace(/[^0-9]/g, '');
    if ( valida === 'CPF' ) {
        return valida_cpf(valor);
    }
    else {
        return false;
    }  
}

function formata_cpf_atualizado(valor) {
    var formatado = false;
    var valida = verifica_cpf_atualizado(valor);
    valor = valor.toString();
    valor = valor.replace(/[^0-9]/g, '');

    if (valida === 'CPF') {
        if ( valida_cpf( valor ) ) {
            formatado  = valor.substr( 0, 3 ) + '.';
            formatado += valor.substr( 3, 3 ) + '.';
            formatado += valor.substr( 6, 3 ) + '-';
            formatado += valor.substr( 9, 2 ) + '';
        }
    }
    return formatado;
}

$(function(){
    $('#cpf_atualizado').blur(function(){
        var valorvariavel = document.getElementById('cpf_atualizado').value;
        if(valorvariavel === '000.000.000-00' ||
           valorvariavel === '111.111.111-11' || 
           valorvariavel === '222.222.222-22' || 
           valorvariavel === '333.333.333-33' || 
           valorvariavel === '444.444.444-44' || 
           valorvariavel === '555.555.555-55' || 
           valorvariavel === '666.666.666-66' || 
           valorvariavel === '777.777.777-77' || 
           valorvariavel === '888.888.888-88' || 
           valorvariavel === '999.999.999-99'){

            alert('CPF Inválido por favor digite novamente!');
            document.getElementById('cpf_atualizado').value='';
            document.getElementById('cpf_atualizado').focus();
        }
        var cpf_atualizado = $(this).val();
        if ( formata_cpf_atualizado(cpf_atualizado)) {
            $(this).val( formata_cpf_atualizado(cpf_atualizado));
        } else {
            //Testa se CPF é valido
            var valorvariavel = document.getElementById('cpf_atualizado').value;
            if(valorvariavel !== ''){
                alert('CPF Inválido por favor digite novamente!');
                document.getElementById('cpf_atualizado').value='';
                document.getElementById('cpf_atualizado').focus();
            }
            
        } 
    });
});
//Fim CPF

//Função somente Números
function Onlynumbers(e)
{
    var tecla = new Number();
    if (window.event) {
        tecla = e.keyCode;
    }
    else if (e.which) {
        tecla = e.which;
    }
    else {
        return true;
    }
    if ((tecla >= "97") && (tecla <= "122")) {
        return false;
    }
}

//Função Somente Letras
function Onlychars(e)
{
    var tecla = new Number();
    if (window.event) {
        tecla = e.keyCode;
    }
    else if (e.which) {
        tecla = e.which;
    }
    else {
        return true;
    }
    if ((tecla >= "48") && (tecla <= "57")) {
        return false;
    }
}

//Máscara de Telefone Nono 9 Dígito
$(document).ready(function ($) {
    function inputHandler(masks, max, event) {
        var c = event.target;
        var v = c.value.replace(/\D/g, '');
        var m = c.value.length > max ? 1 : 0;
        VMasker(c).unMask();
        VMasker(c).maskPattern(masks[m]);
        c.value = VMasker.toPattern(v, masks[m]);
    }
    var telMask = ['(99) 9999-99999', '(99) 99999-9999'];
    var tel = document.querySelector('input[attrname=telephone1]');
    if(tel){
        VMasker(tel).maskPattern(telMask[0]); 
        tel.addEventListener('input', inputHandler.bind(undefined, telMask, 14), false);
    }

    var docMask = ['999.999.999-999', '99.999.999/9999-99'];
    var doc = document.querySelector('#doc');
    if(doc){
        VMasker(doc).maskPattern(docMask[0]);
        doc.addEventListener('input', inputHandler.bind(undefined, docMask, 14), false);
    }
});

//Confirmações de senha do Gerente
function verificarSenhas(){
    if (document.formGerente.senha.value == document.formGerente.confirmasenha.value){
        $('#mensagemlabelerro').hide();
        $('#definasenha').fadeOut(1000);
    }else{
        document.formGerente.confirmasenha.focus();
        document.formGerente.senha.value = '';
        document.formGerente.confirmasenha.value = '';
        document.formGerente.senha.focus();
        $('#mensagemlabelerro').show();
        $('#definasenha').fadeIn(1000);
    }
};

//Confirmações de senha do Colaborador
function verificarSenhasColaborador(){
    if (document.formColaborador.senha.value == document.formColaborador.confirmasenha.value){
        $('#mensagemlabelerro').hide();
        $('#definasenha').fadeOut(1000);
    }else{
        document.formColaborador.confirmasenha.focus();
        document.formColaborador.senha.value = '';
        document.formColaborador.confirmasenha.value = '';
        document.formColaborador.senha.focus();
        $('#mensagemlabelerro').show();
        $('#definasenha').fadeIn(1000);
    }
};

//Confirmações de senha do Segurança
function verificarSenhasSeguranca(){
    if (document.formSeguranca.senha.value == document.formSeguranca.confirmasenha.value){
        $('#mensagemlabelerro').hide();
        $('#definasenha').fadeOut(1000);
    }else{
        document.formSeguranca.confirmasenha.focus();
        document.formSeguranca.senha.value = '';
        document.formSeguranca.confirmasenha.value = '';
        document.formSeguranca.senha.focus();
        $('#mensagemlabelerro').show();
        $('#definasenha').fadeIn(1000);
    }
};

//Validar se Colaborador ou Gerente é maior de idade ou não
function getIdade(data) {
   var hoje = new Date();
   var nascimento = new Date(convertDateMMDDYYY(data.split("/")));
   var ano = hoje.getFullYear() - nascimento.getFullYear();
   var m = hoje.getMonth() - nascimento.getMonth();
   if (m < 0 || (m === 0 && hoje.getDate() < nascimento.getDate())) {
        ano--;
    }
    return ano;
}

function convertDateMMDDYYY(datearray) {
  return datearray[1] + '-' + datearray[0] + '-' + datearray[2];
}

function maiorIdade(){
  var data = document.getElementById("data");
  if(getIdade(data.value) < 18){
      document.getElementById("maiordeidade").innerHTML= "<div style='color: red; font-size: 12px;'><b>Usuário menor de idade. É necessário informar um usuário maior de idade para dar continuidade no cadastro!</b></style>";
      document.getElementById("data").value = '';
      document.getElementById("data").focus();
  }else{
      document.getElementById("maiordeidade").innerHTML= "";
  }
}

function validaDataPrevReserva(){
    now = new Date;
    mes = now.getMonth() + 1;
    if(mes < 10){
        mesatual = '0' + mes;
    }else{
        mesatual = mes;
    }
    
    dataatual = now.getDate() + '/' + mesatual + "/" + now.getFullYear();
    datadocampo = document.getElementById("data").value;
    if(dataatual > datadocampo){
        document.getElementById("mensagemdataprevisaosaida").innerHTML= "<div style='color: red; font-size: 12px;'><b>Não é possível inserir essa data, pois a data informada é menor que a data atual!</b></style>";
        document.getElementById("data").value = '';
        document.getElementById("data").focus();
    }else{
        document.getElementById("mensagemdataprevisaosaida").innerHTML= "";
    }
}

//Validação de Hora Previsão Saida
function validaHoraPrevisaoSaida(){
    now = new Date;
    //Verificar se a data é menor que a data atual
    hora = now.getHours();
    minutos = now.getMinutes();
    horaprevinformada = document.getElementById("horaprevsaida").value;
    //remove os : do campo para comparar a hora
    horaprevinformada = horaprevinformada.replace(/\:/g, '');
    if(minutos < 10){
        horaatualminutos = '0' + minutos;
    }else{
        horaatualminutos = minutos;
    }
    horaatual = hora + '' + horaatualminutos;
    
    if(horaatual > horaprevinformada){
        document.getElementById("mensagemhoraprevisaosaida").innerHTML= "<div style='color: red; font-size: 12px;'><b>Não é possível inserir a hora, pois a hora informada é menor que a hora atual!</b></style>";
        document.getElementById("horaprevsaida").value = '';
        document.getElementById("horaprevsaida").focus();
    }else{
        document.getElementById("mensagemhoraprevisaosaida").innerHTML= "";
    }
}

//Validação de Data Previsão Retorno
function validaDataPrevRetorno(){
    now = new Date;
    mes = now.getMonth() + 1;
    
    if(mes < 10){
        mesatual = '0' + mes;
    }else{
        mesatual = mes;
    }
    dataatual = now.getDate() + '/' + mesatual + "/" + now.getFullYear();
    datadocampo = document.getElementById("dataprevretorno").value;
    if(dataatual > datadocampo){
        document.getElementById("mensagemdataprevisaoretorno").innerHTML= "<div style='color: red; font-size: 12px;'><b>Não é possível inserir essa data, pois a data informada é menor que a data atual!</b></style>";
        document.getElementById("dataprevretorno").value = '';
        document.getElementById("dataprevretorno").focus();
    }else{
        document.getElementById("mensagemdataprevisaoretorno").innerHTML= "";
    }
}

//Validação de Hora Previsão Retorno
function validaHoraPrevisaoRetorno(){
    now = new Date;
    hora = now.getHours();
    minutos = now.getMinutes();
    //Verificar se a data é menor que a data atual
    
    horaprevinformada = document.getElementById("horaprevretorno").value;
    horaprevinformada = horaprevinformada.replace(/\:/g, '');
    
    if(minutos < 10){
        horaatualminutos = '0' + minutos;
    }else{
        horaatualminutos = minutos;
    }
    horaatual = hora + '' + horaatualminutos;
    
    if(horaatual > horaprevinformada){
        document.getElementById("mensagemhoraprevisaoretorno").innerHTML= "<div style='color: red; font-size: 12px;'><b>Não é possível inserir a hora, pois a hora informada é menor que a hora atual!</b></style>";
        document.getElementById("horaprevretorno").value = '';
        document.getElementById("horaprevretorno").focus();
    }else{
        document.getElementById("mensagemhoraprevisaoretorno").innerHTML= "";
    }
}