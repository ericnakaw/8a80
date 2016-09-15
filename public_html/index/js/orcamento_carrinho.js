$(document).ready(function () {
//        $(".alert").fadeOut(3000);

    if ('<?= $action ?>' == 'quantity_updated') {
        $.notify({message: '<strong><?= $name ?></strong> quantidade atualizada com sucesso!'}, {})
    }
    if ('<?= $action ?>' == 'removed') {
        $.notify({message: '<strong><?= $name ?></strong> foi removido do carrinho com sucesso!'}, {type: 'success'})
    }
    if ('<?= $action ?>' == 'update_error') {
        $.notify({message: '<strong><?= $name ?></strong> não foi possivel atualizar a quantidade!'})
    }
});

function atualizar() {
    var id = $('#id').val();
    var name = $('#name').val();
    var qtd = $('#quantity').val();
    qtd = parseInt(qtd);
    if (qtd > 0) {
        window.location.replace("orcamento_produto_atualizar_carrinho.php?id=" + id + '&name=' + name + '&quantity=' + qtd);
    }
    else {
        $.notify({message: 'A quantidade deve ser maior ou igual a 1'}, {type: 'danger'});
        $("#quantity").focus();
    }
}