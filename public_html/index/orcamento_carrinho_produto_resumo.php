    <div id="conteudo" class="col-md-12">
    <div id="orcamento_carrinho_resumo">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-9"><b>Carrinho de Produtos</b></div> 
                        <div class="col-md-3">
                            <a class="btn btn-success" href="#" data-toggle="tooltip" data-placement="left" title="Salva somente os convites que estão no carrinho">Salvar <span class="glyphicon glyphicon-floppy-disk"></span></a>
                            
                        </div>
                    </div>
                </div>

            </div>
            <div class="panel-body">
                <table class='table table-striped table-hover table-responsive table-hover'>
                    <thead>
                        <tr>
                            <th width="3%">#</th>
                            <th width="5%">Entrega</th>
                            <th width="12%">Produto</th>
                            <th width="35%">Descrição</th>
                            <th width="10%">Qtd</th>
                            <th width="5%">Unitário</th>
                            <th width="10%">Sub-Total</th>
                            <th width="10%">Excluir</th>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php
                        // get the product ids
                        $ids = "";
                        $countProduto = 1;
                        $confDelete = 'orcamento_produto_remover_carrinho.php';
                        foreach ($_SESSION['cart_items'] as $id => $value) {
                            $ids = $ids . $id . ",";
                        }
                        // remove the last comma
                        $ids = rtrim($ids, ',');
                        $query = "SELECT p.id, p.nome, p.valor, p.descricao,  pc.nome as categoria_nome FROM
                                            `produto` as p left join `produto_categoria` as pc on p.produto_categoria_id = pc.id
                                             where p.id in (" . $ids . ")";

                        $conexao = new Conexao();
                        if ($ids != "") {
                            $resultado = $conexao->sql_query($query);
                            $total_price = 0;
                            while ($tabela = mysql_fetch_array($resultado)) {
                                foreach ($_SESSION['cart_items'] as $id => $value) {
                                    if ($tabela['id'] == $id) {
                                        list($nome, $quantity, $data) = explode(':', $_SESSION['cart_items'][$id]);
                                        $subTotal = $quantity * $tabela['valor'];
                                        ?>
                                        <tr>
                                            <td><?= $countProduto ?></td>
                                            <td><input type="date" id="data" name="data" class="form-control input-sm" value="<?= $data ?>"></td>
                                            <td><span class="glyphicon glyphicon-gift"></span>  <b><?= $tabela['nome'] ?></b></td>
                                            <td><?= $tabela['descricao'] ?></td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="hidden" id="id" name="id" value="<?= $tabela['id'] ?>">
                                                    <input type="hidden" id="name" name="name" value="<?= $tabela['nome'] ?>">
                                                    <input style="  text-align: center" type="number" class="form-control input-sm" id="quantity" name="quantity" value="<?= $quantity ?>" min="1" onchange="atualizar()">
                                                </div>
                                            </td>
                                            <td>R$ <?= number_format($tabela['valor'], 2, ',', '.') ?></td><!--valor unitário-->
                                            <td>R$ <?= number_format($subTotal, 2, ',', '.') ?></td><!--sub-total-->
                                            <td>
                                                <a data-toggle="modal" data-target="#myModal" data-whatever="@mdo" onclick="confDeletar(<?= $tabela['id'] ?>, '<?= $tabela['nome'] ?>')" class="btn btn-danger">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $total_price+=$subTotal;
                                        $countProduto++;
                                    }
                                }
                            }
                        }
                        ?>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class='text-right text-uppercase'><b>Total</b></td>
                            <td>R$ <?= number_format($total_price * 0.9, 2, ',', '.') ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>