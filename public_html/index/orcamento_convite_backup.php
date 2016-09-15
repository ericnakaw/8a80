<?php
error_reporting(E_ALL ^ E_NOTICE ^E_WARNING);
if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION["UsuarioID"])) {
    $permissao = Array("gerente", "vendas", "tecnico");
    if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
        header("location: login.php?msg=Sem_permisao");
        die();
    }
} else {
    header("location: login.php?msg=Nao esta logado");
    die();
}

include './conexao/Conexao.php';
include './header.php';
if (isset($_SESSION['convite']['modelo'])) {
    list($modelo_id, $modelo_nome, $modelo_completo) = explode(':', $_SESSION['convite']['modelo']);
}
?>  
<style>
    legend{
        text-align: center;
    }
    .btn_excluir{
        width: 20%;
    }
    .btn_detalhe{
        width: 40%;
    }
    .modalTexto{
        color: #337ab7;
    }
    .teste{
        display: none;
    }
</style>
<script type="text/javascript" src="js/orcamento_convite.js"></script>  
<body>
    <?php
    //include './configuracao_convite_modal.php';
    include './configuracao_convite_modal_teste.php';
    ?>
    <?php
    include './header2.php';
    ?>

    <!-- Aqui comeca o conteudo -->
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <div id="conteudo" class="col-md-12">
                    <div class="row">
                        <!-- Inicio Configuração do Convite -->
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b>Base de Modelos</b>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="input-group"> 
                                            <span class="input-group-addon">Catalogo</span>
                                            <select id="catalogo" class="form-control">
                                                <option value="">Selecione do Catalogo</option>
                                                <?php
                                                $conexao = new Conexao();
                                                $resultado = $conexao->sql_query("SELECT * FROM catalogo ORDER BY pagina ASC");
                                                while ($tabela = mysql_fetch_array($resultado)) {
                                                    ?>
                                                    <option value="<?= $tabela["id_catalogo"] ?>"
                                                    <?php
                                                    if ($_SESSION['convite']['catalogo_id'] == $tabela["id_catalogo"]) {
                                                        print 'selected';
                                                    }
                                                    ?>>Pág: <?= $tabela["pagina"] ?>: <?= $tabela["item"] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                            </select>
                                            <!--<input type="text" class="form-control" value="" id="catalogo_input" name="catalogo_input">-->
                                        </div>
                                    </div><!--Catalogo-->
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Orçamento</span>
                                            <select id="convite_orcamento" class="form-control">
                                                <option value="">Selecione o Orçamento</option>
                                                <?php
                                                $conexao = new Conexao();
                                                $resultado = $conexao->sql_query("SELECT * FROM convite ORDER BY id desc");

                                                while ($tabela = mysql_fetch_array($resultado)) {
                                                    ?>
                                                    <option value="<?= $tabela["id"] ?>"
                                                    <?php
                                                    if ($_SESSION['convite']['orcamento']['id'] == $tabela["id"]) {
                                                        print 'selected';
                                                    }
                                                    ?>
                                                            >Orçamento # <?= $tabela["id"] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                            </select>
                                        </div> 
                                    </div><!--Orçamento-->
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Modelo</span>
                                            <select id="modelo" class="form-control">
                                                <option>Selecione um modelo</option>
                                                <?php
                                                $conexao = new Conexao();
                                                $resultado = $conexao->sql_query("SELECT * FROM convite_modelo ORDER BY cod ASC");

                                                while ($tabela = mysql_fetch_array($resultado)) { 
                                                    ?>
                                                    <option value="<?= $tabela["id"] ?>§<?= $tabela["nome"] ?>§<?= $tabela["folha_unica"] ?>§<?= $tabela["formato_envelope"] ?>§<?= $tabela["formato_cartao"] ?>§<?= $tabela["colagem_pva"] ?>§<?= $tabela["dupla_face"] ?>§<?= $tabela["dobra"] ?>§<?= $tabela["markup"] ?>§<?= $tabela["empastamento_borda"] ?>§<?= $tabela["empastamento_borda_envelope"]?>§<?= $tabela["formato_cartao_altura"] ?>§<?= $tabela["formato_cartao_largura"] ?>§<?= $tabela["formato_envelope_altura"] ?>§<?= $tabela["formato_envelope_largura"] ?>"
                                                    <?php
                                                    if ($modelo_id == $tabela["id"]) {
                                                        print 'selected';
                                                    }
                                                    ?>
                                                            ><?= $tabela["cod"] ?> : <?= $tabela["nome"] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                            </select>
                                        </div>
                                    </div><!--Modelo-->

                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4"><b>Simulador de preço</b></div> 
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Promoção</span>
                                                    <input type="text" class="form-control" name="desconto" id="desconto" min="0" max="100"
                                                    <?php
                                                    if ($_SESSION['convite']['descontoPorcentagem'] > 0 && $_SESSION['convite']['descontoPorcentagem'] <= 100) {
                                                        print 'value=' . $_SESSION['convite']['descontoPorcentagem'];
                                                    } else {
                                                        print 'value=0';
                                                    }
                                                    ?>
                                                           >
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <?php
                                                if ($_SESSION['convite']['status']['tipo'] == 'update') {
                                                    $btn_submit = 'Salvar';
                                                } else {
                                                    $btn_submit = 'Adicionar';
                                                }
                                                ?>
                                                <a class="btn btn-success" id="add_convite_carrinho" data-toggle="tooltip" data-placement="left" title="Adiciona o convite ao carrinho"><?= $btn_submit ?> <span class="glyphicon glyphicon-shopping-cart"></span></a>
                                                <a class="btn btn-warning" href="orcamento_convite_salvar.php?acao=limpar" data-toggle="tooltip" data-placement="left" title="Limpa a área de configuração do convite">Limpar <span class="glyphicon glyphicon-erase"></a>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body"> 
                                    <div class="col-md-12"> 
                                        <div class="form-group">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th width="50%">Quantidade</th>
                                                            <th >Unitário</th>
                                                            <th >Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-btn">
                                                                            <button id="calcula_convite" type="button" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Calcula o valor do convite"><span class="glyphicon glyphicon-refresh"></span></button>
                                                                        </span>
                                                                        <input type="number" class="form-control" name="quantidade" id="quantidade" placeholder="Qtd de convites" 
                                                                        <?php
                                                                        if (!empty($_SESSION['convite']['quantidade'])) {
                                                                            print 'value=' . $_SESSION['convite']['quantidade'];
                                                                        }
                                                                        ?>
                                                                               >
                                                                        <!--Fecha o input acima-->
                                                                    </div>
                                                                </div><!--Quantidade-->
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($_SESSION['convite']['preco_calculado']) {
                                                                    ?>
                                                                    <h5 class="modalTexto"> 
                                                                        <?php
                                                                        if ($_SESSION['convite']['descontoPorcentagem'] > 0) {
                                                                            ?>
                                                                            <span class="text-danger">
                                                                                <del>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                                R$ <?= number_format($_SESSION['convite']['preco_calculado'], 2, ',', '.') ?>
                                                                                <?php
                                                                                if ($_SESSION['convite']['descontoPorcentagem'] > 0) {
                                                                                    ?>
                                                                                </del>
                                                                            </span><br><b>por <br>R$ <?= number_format($_SESSION['convite']['desconto'], 2, ',', '.') ?></b>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </h5>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <h5 class="modalTexto">R$ ------</h5>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($_SESSION['convite']['preco_calculado']) {
                                                                    $total = number_format($_SESSION['convite']['preco_calculado'], 2) * $_SESSION['convite']['quantidade'];
                                                                    $total = number_format($total, 2, ',', '.');
                                                                    ?>
                                                                    <h5 class="modalTexto">
                                                                        <?php
                                                                        if ($_SESSION['convite']['descontoPorcentagem'] > 0) {
                                                                            ?>
                                                                            <span class="text-danger">
                                                                                <del>
                                                                                    <?php
                                                                                }
                                                                                ?> 
                                                                                R$ <?= $total ?>
                                                                                <?php
                                                                                if ($_SESSION['convite']['descontoPorcentagem'] > 0) {
                                                                                    $total_desconto = number_format($_SESSION['convite']['desconto'], 2) * $_SESSION['convite']['quantidade'];
                                                                                    $total_desconto = number_format($total_desconto, 2, ',', '.');
                                                                                    ?>

                                                                                </del>
                                                                            </span><br><b> por <br>R$ <?= $total_desconto ?></b>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </h5>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <h5 class="modalTexto">R$ ------</h5>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Fim Configuração do Convite-->
                <?php
                include './configuracao_envelope.php';
                //include './configuracao_cartao.php';
                include './configuracao_cartao_teste.php';
                ?>
            </div>
        </div>
    </div>
</body>