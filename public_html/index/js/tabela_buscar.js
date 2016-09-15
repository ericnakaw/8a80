$(document).ready(function () {
    $(".alert").fadeOut(3000);
});
$(function () {
    $("#input-search").keyup(function () {
        //pega o css da tabela 
        var tabela = $(this).attr('alt');
        if ($(this).val() !== "") {
            $("." + tabela + " tbody>tr").hide();
            $("." + tabela + " td:contains-ci('" + $(this).val() + "')").parent("tr").show();
        } else {
            $("." + tabela + " tbody>tr").show();
        }
    });
});
$.extend($.expr[":"], {
    "contains-ci": function (elem, i, match, array) {
        return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
});
$(function () {
    $("#tabela input").keyup(function () {
        var index = $(this).parent().index();
        var nth = "#tabela td:nth-child(" + (index + 1).toString() + ")";
        var valor = $(this).val().toUpperCase();
        $("#tabela tbody tr").show();
        $(nth).each(function () {
            if ($(this).text().toUpperCase().indexOf(valor) < 0) {
                $(this).parent().hide();
            }
        });
    });

    //Limpa o Filtro
//        $("#tabela input").blur(function () {
//            $(this).val("");
//        });
});
$(function () {
    $("#tabela input").keyup(function () {
        var index = $(this).parent().index();
        var nth = "#tabela td:nth-child(" + (index + 1).toString() + ")";
        var valor = $(this).val().toUpperCase();
        $("#tabela tbody tr").show();
        $(nth).each(function () {
            if ($(this).text().toUpperCase().indexOf(valor) < 0) {
                $(this).parent().hide();
            }
        });
    });

    //Limpa o Filtro
//        $("#tabela input").blur(function () {
//            $(this).val("");
//        });
});

//em teste....
function alteraInputCategoria() {
    alert("Select Alterado");
    var valor = $("#selectCategoria").val();
    $("#input-search-categoria1").prop('value','doce');
}