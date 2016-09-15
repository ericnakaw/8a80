<?php
error_reporting(NULL);
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Catalogo";
$confDelete = 'catalogo_deletar.php'; 
$permissao = Array("gerente", "tecnico", "vendas");

if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}
include './header.php';
?>
<body>
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <div id="conteudo" class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">Aproveitamento de papel</div>
                        <div class="panel-body">
                            <form action="formato_calcular.php" method="post">
                                <select class="form-control" name="papel_tamanho">
                                    <option value="">Selecione o formato</option>
                                    <option value="700x1000" <?php
                                    if ($_GET["papel"] == "700x1000") {
                                        print "selected";
                                    }
                                    ?>>700 x 1000 (Rives)</option>
                                    <option value="660x960" <?php
                                    if ($_GET["papel"] == "660x960") {
                                        print "selected";
                                    }
                                    ?>>660 x 960 (Color Plus)</option>
                                    <option value="645x945" <?php
                                    if ($_GET["papel"] == "645x945") {
                                        print "selected";
                                    }
                                    ?>>645 x 945 (Relux)</option> 
                                    <option value="420x594" <?php
                                    if ($_GET["papel"] == "420x594") {
                                        print "selected";
                                    }
                                    ?>>420 x 594 (A2)</option>
                                    <option value="420x297" <?php
                                    if ($_GET["papel"] == "420x297") {
                                        print "selected";
                                    }
                                    ?>>420 x 297 (A3)</option>
                                    <option value="210x297" <?php
                                    if ($_GET["papel"] == "210x297") {
                                        print "selected";
                                    }
                                    ?>>210 x 297 (A4)</option>
                                </select>
                                Largura (mm)<input type="text" name="formato_largura" class="form-control" placeholder="EX: 480" 
                                                   value="<?php
                                                   if (!empty($_GET["formato_largura"])) {
                                                       print $_GET["formato_largura"];
                                                   } else {
                                                       print "";
                                                   }
                                                   ?>">
                                Comprimento (mm)<input type="text" name="formato_comprimento" class="form-control" placeholder="EX: 330"
                                                       value="<?php
                                                       if (!empty($_GET["formato_comprimento"])) {
                                                           print $_GET["formato_comprimento"];
                                                       } else {
                                                           print "";
                                                       }
                                                       ?>">
                                Quantidade do Pedido (pçs)<input type="text" name="quantidade_pedido" class="form-control" placeholder="EX: 100 peças"
                                                                 value="<?php
                                                                 if (!empty($_GET["quantidade_pedido"])) {
                                                                     print $_GET["quantidade_pedido"];
                                                                 } else {
                                                                     print "";
                                                                 }
                                                                 ?>"><br>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="inverter" value="1" <?php
                                    if ($_GET["inverter"]) {
                                        print "checked";
                                    }
                                    ?> > Inverter
                                </label><br><br>
                                <div class="btn-group">
                                    <a href="formato.php" class="btn btn-group btn-danger">Limpar</a>
                                    <input type="submit" class="btn btn-group btn-success" value="Calcular">
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer">
                            <?php
                            print 'Formato: ';
                            if ($_GET["c"] !== NULL) {
                                print $_GET["a"] . " x " . $_GET["b"] . " = <b>" . $_GET["c"] . "</b>";
                                print '<br>Folhas Inteiras: <b>' . $_GET["folha_inteira"] . "</b>";
                                print '<br>Sobra: ' . $_GET["sobra_a"] . "mm x " . $_GET["sobra_b"] . "mm";
                                print '<br><br>Opção A: <b>' . $_GET["folha_inteira"] . " x " . $_GET["c"] . " = " . $_GET["folha_inteira"] * $_GET["c"] . "</b>";
                                print '<br>Opção B: <b>' . ($_GET["folha_inteira"] - 1) . " x " . $_GET["c"] . " = " . ($_GET["folha_inteira"] - 1) * $_GET["c"] . "</b>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <?php
                    $dimensao = 0.8;
                    list($largura, $comprimento) = explode("x", $_GET["papel"]);
                    ?>
                    <canvas id="myCanvas" width="<?= $comprimento * $dimensao; ?>" height="<?= $largura * $dimensao; ?>" style="border:1px solid #c3c3c3;">
                    </canvas>
                    <script>
                        var c = document.getElementById("myCanvas");
                        var x = <?= $_GET["a"] ?>;
                        var y = <?= $_GET["b"] ?>;
                        if (<?= $_GET["formato_largura"] ?> * x > <?= $_GET["formato_comprimento"] ?> * y) {
                            var largura = <?= $_GET["formato_largura"] * $dimensao; ?>;
                            var comprimento = <?= $_GET["formato_comprimento"] * $dimensao ?>;
                            var ctx = c.getContext("2d");
                            for (i = 0; i < y; i++) {
                                for (j = 0; j < x; j++) {
                                    ctx.strokeStyle = "#d9534f";
                                    ctx.strokeRect(largura * j, comprimento * i, largura, comprimento);
                                }
                            }
                        } else {
                            var y = <?= $_GET["a"] ?>;
                            var x = <?= $_GET["b"] ?>;
                            var comprimento = <?= $_GET["formato_largura"] * $dimensao ?>;
                            var largura = <?= $_GET["formato_comprimento"] * $dimensao ?>;
                            var ctx = c.getContext("2d");
                            for (i = 0; i < y; i++) {
                                for (j = 0; j < x; j++) {
                                    ctx.strokeStyle = "#d9534f";
                                    ctx.strokeRect(largura * j, comprimento * i, largura, comprimento);
                                }
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</body>