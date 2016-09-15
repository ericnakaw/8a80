<div class="container">
    <div class="btn-group">
        <a href="orcamento_novo.php" class="btn btn-default  btn-group">Novo Orçamento</a>
        <button class="btn btn-default btn-group" onclick="imprimir()">Imprimir</button>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="row">
                <table id="tabela_orcamento_realizado">
                    <tr>
                        <th width="20%"></th>
                        <th width="80%"></th>
                    </tr>
                    <tr>
                        <td>
                            <img class="img-responsive center-block" src="img/logo_8a80.png">
                        </td>
                        <td>
                            <h3>Oito Comunicação e Marketing</h3>
                            CNPJ: 11.845.733/0001-43  I.E: 336.935.448.110<br>
                            Matriz: Rua Tijuco Preto, 888 - Tatuapé - São Paulo - SP - CEP: 03316-000 - Fone:(11) 2358-7374<br> 
                            Filial: Rua Andradina, 25A - Centro - Guarulhos - SP - CEP: 07013-070 - Fone:(11) 2382-6924 <br>
                        </td>
                    </tr>
                </table>
            </div>
            <!--Fim: Cabeçalho com Logo e dados da Empresa-->
            <hr>
            <?php
            $connectionFactory = new ConnectionFactory();
            $mysqli = $connectionFactory->get_Mysqli();
            if ($_GET['pedido_id']) {
                $pedidoDao = new PedidoDao ();
                $tabelaPedido = $pedidoDao->select($_GET['pedido_id'], $mysqli);
                $pedido = new Pedido($tabelaPedido["id_pedido"], $tabelaPedido["id_funcionario"], $tabelaPedido["id_cliente"], $tabelaPedido["local_retirada"], $tabelaPedido["data_pedido"], $tabelaPedido["status"], $tabelaPedido["pedido_tipo"], $tabelaPedido["local_venda"]);
            } elseif ($_GET['orcamento_id']) {
                $orcamentoDao = new OrcamentoDao();
                $tabelaOrcamento = $orcamentoDao->select($_GET['orcamento_id'], $mysqli);
                $orcamento = new Orcamento($tabelaOrcamento["id_orcamento"], $tabelaOrcamento["id_funcionario"], $tabelaOrcamento["id_cliente"], $tabelaOrcamento["data_orcamento"], $tabelaOrcamento["status"], $tabelaOrcamento["local_venda"]);
            } else {
                $adendoDao = new AdendoDao();
                $tabelaAdendo = $adendoDao->select($_GET['adendo_id'], $mysqli);
                $adendo = new Adendo($tabelaAdendo["id_adendo"], $tabelaAdendo["id_pedido"], $tabelaAdendo["id_funcionario"], $tabelaAdendo["id_cliente"], $tabelaAdendo["local_retirada"], $tabelaAdendo["data_adendo"], $tabelaAdendo["status"], $tabelaAdendo["local_venda"]);
            }
            ?>
            <!--Inicio: Conslutor / Local da venda/ Data da Solicitação-->
            <table class="table-condensed table-hover">
                <tr>
                    <th width="30%"><b>Consultor(a): </b></th>
                    <th width="30%"><b>Local da Venda: </b></th>
                    <th width="30%"><b>Data da Solicitação: </b></th>
                    <th width="30%">
                        <?php
                        if ($_GET['pedido_id']) {
                            ?>
                            <b>Pedido: </b>
                            <?php
                        } elseif ($_GET['orcamento_id']) {
                            ?>
                            <b>Orçamento: </b>
                            <?php
                        } else {
                            ?>
                            <b>Adendo: </b>
                            <?php
                        }
                        ?>
                    </th>
                </tr>
                <tr>
                    <?php
                    if ($_GET['pedido_id']) {
                        ?>
                        <td class="text-uppercase"><?= $tabelaPedido['func_nome'] ?> <?= $tabelaPedido['func_sobrenome'] ?></td>
                        <td class="text-uppercase"><?= $tabelaPedido['local_venda'] ?></td>
                        <td><?= $pedido->getDataPedido() ?></td>
                        <td>Nº <?= $pedido->getIdPedido() ?></td>
                        <?php
                    } elseif ($_GET['orcamento_id']) {
                        ?>
                        <td class="text-uppercase"><?= $tabelaOrcamento['func_nome'] ?> <?= $tabelaOrcamento['func_sobrenome'] ?></td>
                        <td class="text-uppercase"><?= $tabelaOrcamento['local_venda'] ?></td>
                        <td><?= $orcamento->getDataOrcamento() ?></td>
                        <td>Nº <?= $orcamento->getIdOrcamento() ?></td>
                        <?php
                    } else {
                        ?>
                        <td class="text-uppercase"><?= $tabelaAdendo['func_nome'] ?> <?= $tabelaAdendo['func_sobrenome'] ?></td>
                        <td class="text-uppercase"><?= $tabelaAdendo['local_venda'] ?></td>
                        <td><?= $adendo->getDataAdendo() ?></td>
                        <td>Nº <?= $adendo->getIdAdendo() ?></td>
                        <?php
                    }
                    ?>
                </tr>
            </table>
            <!--Fim: Conslutor / Local da venda/ Data da Solicitação-->
            <hr>
            <!--Inicio: Dados do Cliente-->
            <div class="row">
                <?php
                $clienteDao = new ClienteDao();
                if ($_GET['pedido_id']) {
                    $tabelaCliente = $clienteDao->select($pedido->getIdCliente(), $mysqli);
                } elseif ($_GET['orcamento_id']) {
                    $tabelaCliente = $clienteDao->select($orcamento->getIdCliente(), $mysqli);
                } else {
                    $tabelaCliente = $clienteDao->select($adendo->getIdCliente(), $mysqli);
                }
                $cliente = new Cliente($tabelaCliente["data_evento"], $tabelaCliente["evento_tipo"], $tabelaCliente["rua"], $tabelaCliente["numero"], $tabelaCliente["complemento"], $tabelaCliente["estado"], $tabelaCliente["bairro"], $tabelaCliente["cidade"], $tabelaCliente["cep"], $tabelaCliente["observacao"]);
                $cliente->setIdCliente($tabelaCliente["id_cliente"]);

                $pessoaDao = new pessoaDao();
                $tabelaPessoa = $pessoaDao->select($cliente->getIdCliente(), $mysqli);
                foreach ($tabelaPessoa as $key => $value) {
                    $pessoa[$key] = new Pessoa($value["id_pessoa"], $value["nome"], $value["sobrenome"], $value["email"], $value["telefone"], $value["celular"], $value["rg"], $value["cpf"]);
                }
                ?>
                <table class="table-bordered table-striped table-hover table-condensed" >
                    <caption>
                        <h4>Dados do Cliente</h4>
                    </caption>
                    <tr >
                        <th width="9%" >Evento</th>
                        <th width="9%" >Data_Evento</th>
                        <th width="5%" >ID_Cliente</th>
                        <th width="24%" ><?php
                            if ($cliente->getEvento() == "casamento") {
                                print 'Noiva';
                            } else {
                                print 'Responsável';
                            }
                            ?></th>
                        <th width="24%" >
                            <?php
                            if ($cliente->getEvento() == "casamento") {
                                print 'Noivo';
                            } else {
                                print 'Aniversariante';
                            }
                            ?>    
                        </th>
                        <th width="29%" >Endereço</th>
                    </tr>
                    <tr>
                        <td class="text-uppercase">
                            <?= $cliente->getEvento() ?><br>
                        </td>
                        <td class="text-uppercase">
                            <?= $cliente->getDataEvento() ?><br>
                        </td>
                        <td class="text-uppercase">
                            ID <?= $cliente->getIdCliente() ?><br>
                        </td>
                        <td>
                            <p><b>Nome: </b><?= $pessoa[0]->getNome() ?> <?= $pessoa[0]->getSobrenome() ?></p>
                            <p><b>Email: </b> <?= $pessoa[0]->getEmail() ?></p>
                            <p><b>Cel: </b> <?= $pessoa[0]->getCelular() ?></p>
                            <p><b>Tel: </b> <?= $pessoa[0]->getTelefone() ?></p>
                            <p><b>RG: </b><?= $pessoa[0]->getRg() ?></p>
                            <p><b>CPF: </b><?= $pessoa[0]->getCpf() ?></p>
                        </td>
                        <td>
                            <p><b>Nome: </b><?= $pessoa[1]->getNome() ?> <?= $pessoa[1]->getSobrenome() ?></p>
                            <p><b>Email: </b> <?= $pessoa[1]->getEmail() ?></p>
                            <p><b>Cel: </b> <?= $pessoa[1]->getCelular() ?></p>
                            <p><b>Tel: </b> <?= $pessoa[1]->getTelefone() ?></p>
                            <p><b>RG: </b><?= $pessoa[1]->getRg() ?></p>
                            <p><b>CPF: </b><?= $pessoa[1]->getCpf() ?></p>
                        </td>
                        <td>
                            <p><b>Rua/Av: </b><?= $cliente->getRua() ?>, <?= $cliente->getNumero() ?></p>
                            <p><b>Comp: </b> <?= $cliente->getComplemento() ?></p>
                            <p><b>Bairro: </b> <?= $cliente->getBairro() ?></p>
                            <p><b>CEP: </b> <?= $cliente->getCep() ?></p>
                            <p><b>Cidade: </b> <?= $cliente->getCidade() ?></p>
                            <p><b>Estado: </b> <?= $cliente->getEstado() ?></p>
                            <p><b>Obs: </b> <?= $cliente->getObservacao() ?></p>
                        </td>
                    </tr>
                </table>
                <!--Fim: Dados do Cliente-->

                <hr>
                <!--Inicio: Convite Tabela-->
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <table class="table-bordered table-condensed table-striped table-hover">
                                <caption>
                                    <h4>Convite</h4>
                                </caption>
                                <thead>
                                    <tr>
                                        <th  width="3%">#</th>
                                        <th  width="12%">Modelo</th>
                                        <th  width="5%">Entrega</th>
                                        <th  width="10%">Qtd</th>
                                        <th  width="10%"><span class="glyphicon glyphicon-alert"></span></th>
                                        <th  width="5%">Unitário</th>
                                        <th  width="10%">Sub-Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($_GET["pedido_id"]) {
                                        $itensConviteDao = new ItensConviteDao();
                                        $tabelaItensConvite = $itensConviteDao->select($pedido->getIdPedido(), $mysqli);
                                        foreach ($tabelaItensConvite as $key => $value) {
                                            $itemConvite[$key] = new ItensConvite($value["id_pedido"], $value["quantidade"], $value["data_entrega"], $value["id_convite"], $value["valor"], $value["desconto_porcentagem"]);
                                            $itemConvite[$key]->setIdItem($value["id_item"]);
                                            $itemConvite[$key]->setModelo_nome($value["modelo_nome"]);
                                            $idsConvite[] = $itemConvite[$key]->getIdConvite();
                                            ?>
                                            <tr>
                                                <td><?= $itemConvite[$key]->getIdConvite() ?></td>
                                                <td><?= $itemConvite[$key]->getModelo_nome() ?></td>
                                                <td><?= $itemConvite[$key]->getDataEntrega() ?></td>
                                                <td><?= $itemConvite[$key]->getQuantidade() ?></td>
                                                <td><?= $itemConvite[$key]->getDesconto() ?>%</td>
                                                <td>R$ <?= number_format($itemConvite[$key]->getValorUnitario(), 2, ',', '.') ?></td>
                                                <td>R$ <?= number_format($itemConvite[$key]->getValorUnitario() * $itemConvite[$key]->getQuantidade(), 2, ',', '.') ?></td>
                                            </tr>
                                            <?php
                                            $subTotalConvite += number_format($itemConvite[$key]->getValorUnitario(), 2) * $itemConvite[$key]->getQuantidade();
                                        }
                                    } elseif ($_GET["orcamento_id"]) {
                                        $itensConviteOrcamentoDao = new ItensConviteOrcamentoDao;
                                        $tabelaItensConviteOrcamento = $itensConviteOrcamentoDao->select($orcamento->getIdOrcamento(), $mysqli);
                                        foreach ($tabelaItensConviteOrcamento as $key => $value) {
                                            $itemConviteOrcamento[$key] = new ItensConviteOrcamento(NULL, $value["id_orcamento"], $value["quantidade"], $value["id_convite"], $value["valor"], $value["desconto_porcentagem"]);
                                            $itemConviteOrcamento[$key]->setIdItem($value["id_item"]);
                                            $itemConviteOrcamento[$key]->setModelo_nome($value["modelo_nome"]);
                                            $idsConvite[] = $itemConviteOrcamento[$key]->getIdConvite();
                                            ?>
                                            <tr>
                                                <td><?= $itemConviteOrcamento[$key]->getIdConvite() ?></td>
                                                <td><?= $itemConviteOrcamento[$key]->getModelo_nome() ?></td>
                                                <td>__/__/____</td>
                                                <td><?= $itemConviteOrcamento[$key]->getQuantidade() ?></td>
                                                <td><?= $itemConviteOrcamento[$key]->getDesconto() ?>%</td>
                                                <td>R$ <?= number_format($itemConviteOrcamento[$key]->getValorUnitario(), 2, ',', '.') ?></td>
                                                <td>R$ <?= number_format($itemConviteOrcamento[$key]->getValorUnitario() * $itemConviteOrcamento[$key]->getQuantidade(), 2, ',', '.') ?></td>
                                            </tr>
                                            <?php
                                            $subTotalConvite += number_format($itemConviteOrcamento[$key]->getValorUnitario(), 2) * $itemConviteOrcamento[$key]->getQuantidade();
                                        }
                                    } else {
                                        $itensConviteAdendoDao = new ItensConviteAdendoDao;
                                        $tabelaItensConviteAdendo = $itensConviteAdendoDao->select($adendo->getIdAdendo(), $mysqli);
                                        foreach ($tabelaItensConviteAdendo as $key => $value) {
                                            $itemConviteAdendo[$key] = new ItensConviteAdendo(NULL, $value["id_adendo"], $value["id_pedido"], $value["quantidade"], $value["id_convite"], $value["valor"], $value["desconto_porcentagem"]);
                                            $itemConviteAdendo[$key]->setIdItem($value["id_item"]);
                                            $itemConviteAdendo[$key]->setModelo_nome($value["modelo_nome"]);
                                            $idsConvite[] = $itemConviteAdendo[$key]->getIdConvite();
                                            ?>
                                            <tr>
                                                <td><?= $itemConviteAdendo[$key]->getIdConvite() ?></td>
                                                <td><?= $itemConviteAdendo[$key]->getModelo_nome() ?></td>
                                                <td>__/__/____</td>
                                                <td><?= $itemConviteAdendo[$key]->getQuantidade() ?></td>
                                                <td><?= $itemConviteAdendo[$key]->getDesconto() ?>%</td>
                                                <td>R$ <?= number_format($itemConviteAdendo[$key]->getValorUnitario(), 2, ',', '.') ?></td>
                                                <td>R$ <?= number_format($itemConviteAdendo[$key]->getValorUnitario() * $itemConviteAdendo[$key]->getQuantidade(), 2, ',', '.') ?></td>
                                            </tr>
                                            <?php
                                            $subTotalConvite += number_format($itemConviteAdendo[$key]->getValorUnitario(), 2) * $itemConviteAdendo[$key]->getQuantidade();
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
                                        <td><b>Total:</b> </td>
                                        <td>R$ <?= number_format($subTotalConvite, 2, ',', '.') ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <!--Fim: Convite Tabela-->
                <!--Configuração do convite-->
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <hr>
                            <table class="table table-bordered table-condensed table-striped">
                                <caption>
                                    <h4>Configuração do Convite</h4>
                                </caption>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="15%">Modelo</th>
                                    <th width="40%">Cartão</th>
                                    <th width="40%">Envelope</th>
                                </tr>
                                <tr>
                                    <?php
                                    $conviteDao = new ConviteDao();
                                    $convite = new Convite();
                                    foreach ($idsConvite as $key => $value) {
                                        $convite = $conviteDao->selectConvite($value, $mysqli);
                                        ?>
                                        <td style="vertical-align: middle"><b><?= $convite->getIdConvite() ?></b></td>
                                        <td style="vertical-align: middle">
                                            <b>
                                                <?php
                                                list(, $modeloNome) = explode(":", $convite->getIdModelo());
                                                print $modeloNome
                                                ?>
                                            </b>
                                        </td>
                                        <td>
                                            <ul class="list-group">
                                                <?php
                                                if ($convite->getIdPapelCartao() !== NULL) {
                                                    ?>
                                                    <!--Papel-->
                                                    <li class="list-group-item">
                                                        <h6 class="list-group-item-heading"><b>Papel:</b> <?= count($convite->getIdPapelCartao()) ?></h6>
                                                        <?php
                                                        foreach ($convite->getIdPapelCartao() as $key => $value) {
                                                            list(, $cartaoPapelNome,, $cartaoCategoriaPapel, $cartaoEmpastamento) = explode(":", $value);
                                                            if ($cartaoEmpastamento == 1) {
                                                                ?>
                                                                <span class="glyphicon glyphicon-ok"></span> <?= $cartaoCategoriaPapel ?> : <?= $cartaoPapelNome ?> => <u>Empastado</u><br>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <span class="glyphicon glyphicon-ok"></span> <?= $cartaoCategoriaPapel ?> : <?= $cartaoPapelNome ?> <br>

                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    </li>
                                                    <?php
                                                }
                                                if ($convite->getImpressaoCartao() !== NULL) {
                                                    ?>
                                                    <!--Impressão-->
                                                    <li class="list-group-item">
                                                        <h6 class="list-group-item-heading"><b>Impressão:</b> <?= count($convite->getImpressaoCartao()) ?></h6>
                                                        <?php
                                                        foreach ($convite->getImpressaoCartao() as $key => $value) {
                                                            list(, $cartaoImpressao,, $cartaoImpressaoDetalhe) = explode(":", $value);
                                                            ?>
                                                            <span class="glyphicon glyphicon-ok"></span> <?= $cartaoImpressao ?>
                                                            <br>Detalhe: <?= $cartaoImpressaoDetalhe ?><br>
                                                            <?php
                                                        }
                                                        ?>
                                                    </li>
                                                    <?php
                                                }
                                                if ($convite->getServicoCartao() !== NULL) {
                                                    ?>
                                                    <!--Acabamento-->
                                                    <li class="list-group-item">
                                                        <h6 class="list-group-item-heading"><b>Acabamento:</b> <?= count($convite->getServicoCartao()) ?></h6>
                                                        <?php
                                                        foreach ($convite->getServicoCartao() as $key => $value) {
                                                            list(, $cartaoAcabamento,, $cartaoAcabamentoDetalhe) = explode(":", $value);
                                                            ?>
                                                            <span class="glyphicon glyphicon-ok"></span> <?= $cartaoAcabamento ?>
                                                            <br>Detalhe: <?= $cartaoAcabamentoDetalhe ?><br>
                                                            <?php
                                                        }
                                                        ?>
                                                    </li>
                                                    <?php
                                                }
                                                if ($convite->getAcabamentoCartao() !== NULL) {
                                                    ?>
                                                    <!--Acessório-->
                                                    <li class="list-group-item">
                                                        <h6 class="list-group-item-heading"><b>Acessório:</b> <?= count($convite->getAcabamentoCartao()) ?></h6>
                                                        <?php
                                                        foreach ($convite->getAcabamentoCartao() as $key => $value) {
                                                            list(, $cartaoAcessorio,, $cartaoAcessorioDetalhe) = explode(":", $value);
                                                            ?>
                                                            <span class="glyphicon glyphicon-ok"></span> <?= $cartaoAcessorio ?>
                                                            <br>Detalhe: <?= cartaoAcessorioDetalhe ?><br>
                                                            <?php
                                                        }
                                                        ?>
                                                    </li>
                                                    <?php
                                                }
                                                if ($convite->getFonteCartao() !== NULL) {
                                                    ?>
                                                    <!--Fonte-->
                                                    <li class="list-group-item">
                                                        <h6 class="list-group-item-heading"><b>Fonte:</b> <?= count($convite->getFonteCartao()) ?></h6>
                                                        <?php
                                                        foreach ($convite->getFonteCartao() as $key => $value) {
                                                            list(, $cartaoFonte, $cartaoFonteDetalhe) = explode(":", $value);
                                                            ?>
                                                            <span class="glyphicon glyphicon-ok"></span> <?= $cartaoFonte ?>
                                                            <br>Detalhe: <?= $cartaoFonteDetalhe ?><br>
                                                            <?php
                                                        }
                                                        ?>
                                                    </li>
                                                    <?php
                                                }
                                                if ($convite->getDetalheCartao() !== NULL && $convite->getDetalheCartao() !== "") {
                                                    ?>
                                                    <!--Detalhes-->
                                                    <li class="list-group-item">
                                                        <h6 class="list-group-item-heading"><b>Detalhe:</b> <?= count($convite->getDetalheCartao()) ?></h6>
                                                        <span class="glyphicon glyphicon-ok"></span> <?= $convite->getDetalheCartao() ?>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                            <br>
                                        </td>
                                        <td>
                                            <ul class="list-group">
                                                <?php
                                                if ($convite->getIdPapelEnvelope() !== NULL) {
                                                    ?>
                                                    <!--Papel-->
                                                    <li class="list-group-item">
                                                        <h6 class="list-group-item-heading"><b>Papel:</b> <?= count($convite->getIdPapelEnvelope()) ?></h6>
                                                        <?php
                                                        list(, $envelopePapelNome,, $envelopeCategoriaPapel, $envelopeEmpastamento) = explode(":", $convite->getIdPapelEnvelope());
                                                        if ($envelopeEmpastamento == 1) {
                                                            ?>
                                                            <span class="glyphicon glyphicon-ok"></span> <?= $envelopeCategoriaPapel ?> : <?= $envelopePapelNome ?> => <u>Empastado</u><br>
                                                    <?php } else {
                                                        ?>
                                                        <span class="glyphicon glyphicon-ok"></span> <?= $envelopeCategoriaPapel ?> : <?= $envelopePapelNome ?><br>
                                                        <?php
                                                    }
                                                    ?>
                                                    </li>
                                                    <?php
                                                }
                                                if ($convite->getImpressaoEnvelope() !== NULL) {
                                                    ?>
                                                    <!--Impressão-->
                                                    <li class="list-group-item">
                                                        <h6 class="list-group-item-heading"><b>Impressão:</b> <?= count($convite->getImpressaoEnvelope()) ?></h6>
                                                        <?php
                                                        foreach ($convite->getImpressaoEnvelope() as $key => $value) {
                                                            list(, $envelopeImpressao,, $envelopeImpressaoDetalhe) = explode(":", $value);
                                                            ?>
                                                            <span class="glyphicon glyphicon-ok"></span> <?= $envelopeImpressao ?>
                                                            <br>Detalhe: <?= $envelopeImpressaoDetalhe ?><br>
                                                            <?php
                                                        }
                                                        ?>
                                                    </li>
                                                    <?php
                                                }
                                                if ($convite->getServicoEnvelope() !== NULL) {
                                                    ?>
                                                    <!--Acabamento-->
                                                    <li class="list-group-item">
                                                        <h6 class="list-group-item-heading"><b>Acabamento:</b> <?= count($convite->getServicoEnvelope()) ?></h6>
                                                        <?php
                                                        foreach ($convite->getServicoEnvelope() as $key => $value) {
                                                            list(, $envelopeAcabamento,, $envelopeAcabamentoDetalhe) = explode(":", $value);
                                                            ?>
                                                            <span class="glyphicon glyphicon-ok"></span> <?= $envelopeAcabamento ?>
                                                            <br>Detalhe: <?= $envelopeAcabamentoDetalhe ?><br>
                                                            <?php
                                                        }
                                                        ?>
                                                    </li>
                                                    <?php
                                                }
                                                if ($convite->getAcabamentoEnvelope() !== NULL) {
                                                    ?>
                                                    <!--Acessório-->
                                                    <li class="list-group-item">
                                                        <h6 class="list-group-item-heading"><b>Acessório:</b> <?= count($convite->getAcabamentoEnvelope()) ?></h6>
                                                        <?php
                                                        foreach ($convite->getAcabamentoEnvelope() as $key => $value) {
                                                            list(, $envelopeAcessorio,, $envelopeAcessorioDetalhe) = explode(":", $value);
                                                            ?>
                                                            <span class="glyphicon glyphicon-ok"></span> <?= $envelopeAcessorio ?>
                                                            <br>Detalhe: <?= $envelopeAcessorioDetalhe ?><br>
                                                            <?php
                                                        }
                                                        ?>
                                                    </li>
                                                    <?php
                                                }
                                                if ($convite->getFita() !== NULL) {
                                                    ?>
                                                    <!--Acessório-->
                                                    <li class="list-group-item">
                                                        <h6 class="list-group-item-heading"><b>Fita:</b> <?= count($convite->getFita()) ?></h6>
                                                        <?php
                                                        list(, $envelopeFitaTipo,,, $envelopeFitaCor, $envelopeFitaLargura) = explode(":", $convite->getFita());
                                                        ?>
                                                        <span class="glyphicon glyphicon-ok"></span> <?= $envelopeFitaTipo ?>
                                                        <br><b>Cor:</b> <?= $envelopeFitaCor ?>
                                                        <br><b>Largura: </b> <?= $envelopeFitaLargura ?> mm<br>
                                                    </li>
                                                    <?php
                                                }
                                                if ($convite->getFonteEnvelope() !== NULL) {
                                                    ?>
                                                    <!--Fonte-->
                                                    <li class="list-group-item">
                                                        <h6 class="list-group-item-heading"><b>Fonte:</b> <?= count($convite->getFonteEnvelope()) ?></h6>
                                                        <?php
                                                        foreach ($convite->getFonteEnvelope() as $key => $value) {
                                                            list(, $envelopeFonte, $envelopeFonteDetalhe) = explode(":", $value);
                                                            ?>
                                                            <span class="glyphicon glyphicon-ok"></span> <?= $envelopeFonte ?>
                                                            <br>Detalhe: <?= $envelopeFonteDetalhe ?><br>
                                                            <?php
                                                        }
                                                        ?>
                                                    </li>
                                                    <?php
                                                }
                                                if ($convite->getDetalheEnvelope() !== NULL && $convite->getDetalheEnvelope() !== "") {
                                                    ?>
                                                    <!--Detalhes-->
                                                    <li class="list-group-item">
                                                        <h6 class="list-group-item-heading"><b>Detalhe:</b> <?= count($convite->getDetalheEnvelope()) ?></h6>
                                                        <span class="glyphicon glyphicon-ok"></span> <?= $convite->getDetalheEnvelope() ?>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                            <br>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <?php die() ?>
                <hr>


                <!--Inicio: Produtos Tabela-->
                <span class="text-center"><h3>Produtos</h3></span>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <table class="table-bordered table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th width="3%">#</th>
                                        <th width="12%">Produto</th>
                                        <th width="5%">Entrega</th>
                                        <th width="35%">Descrição</th>
                                        <th width="10%">Qtd</th>
                                        <th width="5%">Unitário</th>
                                        <th width="10%">Sub-Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>324</td>
                                        <td>Individuais</td>
                                        <td>20/04/2016</td>
                                        <td>Mesmo Papel do convite</td>
                                        <td>200</td>
                                        <td>R$ 0,50</td>
                                        <td>R$ 100,00</td>
                                    </tr>
                                    <tr>
                                        <td>201</td>
                                        <td>Lista de Presente</td>
                                        <td>20/04/2016</td>
                                        <td>Mesmo Papel do convite</td>
                                        <td>100</td>
                                        <td>R$ 0,50</td>
                                        <td>R$ 100,00</td>
                                    </tr>
                                    <tr>
                                        <td>319</td>
                                        <td>Saco Plástico</td>
                                        <td>20/04/2016</td>
                                        <td>25x30</td>
                                        <td>100</td>
                                        <td>R$ 0,10</td>
                                        <td>R$ 10,00</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total: </b></td>
                                        <td>R$ 1500,00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!--Fim: Produtos Tabela-->
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
</div>