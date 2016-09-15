<div class="wrapper" role="main">
    <div class="container">
        <div class="row">
            <div id="header2" class="col-md-12">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                            <!-- Agrupa uma lista com 3 listras formando um botão -->
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-2">
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="">
                                <a href="orcamento_cliente.php">Cliente 

                                    <?php
                                    if ($_SESSION['cliente']["evento"] === "casamento") {
                                        if ($_SESSION['cliente']["nome"] !== "" && $_SESSION['cliente']["nome"] !== NULL) {
                                            ?>
                                            <span class="badge">
                                                <?= $_SESSION['cliente']["nome"] ?> 
                                                <span class="glyphicon glyphicon-heart-empty"></span>
                                                <?= $_SESSION['cliente']["nome2"] ?>
                                                <?php
                                                list($ano, $mes, $dia) = explode("-", $_SESSION['cliente']["data_evento"]);
                                                print $dia . "/" . $mes . "/" . $ano;
                                                ?>

                                            </span>
                                            <?php
                                        }
                                    }
                                    elseif ($_SESSION['cliente']["evento"] === "debutante" || $_SESSION['cliente']["evento"] === "aniversario") {
                                        if ($_SESSION['cliente']["nome"] !== "" && $_SESSION['cliente']["nome"] !== NULL) {
                                            ?>
                                            <span class="badge">
                                                <?= $_SESSION['cliente']["nome"] ?> 
                                                <span class="glyphicon glyphicon-gift"></span>
                                                <?= $_SESSION['cliente']["nome2"] ?>
                                                <?php
                                                list($ano, $mes, $dia) = explode("-", $_SESSION['cliente']["data_evento"]);
                                                print $dia . "/" . $mes . "/" . $ano;
                                                ?>
                                            </span>
                                            <?php
                                        }
                                    } else {
                                        if ($_SESSION['cliente']["nome"] !== "" && $_SESSION['cliente']["nome"] !== NULL) {
                                            ?>
                                            <span class="badge">
                                                <?= $_SESSION['cliente']["nome"] ?> 
                                                <span class="glyphicon glyphicon-globe"></span>
                                                <?= $_SESSION['cliente']["nome2"] ?>
                                                <?php
                                                list($ano, $mes, $dia) = explode("-", $_SESSION['cliente']["data_evento"]);
                                                print $dia . "/" . $mes . "/" . $ano;
                                                ?>
                                            </span>
                                            <?php
                                        }
                                    }
                                    ?>
                                </a>
                            </li>
                            <li role="presentation" class="">
                                <a href="orcamento_convite.php">Convite 
                                    <?php
                                    $convite_count = 0;
                                    foreach ($_SESSION as $key => $value) {
                                        if (strpos($key, 'convite-') === 0) {
                                            $convite_count = $convite_count + 1;
                                        }
                                    }
                                    ?>
                                </a>
                            </li>
                            <li role="presentation" class="">
                                <a href="orcamento_produto.php">Produtos</a>
                            </li>
                            <li role="presentation" class="">
                                <a href="orcamento_carrinho.php">
                                    <?php
                                    // Conta a qtd de convites e produtos na sessão
                                    $cart_count = count($_SESSION['cart_items']) + $convite_count;
                                    ?>
                                    Carrinho
                                    <?php if ($cart_count > 0) { ?>
                                        <span class="badge" id="comparison-count"><?= $cart_count ?></span>
                                    <?php }
                                    ?>
                                </a>
                            </li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /navbar -->