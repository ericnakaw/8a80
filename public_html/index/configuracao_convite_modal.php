<!--Inicio Modais da configuração do Convite-->
<span>
    <!--Modal Impressao-->
    <div class="modal fade" id="modal_impressao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Adicionar Impressão</h4>
                </div>
                <form action="orcamento_convite_salvar.php" method="GET">
                    <div class="modal-body">
                        <input type="hidden" name="acao" class="acao" value="">
                        <input type="hidden" name="elemento" class="elemento" value="">
                        <input type="hidden" name="posicao" class="posicao" value="">
                        <div class="form-group">
                            <label for="impressao" class="">Impressão:</label>
                            <select class="form-control" name="impressao" id="impressao">
                                <option value="">Tipo de impressão</option>
                                <?php
                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query("SELECT * FROM impressao ORDER BY nome ASC");

                                while ($tabela = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
                                    ?>
                                    <option value="<?= $tabela["id"] ?>§<?= $tabela["nome"] ?>§<?= $tabela["valor"] ?>"><?= $tabela["nome"] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="detalhe_impressao" class="">Detalhes da Impressão:</label>
                            <textarea class="form-control" name="detalhe_impressao" id="detalhe_impressao" placeholder="Cor, fonte, detalhes..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Inicio: Modal Fonte-->
    <div class="modal fade" id="modal_fonte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_titulo">Adicionar Fonte</h4>
                </div>
                <form action="orcamento_convite_salvar.php" method="GET">
                    <div class="modal-body">
                        <input type="hidden" name="acao" class="acao" value="">
                        <input type="hidden" name="elemento" class="elemento" value="">
                        <input type="hidden" name="posicao" class="posicao" value="">
                        <div class="form-group">
                            <label for="impressao" class="">Fonte:</label>
                            <select class="form-control text-uppercase" name="fonte" id="fonte">
                                <option class="text-uppercase" value="">Tipo de fonte</option>
                                <?php
                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query("SELECT * FROM fonte ORDER BY nome ASC");

                                while ($tabela = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
                                    ?>
                                    <option value="<?= $tabela["id"] ?>§<?= $tabela["nome"] ?>"><?= $tabela["nome"] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="detalhe_fonte" class="">Detalhes da Fonte:</label>
                            <textarea class="form-control" name="detalhe_fonte" id="detalhe_impressao" placeholder="Cor, fonte, detalhes..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Fim: Modal Fonte-->

    <!--Inicio: Modal Acabamento-->
    <div class="modal fade" id="modal_acabamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_titulo">Adicionar Acessório</h4>
                </div>
                <form action="orcamento_convite_salvar.php" method="GET">
                    <div class="modal-body">
                        <input type="hidden" name="acao" class="acao" value="">
                        <input type="hidden" name="elemento" class="elemento" value="">
                        <input type="hidden" name="posicao" class="posicao" value="">
                        <div class="form-group">
                            <label for="acabamento" class="">Acessório:</label>
                            <select class="form-control text-uppercase" name="acabamento" id="acabamento">
                                <option value="">Tipo de Acessório</option>
                                <?php
                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query("SELECT * FROM acabamento ORDER BY nome ASC");

                                while ($tabela = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
                                    ?>
                                    <option class="text-uppercase" value="<?= $tabela['id'] ?>§<?= $tabela['nome'] ?>§<?= $tabela['valor'] ?>"><?= $tabela["nome"] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="detalhe_fonte" class="">Detalhes do Acessório:</label>
                            <textarea class="form-control" name="detalhe_acabamento" id="detalhe_acabamento" placeholder="Cor, fonte, detalhes..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Fim: Modal Acabamento-->
    <!--Inicio: Modal Papel-->
    <div class="modal fade" id="modal_papel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_titulo">Adicionar Papel</h4>
                </div>
                <form action="orcamento_convite_salvar.php" method="GET">
                    <div class="modal-body">
                        <input type="hidden" name="acao" class="acao" value="">
                        <input type="hidden" name="elemento" class="elemento" value="">
                        <input type="hidden" name="posicao" class="posicao" value="">
                        <div class="form-group">
                            <label for="papel" class="">Categoria Papel:</label>
                            <select class="form-control text-uppercase" name="categoriaPapel" id="categoriaPapel">
                                <option class="text-uppercase" value="">Escolha a categoria</option>
                                <?php
                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query("SELECT * FROM categoria_papel ORDER BY nome ASC");

                                while ($tabela = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
                                    ?>
                                    <option class="text-uppercase"value="<?= $tabela["id"] ?>">
                                        <?= $tabela["nome"] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>

                            <select class="form-control text-uppercase"  id="papelBase" style="display: none">
                                <option class="text-uppercase" value="">Tipo de papel</option>
                                <?php
                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query("SELECT p.id, p.nome, cp.valor, cp.nome as categoria,cp.id as categoria_id FROM papel p left join categoria_papel cp on p.categoria_papel_id = cp.id ORDER BY p.nome ASC");

                                while ($tabela = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
                                    ?>
                                    <option class="text-uppercase" value="<?= $tabela["id"] ?>§<?= $tabela["nome"] ?>§<?= $tabela["valor"] ?>§<?= $tabela["categoria_id"] ?>§<?= $tabela["categoria"] ?>">
                                        <?= $tabela["categoria"] ?> - <?= $tabela["nome"] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>

                            <label for="papel" class="">Papel:</label>
                            <select class="form-control text-uppercase" name="papel" id="papel">
                            </select>
                            <div class="checkbox">
                                <label class="checkbox-inline"><input type="checkbox" name="empastamento" id="empastamento" value="1">Empastamento</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Fim: Modal Papel-->
    <!--Inicio: Modal Fita-->
    <div class="modal fade" id="modal_fita" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_titulo">Adicionar Fita</h4>
                </div>
                <form action="orcamento_convite_salvar.php" method="GET">
                    <div class="modal-body">
                        <input type="hidden" name="acao" class="acao" value="">
                        <input type="hidden" name="elemento" class="elemento" value="">
                        <input type="hidden" name="posicao" class="posicao" value="">
                        <div class="form-group">
                            <?php
                            if (!empty($_SESSION['convite']['envelope']['fita'])) {
                                list($idTipoLaco, $tipoLaco, $valorTipoLaco, $idCorFita, $corFita, $largura) = explode(':', $_SESSION['convite']['envelope']['fita']);
                            }
                            ?>
                            <label for="fita" class="">Fita:</label>
                            <select class="form-control text-uppercase" name="fita" id="fita">
                                <option class="text-uppercase" value="">Escolha o tipo de laço</option>
                                <?php
                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query("SELECT * FROM fita_categoria ORDER BY nome");

                                while ($tabela = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
                                    ?>
                                    <option class="text-uppercase" value="<?= $tabela["id"] ?>§<?= $tabela["nome"] ?>§<?= $tabela['valor'] ?>"
                                    <?php
                                    if ($tabela["id"] == $idTipoLaco) {
                                        print 'selected';
                                    }
                                    ?>><?= $tabela["nome"] ?></option>
                                            <?php
                                        }
                                        ?>
                            </select>
                            <label for="cor" class="">* Cor:</label>
                            <select class="form-control text-uppercase" name="cor" id="cor">
                                <option class="text-uppercase" value="indefinido">Escolha a cor</option>
                                <option class="text-uppercase" value="indefinido"
                                <?php
                                if ($idCorFita == 'indefinido') {
                                    print 'selected';
                                }
                                ?>
                                        >À definir</option>
                                <option class="text-uppercase" value="palha"
                                <?php
                                if ($idCorFita == 'palha') {
                                    print 'selected';
                                }
                                ?>
                                        >Palha</option>
                                        <?php
                                        $conexao = new Conexao();
                                        $resultado = $conexao->sql_query("SELECT * FROM `fita` ORDER BY `codigo` ASC");
                                        while ($tabela = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
                                            ?>
                                    <option class="text-uppercase" value="<?= $tabela["id"] ?>§<?= $tabela["cor"] ?>"
                                    <?php
                                    if ($tabela["id"] == $idCorFita) {
                                        print 'selected';
                                    }
                                    ?>><?= $tabela["codigo"] ?> : <?= $tabela["cor"] ?></option>
                                            <?php
                                        }
                                        ?>
                            </select>
                            <label for="largura" class="">* Largura:</label>
                            <select class="form-control text-uppercase" name="largura" id="largura">
                                <option value="indefinido">Escolha a largura</option>
                                <option value="indefinido" <?php
                                if ($largura == 'indefinido') {
                                    print 'selected';
                                }
                                ?>>À definir</option>
                                <option value="palha" <?php
                                if ($largura == 'palha') {
                                    print 'selected';
                                }
                                ?>>Palha</option>
                                <option value="6"  <?php
                                if ($largura == '6') {
                                    print 'selected';
                                }
                                ?>>6 mm</option>
                                <option value="10" <?php
                                if ($largura == '10') {
                                    print 'selected';
                                }
                                ?>>10 mm</option>
                                <option value="15" <?php
                                if ($largura == '15') {
                                    print 'selected';
                                }
                                ?>>15 mm</option>
                                <option value="22" <?php
                                if ($largura == '22') {
                                    print 'selected';
                                }
                                ?>>22 mm</option>
                                <option value="38" <?php
                                if ($largura == '38') {
                                    print 'selected';
                                }
                                ?>>38 mm</option>

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Fim: Modal Fita-->

    <!--Inicio: Modal Detalhe-->
    <div class="modal fade" id="modal_detalhe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_titulo">Adicionar Detalhe</h4>
                </div>
                <form action="orcamento_convite_salvar.php" method="GET">
                    <div class="modal-body">
                        <input type="hidden" name="acao" class="acao" value="">
                        <input type="hidden" name="elemento" class="elemento" value="">
                        <input type="hidden" name="posicao" class="posicao" value="">
                        <div class="form-group">
                            <label for="detalhe">Detalhe do envelope:</label>
                            <textarea class="form-control" name="detalhe" id="detalhe" placeholder="Detalhes do envelope"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Fim: Modal Detalhe-->
    <!--Inicio: Modal Servico-->
    <div class="modal fade" id="modal_servico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_titulo">Adicionar Acabamento</h4>
                </div>
                <form action="orcamento_convite_salvar.php" method="GET">
                    <div class="modal-body">
                        <input type="hidden" name="acao" class="acao" value="">
                        <input type="hidden" name="elemento" class="elemento" value="">
                        <input type="hidden" name="posicao" class="posicao" value="">
                        <div class="form-group">
                            <label for="servico">Acabamento:</label>
                            <select class="form-control text-uppercase" name="servico" id="servico">
                                <option value="">Escolha um Acabamento</option>
                                <?php
                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query("SELECT * FROM servico ORDER BY nome ASC");
                                while ($tabela = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
                                    ?>
                                    <option class="text-uppercase <?php
                                    if ($tabela["id"] == 27) {
                                        print 'text-danger';
                                    }
                                    ?>" value="<?= $tabela["id"] ?>§<?= $tabela["nome"] ?>§<?= $tabela["valor"] ?>"><?= $tabela["nome"] ?></option>
                                            <?php
                                        }
                                        ?>
                            </select>
                            <div class="form-group">
                                <label for="detalhe_servico" class="">Detalhes do Acabamento:</label>
                                <textarea class="form-control" name="detalhe_servico" id="detalhe_servico" placeholder="detalhes..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Fim: Modal Servico-->
</span> 
<!--Fim Modais da configuração do Convite -->