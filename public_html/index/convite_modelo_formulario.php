<?php
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Convite Modelos Formulário"; //nome da página
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}

include './header.php';
include './conexao/Conexao.php';
include './objeto/ConviteModelo.php';
$arr = $_REQUEST;

if (empty($arr["id"])) {
    $nomeModelo = "";
    $alturaModelo = "";
    $larguraModelo = "";
    $aproveitamentoCartao = "";
    $aproveitamentoEnvelope = "";
    $formatoCartaoAltura = "";
    $formatoCartaoLargura = "";
    $formatoEnvelopeAltura = "";
    $formatoEnvelopeLargura = "";
    $composicao = "";
    $colagem = "";
    $duplaFace = "";
    $dobra = "";
    $empastamentoBorda = "";
    $empastamentoBordaEnv = "";
    $markup = "";
    $observacao = "";
    $botao = "Inserir";
    $pageName = "Novo Modelo Convite";
    $acao = "convite_modelo_inserir.php";
} else {
    $conexao = new Conexao();
    $conviteModelo = new ConviteModelo($conexao);
    $resultado = $conviteModelo->selectConviteModelo($arr["id"]);
    $tabela = mysql_fetch_array($resultado);
    $id = $tabela["id"];
    $cod = $tabela["cod"];
    $nomeModelo = $tabela["nome"];
    $alturaModelo = $tabela["altura"];
    $larguraModelo = $tabela["largura"];
    $aproveitamentoCartao = $tabela["formato_cartao"];
    $aproveitamentoEnvelope = $tabela["formato_envelope"];
    $formatoCartaoAltura = $tabela["formato_cartao_altura"];
    $formatoCartaoLargura = $tabela["formato_cartao_largura"];
    $formatoEnvelopeAltura = $tabela["formato_envelope_altura"];
    $formatoEnvelopeLargura = $tabela["formato_envelope_largura"];
    $composicao = $tabela["folha_unica"];
    $colagem = $tabela["colagem_pva"];
    $duplaFace = $tabela["dupla_face"];
    $dobra = $tabela["dobra"];
    $empastamentoBorda = $tabela["empastamento_borda"];
    $empastamentoBordaEnv = $tabela["empastamento_borda_envelope"];
    $markup = $tabela["markup"];
    $observacao = $tabela["observacao"];
    $botao = "Alterar";
    $pageName = "Alterar Modelo";
    $acao = "convite_modelo_alterar.php?id=" . $id;
}
?>
<script>
    // Validador do Formulario
    function valida() {
        if ($("#nomeModelo").val() === "") {
            alert('preencha o nome do modelo de convite');
            $("#nomeModelo").focus();
            return false;
        }
        if ($("#alturaModelo").val() === "") {
            alert('preencha a altura do modelo de convite');
            $("#alturaModelo").focus();
            return false;
        }
        if ($("#larguraModelo").val() === "") {
            alert('preencha a largura do modelo de convite');
            $("#larguraModelo").focus();
            return false;
        }
        if ($("#aproveitamentoCartao").val() === "") {
            alert('preencha o aproveitamento do cartão do modelo de convite');
            $("#aproveitamentoCartao").focus();
            return false;
        }
        if ($("#aproveitamentoEnvelope").val() === "") {
            alert('preencha o aproveitamento do envelope do modelo de convite');
            $("#aproveitamentoEnvelope").focus();
            return false;
        }
        if ($("#formatoCartaoAltura").val() === "") {
            alert('preencha o formato da Altura do Cartao');
            $("#formatoCartaoAltura").focus();
            return false;
        }
        if ($("#formatoCartaoLargura").val() === "") {
            alert('preencha o formato da Largura do Cartao');
            $("#formatoCartaoLargura").focus();
            return false;
        }
        if ($("#formatoEnvelopeAltura").val() === "") {
            alert('preencha o formato da Altura do Envelope');
            $("#formatoEnvelopeAltura").focus();
            return false;
        }
        if ($("#formatoEnvelopeLargura").val() === "") {
            alert('preencha o formato da Largura do Envelope');
            $("#formatoEnvelopeLargura").focus();
            return false;
        }
        if ($("#composicao").val() === "") {
            alert('preencha a composição do convite');
            $("#composicao").focus();
            return false;
        }
        if ($("#duplaFace").val() === "") {
            alert('preencha a dupla face do convite');
            $("#duplaFace").focus();
            return false;
        }
        if ($("#colagem").val() === "") {
            alert('preencha a colagem do convite');
            $("#colagem").focus();
            return false;
        }
        if ($("#markup").val() === "") {
            alert('preencha o markup do convite');
            $("#markup").focus();
            return false;
        }
        if ($("#empastamentoBorda").val() === "") {
            alert('preencha a borda do empastamento em mm somente em números. Ex: 10,20,30...');
            $("#empastamentoBorda").focus();
            return false;
        }
        if ($("#empastamentoBordaEnvelope").val() === "") {
            alert('preencha a borda do empastamento em mm somente em números. Ex: 10,20,30...');
            $("#empastamentoBordaEnvelope").focus();
            return false;
        }
        if ($("#codModelo").val() === "") {
            alert('preencha código modelo do convite');
            $("#codModelo").focus();
            return false;
        }
    }
</script>

<body>
    <div class="container">
        <!--primeira linha da row-->
        <div class="row">
            <div class="col-md-6">
                <h2><?php print $pageName; ?></h2>

                <!--inserir ou alterar na acao-->
                <form action="<?php echo $acao ?>" method="POST" role="form" onsubmit="return valida()">

                    <div class="form-group">
                        <label for="codModelo">Cod do Modelo:
                        </label>
                        <input type="number" class="form-control" value= "<?php print $cod; ?>" name="codModelo" id="codModelo" placeholder="Entre com o código do modelo" >
                    </div>
                    <div class="form-group">
                        <label for="nomeModelo">Nome do Modelo:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $nomeModelo; ?>" name="nomeModelo" id="nomeModelo" placeholder="Entre com o Modelo do Convite Ex: Juliana" >
                    </div>
                    <div class="form-group">
                        <label for="composicao">Composição:
                        </label>
                        <select name="composicao" class="form-control" id="composicao" >
                            <option value="">Selecione a composição do convite</option>
                            <option value="0"
                            <?php
                            if ($composicao == "0") {
                                print "selected";
                            }
                            ?>
                                    >Convite + Envelope</option>
                            <option value="1"
                            <?php
                            if ($composicao == "1") {
                                print "selected";
                            }
                            ?>
                                    >Folha Única</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alturaModelo">Altura:
                        </label>
                        <input type="text" class="form-control" value= "<?= $alturaModelo; ?>" name="alturaModelo" id="alturaModelo" placeholder="Entre com a altura do modelo final Ex: 21cm" >
                    </div>
                    <div class="form-group">
                        <label for="larguraModelo">Largura:
                        </label>
                        <input type="text" class="form-control" value= "<?= $larguraModelo; ?>" name="larguraModelo" id="larguraModelo" placeholder="Entre com a largura do modelo final Ex: 27cm" >
                    </div>
                    <div class="form-group">
                        <label for="aproveitamentoCartao">Aproveitamento Cartao:
                        </label>
                        <input type="number" class="form-control" value= "<?= $aproveitamentoCartao; ?>" name="aproveitamentoCartao" id="aproveitamentoCartao" placeholder="Entre o aproveitamento do cartão" >
                    </div>
                    <div class="form-group">
                        <label for="formatoCartaoAltura">Formato Cartão Altura:
                        </label>
                        <input type="number" class="form-control" value= "<?= $formatoCartaoAltura; ?>" name="formatoCartaoAltura" id="formatoCartaoAltura" placeholder="Entre com o formato para corte da altura do cartão Ex: 205mm" >
                    </div>
                    <div class="form-group">
                        <label for="formatoCartaoLargura">Formato Cartão Largura:
                        </label>
                        <input type="number" class="form-control" value= "<?= $formatoCartaoLargura; ?>" name="formatoCartaoLargura" id="formatoCartaoLargura" placeholder="Entre com o formato para corte da largura do cartão Ex: 265mm" >
                    </div>
                    <div class="form-group">
                        <label for="empastamentoBorda">Empastamento Borda Cartão:
                            <span class="glyphicon glyphicon-info-sign " data-toggle="tooltip" data-placement="left" title="Este valor será adicionado ao formato final do cartão e calculado o melhor aproveitamento. ex:Formato do cartão 160x230, se for empastado e o valor da borda ser 10mm, ficará 170x240 e calcula o melhor aproveitamento"></span>
                        </label>
                        <select class="form-control" name="empastamentoBorda" id="empastamentoBorda">
                            <option value="0">Selecione a borda de empastamento do Cartão</option>
                            <option value="0" <?php if($empastamentoBorda==0){print "selected";}?>>0 mm</option>
                            <option value="5" <?php if($empastamentoBorda==5){print "selected";}?>>5 mm</option>
                            <option value="10" <?php if($empastamentoBorda==10){print "selected";}?>>10 mm</option>
                            <option value="15" <?php if($empastamentoBorda==15){print "selected";}?>>15 mm</option>
                            <option value="20" <?php if($empastamentoBorda==20){print "selected";}?>>20 mm</option>
                            <option value="25" <?php if($empastamentoBorda==25){print "selected";}?>>25 mm</option>
                            <option value="30" <?php if($empastamentoBorda==30){print "selected";}?>>30 mm</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="aproveitamentoEnvelope">Aproveitamento Envelope:
                        </label>
                        <input type="number" class="form-control" value= "<?= $aproveitamentoEnvelope; ?>" name="aproveitamentoEnvelope" id="aproveitamentoEnvelope" placeholder="Entre com o aproveitamento do envelope" >
                    </div>
                    <div class="form-group">
                        <label for="formatoEnvelopeAltura">Formato Envelope Altura:
                        </label>
                        <input type="number" class="form-control" value= "<?= $formatoEnvelopeAltura; ?>" name="formatoEnvelopeAltura" id="formatoEnvelopeAltura" placeholder="Entre com o formato para corte da altura do envelope Ex: 330mm" >
                    </div>
                    <div class="form-group">
                        <label for="formatoEnvelopeLargura">Formato Envelope Largura:
                        </label>
                        <input type="number" class="form-control" value= "<?= $formatoEnvelopeLargura; ?>" name="formatoEnvelopeLargura" id="formatoEnvelopeLargura" placeholder="Entre com o formato para corte da largura do envelope Ex: 480mm" >
                    </div>
                    <div class="form-group">
                        <label for="empastamentoBordaEnvelope">Empastamento Borda Envelope:
                            <span class="glyphicon glyphicon-info-sign " data-toggle="tooltip" data-placement="left" title="Este valor será adicionado ao formato final do cartão e calculado o melhor aproveitamento. ex:Formato do cartão 160x230, se for empastado e o valor da borda ser 10mm, ficará 170x240 e calcula o melhor aproveitamento"></span>
                        </label>
                        <select class="form-control" name="empastamentoBordaEnvelope" id="empastamentoBordaEnvelope">
                            <option value="0">Selecione a borda de empastamento do Envelope</option>
                            <option value="0" <?php if($empastamentoBordaEnv==0){print "selected";}?>>0 mm</option>
                            <option value="5" <?php if($empastamentoBordaEnv==5){print "selected";}?>>5 mm</option>
                            <option value="10" <?php if($empastamentoBordaEnv==10){print "selected";}?>>10 mm</option>
                            <option value="15" <?php if($empastamentoBordaEnv==15){print "selected";}?>>15 mm</option>
                            <option value="20" <?php if($empastamentoBordaEnv==20){print "selected";}?>>20 mm</option>
                            <option value="25" <?php if($empastamentoBordaEnv==25){print "selected";}?>>25 mm</option>
                            <option value="30" <?php if($empastamentoBordaEnv==30){print "selected";}?>>30 mm</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="colagem">Quantidade de colagem:
                        </label>
                        <input type="text" class="form-control" value= "<?= $colagem; ?>" name="colagem" id="colagem" placeholder="Entre com a quantidade de colagens" >
                    </div>
                    <div class="form-group">
                        <label for="duplaFace">Quantidade de Dupla Face:
                        </label>
                        <input type="number" class="form-control" value= "<?= $duplaFace; ?>" name="duplaFace" id="duplaFace" placeholder="Entre com a quantidade de dupla face" >
                    </div>
                    <div class="form-group">
                        <label for="dobra">Quantidade de Dobras:
                        </label>
                        <input type="number" class="form-control" value= "<?= $dobra; ?>" name="dobra" id="dobra" placeholder="Entre com a quantidade de dobras" >
                    </div>
                    <div class="form-group">
                        <label for="markup">Markup:
                        </label>
                        <input type="text" class="form-control" value= "<?= $markup; ?>" name="markup" id="markup" placeholder="Entre com o markup" >
                    </div>
                    <div class="form-group">
                        <label for="observacao">Observacao:
                        </label>
                        <textarea class="form-control" name="observacao" id="observacao" placeholder="Entre com a observacao" ><?= $observacao; ?></textarea>
                    </div>


                    <button type="submit" class="btn btn-success"><?= $botao; ?>
                    </button>
                    <a class="btn btn-default" href="convite_modelo.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>