<?php
include './header.php';
?>
<script>
    $(document).ready(function () {
        $('#rootwizard').bootstrapWizard({onTabClick: function (tab, navigation, index) {
                alert('on tab click disabled');
                return false;
            }});
    });
</script>
<div id="rootwizard">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <!--                    <li><a href="#tab1" data-toggle="tab">First</a></li>
                                    <li><a href="#tab2" data-toggle="tab">Second</a></li>
                                    <li><a href="#tab3" data-toggle="tab">Third</a></li>
                                    <li><a href="#tab4" data-toggle="tab">Forth</a></li>
                                    <li><a href="#tab5" data-toggle="tab">Fifth</a></li>
                                    <li><a href="#tab6" data-toggle="tab">Sixth</a></li>
                                    <li><a href="#tab7" data-toggle="tab">Seventh</a></li>-->
                <ul class="nav nav-tabs">
                    <li role="presentation" class="">
                        <a href="#tab1" data-toggle="tab">Cliente</a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#tab2" data-toggle="tab">Convite 
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
                        <a href="#tab3" data-toggle="tab">Produtos</a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#tab4" data-toggle="tab">
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
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane" id="tab1">
            1
        </div>
        <div class="tab-pane" id="tab2">
            2
        </div>
        <div class="tab-pane" id="tab3">
            3
        </div>
        <div class="tab-pane" id="tab4">
            4
        </div>
        <div class="tab-pane" id="tab5">
            5
        </div>
        <div class="tab-pane" id="tab6">
            6
        </div>
        <div class="tab-pane" id="tab7">
            7
        </div>
        <ul class="pager wizard">
            <li class="previous first" style="display:none;"><a href="#">First</a></li>
            <li class="previous"><a href="#">Previous</a></li>
            <li class="next last" style="display:none;"><a href="#">Last</a></li>
            <li class="next"><a href="#">Next</a></li>
        </ul>
    </div>	
</div>