<script>
    function confDeletar(id,nome) {
        $("#myModalLabel").html("Deseja realmente deletar <b>" + nome + "</b> ?");
        $("#btnApagar").html("<a href ='<?=$confDelete ?>?id=" + id + "&name="+ nome + "' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span>Apagar</a>");
    }
</script>
<!-- Modal -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 id="myModalLabel"></h4>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <span id="btnApagar"></span>
            </div>
        </div>
    </div>
</div>
<!--Fim do Modal-->