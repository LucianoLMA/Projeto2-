//Função para máscara de valor
$(document).ready(function ($) {
    $("#valor").maskMoney({symbol: 'R$ ',showSymbol: true, thousands: '.', decimal: ',', symbolStay: true});
    $("#kmmascarainicial").maskMoney({decimal: '.'});
    $("#kmmascarafinal").maskMoney({decimal: '.'});
    $("#kmretorno").maskMoney({decimal: '.'});
    $("#cpf_atualizado").mask("999.999.999-99");
    $("#rg").mask("9999999999");
    $("#telefone").mask("(99)9999-9999");
    $("#celular").mask("(99)99999-9999");
    $("#cep").mask("99999-999");
    $("#data").mask("99/99/9999");
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

//Comparar as datas para reserva
function checarDatas() {
    var formReserva = document.formReserva;
    console.log(formReserva);
    var datasaidaprev = new Date(formReserva.datasaidaprev.value);
    var dataretprev = new Date(formReserva.dataretprev.value);
    
    if (!datasaidaprev || !dataretprev) return false;
    if (datasaidaprev > dataretprev) {
        alert("Data Previsão Saída não pode ser maior que a Data Previsão Retorno");
        formReserva.dataretprev.value='';
        formReserva.dataretprev.focus();
        return false;
    } else {
        return true;
    }
}

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


//Remover virgula por nada
function removervirgulapornada(){ 
    var string = $('#kmmascarainicial').val();
    string = string.replace(',','');
    $('#kmmascarainicial').val(string);
    
    var string = $('#kmmascarafinal').val();
    string = string.replace(',','');
    $('#kmmascarafinal').val(string);
}
     
//Begin formatação CPF
function verifica_cpf_atualizado(valor) {
    valor = valor.toString();
    valor = valor.replace(/[^0-9]/g, '');
    if ( valor.length === 11 ) {
        return 'CPF';
    } else {
        return false;
    }
} 

/*function calc_digitos_posicoes(digitos, posicoes=10, soma_digitos=0) {
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
    
}*/

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
            //Se os números informados no campo CPF não forem todos iguais será executado esse teste abaixo
            var valorvariavel = document.getElementById('cpf_atualizado').value;
            if(valorvariavel !== ''){
                alert('CPF Inválido por favor digite novamente!');
                document.getElementById('cpf_atualizado').value='';
                document.getElementById('cpf_atualizado').focus();
            }
            
        } 
    });
});
//End formatação CPF

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