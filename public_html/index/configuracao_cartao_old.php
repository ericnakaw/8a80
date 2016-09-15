<!--Fim Configuração do Cartão ou Conteúdo-->
<div class="col-md-6" id="conteudo_cartao">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b id="legend_envelope"><?php !$modelo_completo ? print 'Configuração do Cartão' : print 'Configuração Interna do Envelope' ?></b>
        </div>
        <div class="panel-body">
            <?php if (!$modelo_completo) { ?>
                <!--Fim: Lista Papel-->
                <div class="form-group jumbotron" style="padding: 0px;">
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>
                                    <?php
                                    if (empty($_SESSION['convite']['cartao']['papel'])) {
                                        ?>
                                        <button type="button" onclick="altera_modal('cartao')" class="btn btn-default btn-sm" data-toggle="modal" 
                                                data-target="#modal_papel"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </button>
                                        <?php
                                    }
                                    ?>
                                    Papel</th>
                                <th class="btn_excluir">Excluir</th>
                            </tr>
                        </thead>
                        <tbody id="tb_ca_papel">
                            <?php
                            if (!empty($_SESSION['convite']['cartao']['papel'])) {
                                list($i, $n,,$categoria) = explode(':', $_SESSION['convite']['cartao']['papel']);
                                ?>

                                <tr>
                                    <td class="text-uppercase"><h5 class="modalTexto"><b><?= $categoria ?></b> - <?= $n ?></h5></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="altera_modal_item('cartao',0)" data-toggle="modal" data-target="#modal_papel"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <a href="orcamento_convite_salvar.php?acao=excluir&elemento=cartao&conteudo=papel" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!--Fim: Lista Papel-->
                <?php
            } else {
                unset($_SESSION['convite']['cartao']['papel']);
            }
            ?>
            <!--Fim: Lista Impressao-->
            <div class="form-group jumbotron" style="padding: 0px;">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>
                                <button type="button" onclick="altera_modal('cartao')" class="btn btn-default btn-sm" data-toggle="modal" 
                                        data-target="#modal_impressao"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                                Impressão</th>
                            <th class="btn_detalhe">Detalhe</th>
                            <th class="btn_excluir">Excluir</th>
                        </tr>
                    </thead>
                    <tbody id="tb_ca_impressao">
                        <?php
                        if (!empty($_SESSION['convite']['cartao']['impressao'])) {
                            $arr = $_SESSION['convite']['cartao']['impressao'];

                            foreach ($arr as $key => $value) {
                                list($i, $n,, $d) = explode(':', $value);
                                ?>
                                <tr>
                                    <td class="text-uppercase"><h5 class="modalTexto"><?= $n ?></h5></td>
                                    <td><h5 class="modalTexto"><?= $d ?></h5></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="altera_modal_item('cartao',<?= $key ?>)" data-toggle="modal" data-target="#modal_impressao"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <a href="orcamento_convite_salvar.php?acao=excluir&elemento=cartao&conteudo=impressao&final=<?= $key ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!--Fim: Lista Impressao-->

            <!--Inicio: Lista Acabamento-->
            <div class="form-group jumbotron" style="padding: 0px;">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>
                                <button type="button" onclick="altera_modal('cartao')" class="btn btn-default btn-sm" data-toggle="modal" 
                                        data-target="#modal_acabamento"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                                Acessório</th>
                            <th class="btn_detalhe">Detalhe</th>
                            <th class="btn_excluir">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($_SESSION['convite']['cartao']['acabamento'])) {
                            $arr = $_SESSION['convite']['cartao']['acabamento'];

                            foreach ($arr as $key => $value) {
                                list($i, $n,, $d) = explode(':', $value);
                                ?>
                                <tr>
                                    <td class="text-uppercase"><h5 class="modalTexto"><?= $n ?></h5></td>
                                    <td><h5 class="modalTexto"><?= $d ?></h5></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="altera_modal_item('cartao',<?= $key ?>)" data-toggle="modal" data-target="#modal_acabamento"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <a href="orcamento_convite_salvar.php?acao=excluir&elemento=cartao&conteudo=acabamento&final=<?= $key ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!--Fim: Lista Acabamento-->

            <!--Fim: Lista Servico-->
            <div class="form-group jumbotron" style="padding: 0px;">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>
                                <button type="button" onclick="altera_modal('cartao')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal_servico">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true">
                                    </span>
                                </button>
                                Acabamento</th>
                            <th class="btn_detalhe">Detalhe</th>
                            <th class="btn_excluir">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($_SESSION['convite']['cartao']['servico'])) {
                            $arr = $_SESSION['convite']['cartao']['servico'];

                            foreach ($arr as $key => $value) {
                                list($i, $n, $v, $d) = explode(':', $value);
                                ?>
                                <tr>
                                    <td class="text-uppercase"><h5 class="modalTexto"><?= $n ?></h5></td>
                                    <td><h5 class="modalTexto"><?= $d ?></h5></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="altera_modal_item('cartao',<?= $key ?>)" data-toggle="modal" data-target="#modal_servico"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <a href="orcamento_convite_salvar.php?acao=excluir&elemento=cartao&conteudo=servico&final=<?= $key ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!--Fim: Lista Servico-->

            <!--Inicio: Lista Fonte-->
            <div class="form-group jumbotron" style="padding: 0px;">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>
                                <button type="button" onclick="altera_modal('cartao')" class="btn btn-default btn-sm" data-toggle="modal" 
                                        data-target="#modal_fonte"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                                Fonte</th>
                            <th class="btn_detalhe">Detalhe</th>
                            <th class="btn_excluir">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($_SESSION['convite']['cartao']['fonte'])) {
                            $arr = $_SESSION['convite']['cartao']['fonte'];

                            foreach ($arr as $key => $value) {
                                list($i, $n, $d) = explode(':', $value);
                                ?>
                                <tr>
                                    <td class="text-uppercase"><h5 class="modalTexto"><?= $n ?></h5></td>
                                    <td><h5 class="modalTexto"><?= $d ?></h5></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="altera_modal_item('cartao',<?= $key ?>)" data-toggle="modal" data-target="#modal_fonte"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <a href="orcamento_convite_salvar.php?acao=excluir&elemento=cartao&conteudo=fonte&final=<?= $key ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!--Fim: Lista Fonte-->

            <!--Inicio: Lista Detalhe-->
            <div class="form-group jumbotron" style="padding: 0px;">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                if (empty($_SESSION['convite']['cartao']['detalhe'])) {
                                    ?>
                                    <button type="button" onclick="altera_modal('cartao')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal_detalhe">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true">
                                        </span>
                                    </button>
                                    <?php
                                }
                                ?>
                                Detalhe do <?php !$modelo_completo ? print 'cartão' : print 'conteudo'; ?></th>
                            <th class="btn_excluir">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($_SESSION['convite']['cartao']['detalhe'])) {
                            ?>
                            <tr>
                                <td><h5 class="modalTexto"><?= $_SESSION['convite']['cartao']['detalhe'] ?></h5></td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="altera_modal_item('cartao',0)" data-toggle="modal" data-target="#modal_detalhe"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <a href="orcamento_convite_salvar.php?acao=excluir&elemento=cartao&conteudo=detalhe" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!--Fim: Lista Detalhe-->
        </div>
    </div>
</div>