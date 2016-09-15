<script>
    function valida_tipo_solicitacao() {
        //document.getElementById("data_entrega_convite").disabled = true;
    }
</script>
<div id="conteudo" class="col-md-12">
    <div id="orcamento_carrinho_resumo">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-9"><b>Dados Complementares do Orçamento / Pedido</b></div>
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Ações <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="orcamento_convite_salvar.php?acao=limpar_todos" data-toggle="tooltip" data-placement="left" title="Retira todos os convites do carrinho">Excluir Convites <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="orcamento_produto_remover_carrinho.php?acao=limpar_todos" data-toggle="tooltip" data-placement="left" title="Retira todos os convites do carrinho">Excluir Produtos <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                            </ul>
                        </div>
                        <button type="submit" class="btn btn-success">Finalizar</button>
                        <div class="col-md-3">
                        </div>
                    </div>
                </div>

            </div>
            <div class="panel-body">
                <div class="form-group">
                    <input type="hidden" name="status" id="status" value="1">
                    <div class="col-md-4">
                        <label for="local_retirada">Local de Retirada / Entrega:</label>
                        <select id="local_retirada" name="local_retirada" class="form-control input-sm">
                            <option value="">Selecione</option>
                            <option value="tatuape" <?php
                            if ($_SESSION['cliente']['local_retirada'] == "tatuape") {
                                print 'selected';
                            }
                            ?>>Loja Tatuapé</option>
                            <option value="guarulhos" <?php
                            if ($_SESSION['cliente']['local_retirada'] == "guarulhos") {
                                print 'selected';
                            }
                            ?> >Loja Guarulhos</option>
                            <option value="correios" <?php
                            if ($_SESSION['cliente']['local_retirada'] == "correios") {
                                print 'selected';
                            }
                            ?>>Correios</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="tipo_solicitacao">Tipo de Solicitação:</label>
                        <select id="tipo_solicitacao" name="tipo_solicitacao" class="form-control input-sm tipo_solicitacao" onchange="return valida_tipo_solicitacao()">
                            <option value="">Selecione</option>
                            <option value="orcamento" <?php
                            if ($_SESSION['cliente']['tipo_solicitacao'] == "orcamento") {
                                print 'selected';
                            }
                            ?>>Orcamento</option>
                            <option value="pedido" <?php
                            if ($_SESSION['cliente']['tipo_solicitacao'] == "pedido") {
                                print 'selected';
                            }
                            ?>>Pedido</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="local_venda">Local de Venda:</label>
                        <select id="local_venda" name="local_venda" class="form-control input-sm">
                            <option value="">Selecione</option>
                            <option value="tatuape" <?php
                            if ($_SESSION['local_venda'] == "tatuape") {
                                print 'selected';
                            }
                            ?>>Loja Tatuapé</option>
                            <option value="guarulhos" <?php
                            if ($_SESSION['local_venda'] == "guarulhos") {
                                print 'selected';
                            }
                            ?>>Loja Guarulhos</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 