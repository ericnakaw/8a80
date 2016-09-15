//Filtro para o modal do Papel
$(document).ready(function () {
    $("#categoriaPapel").change(function () {
        var categoria = $("#categoriaPapel").val();
        var papelBase = $("#papelBase option");
        $("#papel").find('option').remove();

        var papel = document.getElementById("papel");
        papelBase.each(function (index, option) {
            var catPapel = option.value;
            catPapel = catPapel.split("§");
            if (catPapel[3] === categoria) {
                var opt = document.createElement('OPTION');
                opt.setAttribute('value', option.value);
                var text = document.createTextNode(option.text);
                opt.appendChild(text);
                papel.appendChild(opt);
            }
        });
    });
    $.notifyDefaults({type: 'danger', placement: {from: "top", align: "left"}, delay: 12000});

    $("#add_convite_carrinho").click(function () {

        var convite_valido = 0;
        // pegar tipo do modelo
        var valueModelo = $("#modelo option:selected").val();
        var tipoModelo = valueModelo.split('§');

        // verifica modelo
        if (document.getElementById("modelo").selectedIndex < 1) {
            convite_valido += 1;
            $.notify({message: 'Selecione um <b>Modelo</b>'});
        }

        // verifica quantidade
        if (!parseInt($('#quantidade').val()) || parseInt($('#quantidade').val()) < 1) {
            convite_valido += 1;
            $.notify({message: 'Adicione a <b>Quantidade</b>'});
        }

        // verifica papel do envelope
//        if ($("#tb_ev_papel tr").length < 1) {
//            convite_valido += 1;
//            $.notify({message: 'Adicione um <b>papel</b> para o envelope'});
//        }

        // verifica impressao do cartao/conteudo
        if ($("#tb_ca_impressao tr").length < 1) {
            convite_valido += 1;
            $.notify({message: 'Adicione uma <b>impressão</b> para o Cartão'});
        }

        // caso for modelo completo
        if (tipoModelo[2] === '0') {
            // verifica papel do cartao/conteudo
//            if ($("#tb_ca_papel tr").length < 1) {
//                convite_valido += 1;
//                $.notify({message: 'Adicione um <b>papel</b> para o Cartão'});
//            }
        }

        if (convite_valido == 0) {
            window.location.replace("orcamento_convite_salvar.php?acao=add_convite_carrinho");
        }
    });

    $("#quantidade").change(function () {
        var qtd = parseInt($('#quantidade').val());
        window.location.replace("orcamento_convite_salvar.php?acao=salvar_quantidade&quantidade=" + qtd);
    });
    $("#desconto").change(function () {
//        if (this.selectedIndex !== 0) {
//        window.location.replace("orcamento_convite_salvar.php?acao=salvar_desconto_convite&desconto=" + $("#desconto option:selected").val());
//    }
        var desc = parseInt($('#desconto').val());
        if (desc >= 0 && desc <= 20) {
            window.location.replace("orcamento_convite_salvar.php?acao=salvar_desconto_convite&desconto=" + desc);
        }
        else {
            $.notify({message: 'Porcentagem do desconto fora do limite permitido'});
        }
    });
    $("#calcula_convite").click(function () {
        window.location.replace("orcamento_convite_salvar.php?acao=calcula_convite");
    });

    $("#modelo").change(function () {
        if (this.selectedIndex !== 0) {
            window.location.replace("orcamento_convite_salvar.php?modelo=" + $("#modelo option:selected").val());
        }
    });
    $("#catalogo").change(function () {
        if (this.selectedIndex !== 0) {
            window.location.replace("orcamento_convite_salvar.php?acao=seleciona_pagina&catalogo=" + $("#catalogo option:selected").val());
        }
    });
    $("#catalogo_input").change(function () {
        var catalogo_input = $('#catalogo_input').val();
        window.location.replace("orcamento_convite_salvar.php?acao=seleciona_pagina&catalogo=" + catalogo_input + "&desconto=" + $("#desconto").val());

    });
    $("#convite_orcamento").change(function () {
        if (this.selectedIndex !== 0) {
            window.location.replace("orcamento_convite_salvar.php?acao=seleciona_convite_orcamento&convite_orcamento=" + $("#convite_orcamento option:selected").val());
        }
    });

});
function altera_modal(modal) {
    if (modal === 'envelope') {
        $(".elemento").prop('value', 'envelope');
        $(".acao").prop('value', 'adicionar');
//            $('#servico_envelope').show();
//            $('#servico_envelope').prop('name', 'servico');
//            $('#servico_cartao').hide();
//            $('#servico_cartao').prop('name', '');
    }
    if (modal === 'cartao') {
        $(".elemento").prop('value', 'cartao');
        $(".acao").prop('value', 'adicionar');
//            $('#servico_cartao').show();
//            $('#servico_cartao').prop('name', 'servico');
//            $('#servico_envelope').hide();
//            $('#servico_envelope').prop('name', '');
    }
}
function altera_modal_item(modal, posicao) {
    if (modal === 'envelope') {
        $(".elemento").prop('value', 'envelope');
        $(".acao").prop('value', 'alterar');
        $(".posicao").prop('value', posicao);
    }
    if (modal === 'cartao') {
        $(".elemento").prop('value', 'cartao');
        $(".acao").prop('value', 'alterar');
        $(".posicao").prop('value', posicao);
    }
}

function modelo(modelo, unica) {
    $("#legend_modelo").text("Modelo " + modelo);
    if (unica) {
        $('#legend_cartao').text("Conteudo");
        $('#cartao_papel').parent().css('display', 'none');
        $('#cartao_papel').val("");
        $('#cartao_fita').parent().css('display', 'none');
        $('#cartao_fita').val("");
    } else {
        $('#legend_cartao').text("Cartão");
        $('#cartao_papel').parent().css('display', 'block');
        $('#cartao_fita').parent().css('display', 'block');
    }
}

