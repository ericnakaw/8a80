<!--Inicio Configuração do Envelope-->
<div class="col-md-6" id="conteudo_envelope">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-envelope"></span> <b id="legend_envelope">Configuração do Envelope</b>
        </div>
        <div class="panel-body">
            <!--Fim: Lista Papel-->
            <div class="form-group jumbotron" style="padding: 0px;">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                if (empty($_SESSION['convite']['envelope']['papel'])) {
                                    ?>
                                    <button type="button" onclick="altera_modal('envelope')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal_papel">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </button>
                                    <?php
                                }
                                ?>
                                <span class="glyphicon glyphicon-file"></span> Papel
                            </th>
                            <th class="btn_excluir">Excluir
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tb_ev_papel">
                        <?php
                        if (!empty($_SESSION['convite']['envelope']['papel'])) {
                            list($i, $n,, $categoria) = explode(':', $_SESSION['convite']['envelope']['papel']);
                            ?>

                            <tr>
                                <td class="text-uppercase"><h5 class="modalTexto"><b><?= $categoria ?></b> - <?= $n ?></h5></td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="altera_modal_item('envelope', 0)" data-toggle="modal" data-target="#modal_papel"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <a href="orcamento_convite_salvar.php?acao=excluir&elemento=envelope&conteudo=papel" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!--Fim: Lista Papel-->

            <!--Inicio: Lista Impressao-->
            <div class="form-group jumbotron" style="padding: 0px;">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>
                                <button type="button" onclick="altera_modal('envelope')" class="btn btn-default btn-sm" data-toggle="modal" 
                                        data-target="#modal_impressao"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                                <span class="glyphicon glyphicon-print"></span> Impressão
                            </th>
                            <th class="btn_detalhe">Detalhe</th>
                            <th class="btn_excluir">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($_SESSION['convite']['envelope']['impressao'])) {
                            $arr = $_SESSION['convite']['envelope']['impressao'];

                            foreach ($arr as $key => $value) {
                                list($i, $n,, $d) = explode(':', $value);
                                ?>
                                <tr>
                                    <td class="text-uppercase"><h5 class="modalTexto"><?= $n ?></h5></td>
                                    <td><h5 class="modalTexto"><?= $d ?></h5></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="altera_modal_item('envelope',<?= $key ?>)" data-toggle="modal" data-target="#modal_impressao"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <a href="orcamento_convite_salvar.php?acao=excluir&elemento=envelope&conteudo=impressao&final=<?= $key ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
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
                                <button type="button" onclick="altera_modal('envelope')" class="btn btn-default btn-sm" data-toggle="modal" 
                                        data-target="#modal_acabamento"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                                <span class="glyphicon glyphicon-leaf"></span> Acessório
                            </th>
                            <th class="btn_detalhe">Detalhe</th>
                            <th class="btn_excluir">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($_SESSION['convite']['envelope']['acabamento'])) {
                            $arr = $_SESSION['convite']['envelope']['acabamento'];

                            foreach ($arr as $key => $value) {
                                list($i, $n,, $d) = explode(':', $value);
                                ?>
                                <tr>
                                    <td class="text-uppercase"><h5 class="modalTexto"><?= $n ?></h5></td>
                                    <td><h5 class="modalTexto"><?= $d ?></h5></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="altera_modal_item('envelope',<?= $key ?>)" data-toggle="modal" data-target="#modal_acabamento"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <a href="orcamento_convite_salvar.php?acao=excluir&elemento=envelope&conteudo=acabamento&final=<?= $key ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!--Fim: Lista Acabamento-->

            <!--Inicio: Lista Fita-->
            <div class="table-responsive">
                <div class="form-group jumbotron" style="padding: 0px;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    <?php
                                    if (empty($_SESSION['convite']['envelope']['fita'])) {
                                        ?>
                                        <button type="button" onclick="altera_modal('envelope')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal_fita">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true">

                                            </span>
                                        </button>
                                        <?php
                                    }
                                    ?>
                                    <span class="glyphicon glyphicon-tags"></span> Fita
                                </th>
                                <th>Laço</th>
                                <th>Cor</th>
                                <th>Largura</th>
                                <th>Excluir</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($_SESSION['convite']['envelope']['fita'])) {
                                list(, $tipoLaco,,, $corFita, $largura) = explode(':', $_SESSION['convite']['envelope']['fita']);
                                ?>
                                <tr>
                                    <td></td>
                                    <td class="text-uppercase"><h5 class="modalTexto"><?= $tipoLaco ?></h5></td>
                                    <td class="text-uppercase"><h5 class="modalTexto"><?= $corFita ?></h5></td>
                                    <td class="text-uppercase"><h5 class="modalTexto"><?= $largura ?> mm</h5></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="altera_modal_item('envelope', 0)" data-toggle="modal" data-target="#modal_fita"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <a href="orcamento_convite_salvar.php?acao=excluir&elemento=envelope&conteudo=fita" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--Fim: Lista Fita-->

            <!--Inicio: Lista Servico-->
            <div class="form-group jumbotron" style="padding: 0px;">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>
                                <button type="button" onclick="altera_modal('envelope')" class="btn btn-default btn-sm" data-toggle="modal" 
                                        data-target="#modal_servico"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                                <span class="glyphicon glyphicon-scissors"></span> Acabamento
                            </th>
                            <th class="btn_detalhe">Detalhe</th>
                            <th class="btn_excluir">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($_SESSION['convite']['envelope']['servico'])) {
                            $arr = $_SESSION['convite']['envelope']['servico'];

                            foreach ($arr as $key => $value) {
                                list($i, $n, $v, $d) = explode(':', $value);
                                ?>
                                <tr>
                                    <td class="text-uppercase"><h5 class="modalTexto"><?= $n ?></h5></td>
                                    <td><h5 class="modalTexto"><?= $d ?></h5></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="altera_modal_item('envelope',<?= $key ?>)" data-toggle="modal" data-target="#modal_servico"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <a href="orcamento_convite_salvar.php?acao=excluir&elemento=envelope&conteudo=servico&final=<?= $key ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                    </td>
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
                                <button type="button" onclick="altera_modal('envelope')" class="btn btn-default btn-sm" data-toggle="modal" 
                                        data-target="#modal_fonte"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                                <span class="glyphicon glyphicon-text-background"></span> Fonte
                            </th>
                            <th class="btn_detalhe">Detalhe</th>
                            <th class="btn_excluir">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($_SESSION['convite']['envelope']['fonte'])) {
                            $arr = $_SESSION['convite']['envelope']['fonte'];

                            foreach ($arr as $key => $value) {
                                list($i, $n, $d) = explode(':', $value);
                                ?>
                                <tr>
                                    <td class="text-uppercase"><h5 class="modalTexto"><?= $n ?></td>
                                    <td><h5 class="modalTexto"></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="altera_modal_item('envelope',<?= $key ?>)" data-toggle="modal" data-target="#modal_fonte"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <a href="orcamento_convite_salvar.php?acao=excluir&elemento=envelope&conteudo=fonte&final=<?= $key ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!--Fim: Lista Fonte-->

            <!--Inicio: Lista detalhe-->
            <div class="form-group jumbotron" style="padding: 0px;">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>
                                <?php
                                if (empty($_SESSION['convite']['envelope']['detalhe'])) {
                                    ?>
                                    <button type="button" onclick="altera_modal('envelope')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal_detalhe">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </button>
                                    <?php
                                }
                                ?>
                                <span class="glyphicon glyphicon-comment"></span> Detalhe do envelope
                            </th>
                            <th class="btn_excluir">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($_SESSION['convite']['envelope']['detalhe'])) {
                            ?>

                            <tr>
                                <td><h5 class="modalTexto"><?= $_SESSION['convite']['envelope']['detalhe'] ?></h5></td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="altera_modal_item('envelope', 0)" data-toggle="modal" data-target="#modal_detalhe"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <a href="orcamento_convite_salvar.php?acao=excluir&elemento=envelope&conteudo=detalhe" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!--Fim: Lista detalhe-->
        </div>
    </div>
</div>
<!--Fim Configuração do Envelope-->