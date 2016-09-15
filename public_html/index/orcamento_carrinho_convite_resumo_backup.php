<div id="orcamento_carrinho_resumo" class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-9"><b>Carrinho de Convites</b></div> 
                    <div class="col-md-3">
                        <a class="btn btn-success" href="orcamento_convite_salvar.php?acao=salvar_orcamento" data-toggle="tooltip" data-placement="left" title="Salva somente os convites que estão no carrinho">Salvar <span class="glyphicon glyphicon-floppy-disk"></span></a>
                        <a class="btn btn-danger" href="orcamento_convite_salvar.php?acao=limpar_todos" data-toggle="tooltip" data-placement="left" title="Retira todos os convites do carrinho">Excluir Todos <span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <!--Inicio: Tabela do carrinho da sessão-->
            <div class="table-responsive">
                <table class="table table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th width="3%">#</th>
                            <th width="5%">Entrega</th>
                            <th width="12%">Modelo</th>
                            <th width="35%">Descrição</th>
                            <th width="10%">Qtd</th>
                            <th width="5%">Unitário</th>
                            <th width="10%">Sub-Total</th>
                            <th width="5%">Editar</th>
                            <th width="5%">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $countItem = 1;
                        foreach ($_SESSION as $key => $value) {
                            if (strpos($key, 'convite-') === 0) {
                                list(, $n) = explode('-', $key);
                                list(, $nome_modelo,,, ) = explode(':', $_SESSION[$key]['modelo']);
                                ?>
                                <tr>
                                    <td><?= $countItem ?></td>
                                    <td><input type="date" id="data" name="data" class="form-control" value="<?= $data ?>"></td>
                                    <td><span class="glyphicon glyphicon-envelope">  <b><?= $nome_modelo ?></b></span></td>
                                    <td><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal<?= $countItem ?>">Mais detalhes <span class="glyphicon glyphicon-info-sign"></span></button>
                                    </td>
                                    <?php
                                    $unitario = number_format($_SESSION[$key]['valor'], 2, ',', '.');
                                    $total = $_SESSION[$key]['quantidade'] * number_format($_SESSION[$key]['valor'], 2, '.', '');
                                    $total = number_format($total, 2, ',', '.');
                                    ?>
                                    <td><?= $_SESSION[$key]['quantidade'] ?></td>
                                    <td>R$ 
                                        <?php
                                        if (empty($_SESSION[$key]['descontoPorcentagem']) || $_SESSION[$key]['descontoPorcentagem'] == 0) {
                                            print $unitario;
                                        } else {
                                            print number_format($_SESSION[$key]['desconto'], 2, ',', '.');
                                        }
                                        ?>
                                    </td>
                                    <td>R$ 
                                        <?php
                                        if (empty($_SESSION[$key]['descontoPorcentagem']) || $_SESSION[$key]['descontoPorcentagem'] == 0) {
                                            print $total;
                                        } else {
                                            $total_desconto = number_format($_SESSION[$key]['desconto'], 2) * $_SESSION[$key]['quantidade'];
                                            print $total_desconto = number_format($total_desconto, 2, ',', '.');
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="orcamento_convite_salvar.php?acao=atualizar_carrinho_convite&nome=<?= $key ?>" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="left" title="Editar qualquer dado deste convite"></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="orcamento_convite_salvar.php?acao=excluir_convite&nome=<?= $key ?>" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="left" title="Exclui somente este convite do carrinho"></span>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Modal -->
                            <div class="modal fade" id="myModal<?= $countItem ?>" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Descrição</h4>
                                        </div>
                                        <div class="modal-body">
                                            <!--Imprime na tela os detalhes do Envelope-->
                                            <?php
                                            if (!empty($_SESSION[$key]['envelope']['papel'])) {
                                                list($id, $papelEnvelope) = explode(':', $_SESSION[$key]['envelope']['papel']);
                                                ?>
                                                <b>Papel do Envelope:</b> <?= $papelEnvelope ?><br>
                                                <?php
                                            }

                                            foreach ($_SESSION[$key]['envelope']['impressao'] as $key1 => $value1) {
                                                list($i, $impressaoEnvelope, $d) = explode(':', $value1);
                                                ?>
                                                <b> Impressão do Envelope: </b><?= $impressaoEnvelope ?><br>
                                                <?php
                                            }
                                            foreach ($_SESSION[$key]['envelope']['fonte'] as $key2 => $value2) {
                                                list($i, $fonteEnvelope, $d) = explode(':', $value2);
                                                ?>
                                                <b> Fonte do Envelope:</b><?= $fonteEnvelope ?><br>
                                                <?php
                                            }

                                            foreach ($_SESSION[$key]['envelope']['acabamento'] as $key3 => $value3) {
                                                list($i, $acabamentoEnvelope, $d) = explode(':', $value3);
                                                if (!empty($n)) {
                                                    ?>
                                                    <b> Acabamento Envelope: </b><?= $acabamentoEnvelope ?><br>
                                                    <?php
                                                }
                                            }

                                            list($id_f, $tipoLaco, $valor_f, $id_c, $corFita, $mm) = explode(':', $_SESSION[$key]['envelope']['fita']);
                                            if (!empty($tipoLaco) || !empty($valor_f)) {
                                                ?>
                                                <b> Tipo de laço: </b><?= $tipoLaco ?><br>
                                                <b> Cor da fita: </b><?= $corFita ?><br>
                                                <?php
                                            }
                                            if (!empty($_SESSION[$key]['envelope']['detalhe'])) {
                                                ?>
                                                <b> Detalhe do Envelope: </b><?= $_SESSION[$key]['envelope']['detalhe'] ?><br>
                                                <?php
                                            }
                                            foreach ($_SESSION[$key]['envelope']['servico'] as $key1 => $value1) {
                                                list($i, $impressaoEnvelope, $d) = explode(':', $value1);
                                                ?>
                                                <b> Serviço do Envelope: </b><?= $impressaoEnvelope ?><br>
                                                <?php
                                            }
                                            ?>
                                            <!--FIM Imprime na tela os detalhes do Envelope-->

                                            <!--Imprime na tela os detalhes do cartão-->
                                            <?php
                                            if (!empty($_SESSION[$key]['cartao']['papel'])) {
                                                list($id, $papelCartao) = explode(':', $_SESSION[$key]['cartao']['papel']);
                                                ?>
                                                <br><b>Papel Cartao:</b> <?= $papelCartao ?><br>
                                                <?php
                                            }

                                            foreach ($_SESSION[$key]['cartao']['impressao'] as $key1 => $value1) {
                                                list($i, $impressaoCartao, $d) = explode(':', $value1);
                                                ?>
                                                <b> Impressão Cartao: </b><?= $impressaoCartao ?><br>
                                                <?php
                                            }
                                            foreach ($_SESSION[$key]['cartao']['fonte'] as $key2 => $value2) {
                                                list($i, $fonteCartao, $d) = explode(':', $value2);
                                                ?>
                                                <b> Fonte Cartao:</b><?= $fonteCartao ?><br>
                                                <?php
                                            }

                                            foreach ($_SESSION[$key]['cartao']['acabamento'] as $key3 => $value3) {
                                                list($i, $acabamentoCartao, $d) = explode(':', $value3);
                                                if (!empty($n)) {
                                                    ?>
                                                    <b> Acabamento Cartao: </b><?= $acabamentoCartao ?><br>
                                                    <?php
                                                }
                                            }

                                            if (!empty($_SESSION[$key]['cartao']['detalhe'])) {
                                                ?>
                                                <b> Detalhe do Cartao: </b><?= $_SESSION[$key]['cartao']['detalhe'] ?>
                                                <?php
                                            }
                                            foreach ($_SESSION[$key]['cartao']['servico'] as $key1 => $value1) {
                                                list($i, $impressaoCartao, $d) = explode(':', $value1);
                                                ?>
                                                <b> Serviço do Cartão: </b><?= $impressaoCartao ?><br>
                                                <?php
                                            }
                                            ?>
                                            <!--FIM Imprime na tela os detalhes do cartão-->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php
                            $countItem ++; //indica a quantidade de itens do carrinho do convite
                        }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!--Fim: Carrinho da sessão-->
        </div>
    </div>
</div>