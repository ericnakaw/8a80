<?php
if (!isset($_SESSION)){ session_start(); }

$nivel_necessario = 2;

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] > $nivel_necessario)) {
  // Redireciona o visitante de volta pro login
  header("Location: ../index.php?msg=Não tem permissão para acessar Checkin"); exit;
}

$serie = $_GET['serie'];
//Serie cadastrada no banco: 1 linha CDB003424, 16 linhas GNW50681, JUJ03749
//$serie = 'GNW50681';

//$query = "SELECT * FROM base WHERE contrato = '$serie'";
$query = "SELECT b.cliente, b.nomeItem, b.serie, b.contrato,b.codigoItem, b.volume, i.imagem, i.tipo, i.contador_tipo, i.contador_max 
        FROM base as b left join info_equipamento as i on b.nomeItem = i.modelo COLLATE utf8_unicode_ci where b.contrato = '".$serie."'";

$char = array('"',"'" ,"/","\\");

include './Classe/conexao.php';
$conexao = new conexao();
$result = $conexao->sql_query($query);
$result1 = $conexao->sql_query($query);
/* Colunas da tabela base
*`id`, `serie`, `contrato`, `codigoItem`, `nomeItem`,
*`OriginalCost`, `bookValue`, `WHCode`, `cliente`, `volume`, `supervisor`
*/
// Atribue informacoes da impressora para variaveis
while($tab = mysql_fetch_array($result)){
    if($tab['serie'] == $tab['contrato']){
        $nomeCliente = $tab['cliente'];
        $serieEquipamento = $tab['serie'];
        $modeloEquipamento = $tab['nomeItem'];
        $mercuryEquipamento = $tab['codigoItem'];
        $volumeEquipamento = $tab['volume'];
        $contTipo = $tab['contador_tipo'];
        $contMax = $tab['contador_max'];
        
    }
    $volumeTotal =+  $tab['volume'];
    $data = date('d/m/y');
}

// Verifica se a imagem da impressora existe
if(file_exists("imagens/".$modeloEquipamento.".jpg")){
    $imgEquipamento = "imagens/".$modeloEquipamento.".jpg";
}else{
    $imgEquipamento = "imagens/nao_cadastrada.jpg";
}

?>
<html>
<head>
    <title>Check-in Canon</title>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script type="text/javascript" src="js/mascara.js"></script>
    <script>
    $(document).ready(function(){
        //regra para destruir
        $("#destruir").click(function (){
            $("#texto_destrir").fadeToggle();
            $("#texto_destrir").val("");
        });
        //regra para contador ilegivel
        $("#contIlegivel").click(function(){
            $("#texto_contIlegivel").fadeToggle();
            $("#texto_contIlegivel").val("");
        });
        //regra para observação
        $("#observacao").click(function(){
            $("#texto_observacao").fadeToggle();
            $("#texto_observacao").val("");
        });
        // regra recebido fadein
        $("#nota_fiscal").on( "click",function(){
            $("#texto_recebido").fadeIn();
        });
        // regra recebido fadeOut
        $("#declaracao").on( "click",function(){
            $("#texto_recebido").fadeOut();
            $("div.ui-input-text.ui-body-inherit.ui-corner-all.controlgroup-textinput.ui-btn.ui-shadow-inset.ui-last-child").css({margin: 0,padding: 0});
        });
        // deixar a div do texto_recebido visivel
        // Destruir se ultrapassar contador total
        $( "input[name='total(101)']" ).keyup(function(){
            var contMax = <?= $contMax ?>;
            var total = $("input[name='total(101)']").val();
            total = total.replace(/\./g,"");
            if(contMax !== ""){
                if(total >= contMax){
                    if($("#destruir").prop('checked') === false){
                        alert('atingiu a vida util:  <?= $contMax ?>');
                        $("#destruir").click();
                    }
                }
            }
        });
        //contadore P/B
        $( "#cont-1" ).on( "click",function(){
            $("#contadores").html("\n\
            <label for='cont'>Total(101):</label>\n\
            <div class='ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset'><input type='text' name='total(101)' id='total101' onkeyup='mascara(this.name, this.value)'></div>\n\
                            ");
        });
        //contadore Colorida
        $( "#cont-2" ).on( "click",function(){
            $("#contadores").html("\n\
                <label for='total(101)'>Total(101):</label>\n\
                <div class='ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset'><input type='text' name='total(101)' id='total101' onkeyup='mascara(this.name, this.value)'></div>\n\
		<label for='total_P/B(108)'>Total_P/B(108):</label>\n\
                <div class='ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset'><input type='text' name='total_P/B(108)' id='total_PB108' onkeyup='mascara(this.name, this.value)'></div>\n\
		<label for='FL_(229)'>FL (229):</label>\n\
                <div class='ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset'><input type='text' name='FL_(229)' id='FL_229' onkeyup='mascara(this.name, this.value)'></div>\n\
                <label for='FS_(230)'>FS (230):</label>\n\
                <div class='ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset'><input type='text' name='FS_(230)' id='FS_230' onkeyup='mascara(this.name, this.value)'></div>\n\
                <label for='IL_(321)'>IL (321):</label>\n\
                <div class='ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset'><input type='text' name='IL_(321)' id='IL_321' onkeyup='mascara(this.name, this.value)'></div>\n\
                <label for='IS_(322)'>IS (322):</label>\n\
                <div class='ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset'><input type='text' name='IS_(322)' id='IS_322' onkeyup='mascara(this.name, this.value)'></div>\n\
                ");
        });
        //contadore IRC-1030/1022
        $( "#cont-3" ).on( "click",function(){
            $("#contadores").html("\n\
                <label for='total(101)'>Total(101):</label>\n\
                <div class='ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset'><input type='text' name='total(101)' id='total101' onkeyup='mascara(this.name, this.value)'></div>\n\
		<label for='total_P/B(108)'>Total_P/B(108):</label>\n\
                <div class='ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset'><input type='text' name='total_P/B(108)' id='total_PB108' onkeyup='mascara(this.name, this.value)'></div>\n\
                <label for='FS_(234)'>FS (224):</label>\n\
                <div class='ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset'><input type='text' name='FS_(234)' id='FS_234' onkeyup='mascara(this.name, this.value)'></div>\n\
                <label for='IS_(322)'>IS (316):</label>\n\
                <div class='ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset'><input type='text' name='IS_(322)' id='IS_322' onkeyup='mascara(this.name, this.value)'></div>\n\
                ");
        });
        //contador OKI
        $( "#cont-4" ).on( "click",function(){
            $("#contadores").html("\n\
                <label for='Total_Page'>Total_Page:</label>\n\
                <div class='ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset'><input type='text' name='total_Page' id='total_Page' onkeyup='mascara(this.name, this.value)'></div>\n\
		<label for='Total_Usage'>Total_Usage:</label>\n\
                <div class='ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset'><input type='text' name='total_Usage' id='total_Usage' onkeyup='mascara(this.name, this.value)'></div>\n\
                ");
        });
    });
    // adicionar ponto nos campo
    function mascara(nome, valor){
        $("input[name='"+nome+"']").val(ponto(valor));
    }
    
    // Validador do Formulario
    function valida(){
        // se selecionado nota fiscal campo numero nao fica em branco
        if($('#nota_fiscal').prop('checked')){
            if($("#texto_recebido").val() === ""){
                alert('preencha o numero da nota fiscal.');
                $("#texto_recebido").focus();
                return false;
            }
        }
        // se contador ilegivel esta marcado os contadores pode ficar em branco 
	if($("#contIlegivel").prop('checked') === false){
        // nao deixar contador em branco
        if($('#cont-1').prop('checked')){
            if($("#total101").val() === ""){
                alert('preencha o contador Total(101)');
                $("#total101").focus();
                return false;
            }
        }
        // nao deixar contador em branco
        if($('#cont-2').prop('checked')){
            if($("#total101").val() === ""){
                alert('preencha o contador Total(101)');
                $("#total101").focus();
                return false;
            }
            if($("#total_PB108").val() === ""){
                alert('preencha o contador Total_P/B(108)');
                $("#total_PB108").focus();
                return false;
            }
            if($("#FL_229").val() === ""){
                alert('preencha o contador FL_(229)');
                $("#FL_229").focus();
                return false;
            }
            if($("#FS_230").val() === ""){
                alert('preencha o contador FS_(230)');
                $("#FS_230").focus();
                return false;
            }
            if($("#IL_321").val() === ""){
                alert('preencha o contador IL_(321)');
                $("#IL_321").focus();
                return false;
            }
            if($("#IS_322").val() === ""){
                alert('preencha o contador IS_(322)');
                $("#IS_322").focus();
                return false;
            }
        }
        // nao deixar contador em branco
        if($('#cont-3').prop('checked')){
            if($("#total101").val() === ""){
                alert('preencha o contador Total(101)');
                $("#total101").focus();
                return false;
            }
            if($("#total_PB108").val() === ""){
                alert('preencha o contador total_P/B(108)');
                $("#total_PB108").focus();
                return false;
            }
            if($("#FS_234").val() === ""){
                alert('preencha o contador FS_(234)');
                $("#FS_234").focus();
                return false;
            }
            if($("#IS_322").val() === ""){
                alert('preencha o contador IS_(322)');
                $("#IS_322").focus();
                return false;
            }
        }
        // nao deixar contador em branco
        if($('#cont-4').prop('checked')){
            if($("#total_Page").val() === ""){
                alert('preencha o contador Total_Page');
                $("#total_Page").focus();
                return false;
            }
            if($("#total_Usage").val() === ""){
                alert('preencha o contador Total_Usage');
                $("#total_Usage").focus();
                return false;
            }
        }
		}
        // se selecionado destruir nao deixar em branco o motivo
        if($("#destruir").prop('checked')){
            if($("#texto_destrir").val() === ""){
                alert('Digite o motivo da destruição');
                $("#texto_destrir").focus();
                return false;
            }
        }
        // se selecionado contador ilegivel nao deixar em branco o motivo
        if($("#contIlegivel").prop('checked')){
            if($("#texto_contIlegivel").val() === ""){
                alert('Digite o motivo do contador ilegivel');
                $("#texto_contIlegivel").focus();
                return false;
            }
        }
    }
    </script>
    <style>
        img{
            max-width: 320px;
        }
        .max{
            max-width: 700px;
        }
        /* Custom indentations are needed because the length of custom labels differs from
            the length of the standard labels */
        .custom-size-flipswitch.ui-flipswitch .ui-btn.ui-flipswitch-on {
            text-indent: -5.9em;
        }
        .custom-size-flipswitch.ui-flipswitch .ui-flipswitch-off {
            text-indent: 0.5em;
        }
        /* Custom widths are needed because the length of custom labels differs from
           the length of the standard labels */
        .custom-size-flipswitch.ui-flipswitch {
            width: 8.875em;
        }
        .custom-size-flipswitch.ui-flipswitch.ui-flipswitch-active {
            padding-left: 7em;
            width: 1.875em;
        }
        @media (min-width: 28em) {
            /*Repeated from rule .ui-flipswitch above*/
            .ui-field-contain > label + .custom-size-flipswitch.ui-flipswitch {
                width: 1.875em;
            }
        }
        .controlgroup-textinput{
        padding-top:.22em;
        padding-bottom:.22em;
    }
    </style>
</head>
<body>
    <!-- inicio pagina -->
    <div data-role="page">
    <!--inicio cabeçalho-->
    <header data-role="header"  data-position="fixed">
        <a href="#menu" data-display="overlay" data-icon="bars">Menu</a>
        <h1>Check-in</h1>
        <?php
        // verifica se esta logado
        if (isset($_SESSION['UsuarioID'])) {
            print '<a href="#login" id="log" data-rel="popup" data-position-to="origin" data-transition="pop"
                    class="ui-btn ui-shadow ui-corner-all ui-icon-user ui-btn-icon-left">'.$_SESSION["UsuarioNome"].'</a>';
        }else{
            print '<a href="#login" id="log" data-rel="popup" data-position-to="origin" data-transition="pop"
                    class="ui-btn ui-shadow ui-corner-all ui-icon-user ui-btn-icon-left">Entrar</a>';
        }
    ?>
</header> <!--fim cabeçalho-->
<!--Login-->
<div data-role="popup" id="login" data-theme="a" class="ui-corner-all">
    <div style="padding:10px 20px;">
        <?php
        // Opcao do popup Login
        if (isset($_SESSION['UsuarioID'])) {
            print "<tr><td><b>Login: </b></td><td>".$_SESSION['Usuariologin']."</td></tr>";
            print "<br>";
            print "<tr><td><b>Permissão: </b></td><td>".$_SESSION['UsuarioNivel']."</td></tr>";
            print "<br>";
            print '<a href="login/logout.php" data-icon="delete" class="ui-btn ui-shadow ui-corner-all" data-ajax="false">Sair</a>';
        }else{
            print  '<form method="POST" action="login/valida_login.php" data-ajax="false">
                        <div class="ui-field-contain">
                            <label for="usuario">Usuario:</label><input type="text" name="usuario" id="usuario">
                        </div>
                        <div class="ui-field-contain">
                            <label for="senha">Senha:</label><input type="password" name="senha" id="senha">
                        </div>
                        <div class="ui-field-contain">
                            <input type="submit" value="Entrar" id="entrar" name="entrar">
                        </div>
                    </form>';
        }
        ?>
    </div>
</div> <!--fim Login-->
    <!--menu-->
    <div data-role="panel" id="menu" data-display="overlay" data-type="vertical">
            <a href="index.php" class="ui-btn">Home</a>
            <a href="formularios/index.php" class="ui-btn" >Formularios</a>
            <a href="info_equipamento/index.php" class="ui-btn">Equipamentos</a>
    </div>
    <!--fim menu-->
    <!--fim cabeçalho--> 
    <!--inicio navegacao principal-->
    <!-- inicio form preenchido automaticamente -->
    <section data-role="content" class="max">
        <!--Popup da imagem da impressora-->
        <div data-role="popup" id="<?= str_replace(" ","_",str_replace($char,"",$imgEquipamento))?>" class="ui-content" style="max-width:350px">
            <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
            <?php
            // Se tem imagem ou nao
            if(file_exists ("imagens/".str_replace( $char,"",$modeloEquipamento).".jpg")){
                print"<div class='ui-content'><img src='imagens/". str_replace( $char,"", $modeloEquipamento) .".jpg'></div>";
            }
            else{
                print "<h1 style='color: red'>Imagem não cadastrada</h1>";}?>
        </div>
        <!--Procedimento para verificar se tem o software-->
        <div data-role="popup" id="software" class="ui-content" style="max-width:280px">
            <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
            <p>Procedimento de Configuracao</p>
            <p>Ligue o equipamento e siga as instrucoes abaixo para anotar os acessorios instalados via software ( LMS ):</p>
            <p>1) Pressione a tecla "Counter Check" no painel de controle.</p>
            <img src="imagens/soft-img-1.jpg" >
            <p>2) Pressione sobre a opcao "Configuracao do Dispositivo" no display do painel de controle.</p>
            <img src="imagens/soft-img-2.jpg" >
            <p>3) Toque no botao com a seta para baixo, no display do painel de controle, para acessar a pagina 2 de3.</p>
            <img src="imagens/soft-img-3.jpg" >
            <p>4) Marque na relacao os acessorios que aparecem na tela. </p>
            <img src="imagens/soft-img-4.jpg" >
            <p>5) Toque no botao com a seta para baixo, no display do painel de controle, para acessar a pagina 3 de 3.</p>
            <img src="imagens/soft-img-5.jpg" >
            <p>6) Marque na relação os acessórios que aparecem na tela.</p>
            <img src="imagens/soft-img-6.jpg" >
        </div>
        <form method="POST" action="formulario_gravar.php" data-ajax="false" onsubmit="return valida()">
            
        <label for="data">Data: <b><?= $data?></b></label>
        <input type="hidden" name="data" id="modelo" value="<?= $data?>">
        <label for="modelo">Modelo: <b><?= $modeloEquipamento?></b>
            <a href="#<?= str_replace(" ","_",str_replace( $char,"",$imgEquipamento))?>" data-rel="popup" class='ui-btn ui-shadow ui-corner-all ui-icon-eye ui-btn-icon-notext'>+Imagem</a>
        </label>
        <input type="hidden" name="modelo" id="modelo" value="<?= $modeloEquipamento?>" >
        <label for="mercury">Mercury: <b><?= $mercuryEquipamento?></b></label>
        <input type="hidden" name="mercury" id="mercury" value="<?= $mercuryEquipamento?>" >
        <label for="responsavel">Responsavel: <b><?= $_SESSION["UsuarioNome"] ?></b></label>
        <input type="hidden" name="responsavel" id="responsavel" value="<?= $_SESSION["UsuarioNome"] ?>" >
        <label for="serie">Nº de série: <b><?= $serieEquipamento?></b></label>
        <input type="hidden" name="serie" id="serie" value="<?= $serieEquipamento?>" >
        <label for="cliente">Recebida do cliente: <b><?= $nomeCliente?></b></label>
        <input type="hidden" name="cliente" id="cliente" value="<?= $nomeCliente?>" >
        <!-- fim form preenchido automaticamente -->
        <!-- inicio form preenchido po -->
        
        <div class="ui-field-contain"> <!-- Incio contador -->
            <?php
            if($contTipo != ""){
                if($contTipo == "P/B"){
                print "<fieldset data-role='controlgroup' data-type='horizontal'>
                        <legend>Contador:</legend>
                        <label for='cont-1'>P/B</label><input type='radio' name='cont-tipo' id='cont-1' value='P/B' checked>
                    </fieldset>
                    <div id='contadores' class='ui-field-contain'>
                        <label for='cont'>Total(101):</label>
                            <input type='text' name='total(101)' id='total101' onkeyup='mascara(this.name, this.value)'>
                    </div>";
                }
                if($contTipo == "Colorida"){
                print "<fieldset data-role='controlgroup' data-type='horizontal'>
                        <legend>Contador:</legend>
                        <label for='cont-2'>Colorida</label><input type='radio' name='cont-tipo' id='cont-2' value='Colorida' checked>
                    </fieldset>
                    <div id='contadores' class='ui-field-contain'>
                        <label for='total(101)'>Total(101):</label>
                            <input type='text' name='total(101)' id='total101' onkeyup='mascara(this.name, this.value)'>
                        <label for='total_P/B(108)'>Total_P/B(108):</label>
                            <input type='text' name='total_P/B(108)' id='total_PB108' onkeyup='mascara(this.name, this.value)'>
                        <label for='FL_(229)'>FL (229):</label>
                            <input type='text' name='FL_(229)' id='FL_229' onkeyup='mascara(this.name, this.value)'>
                        <label for='FS_(230)'>FS (230):</label>
                            <input type='text' name='FS_(230)' id='FS_230' onkeyup='mascara(this.name, this.value)'>
                        <label for='IL_(321)'>IL (321):</label>
                            <input type='text' name='IL_(321)' id='IL_321' onkeyup='mascara(this.name, this.value)'>
                        <label for='IS_(322)'>IS (322):</label>
                            <input type='text' name='IS_(322)' id='IS_322' onkeyup='mascara(this.name, this.value)'>
                    </div>";
                }
                if($contTipo == "IRC-1030"){
                print "<fieldset data-role='controlgroup' data-type='horizontal'>
                        <legend>Contador:</legend>
                        <label for='cont-3'>IRC-1030</label><input type='radio' name='cont-tipo' id='cont-3' value='Colorida' checked>
                    </fieldset>
                    <div id='contadores' class='ui-field-contain'>
                        <label for='total(101)'>Total(101):</label>
                            <input type='text' name='total(101)' id='total101' onkeyup='mascara(this.name, this.value)'>
                        <label for='total_P/B(108)'>Total_P/B(108):</label>
                            <input type='text' name='total_P/B(108)' id='total_PB108' onkeyup='mascara(this.name, this.value)'>
                        <label for='FS_(234)'>FS (224):</label>
                            <input type='text' name='FS_(234)' id='FS_234' onkeyup='mascara(this.name, this.value)'>
                        <label for='IS_(322)'>IS (316):</label>
                            <input type='text' name='IS_(322)' id='IS_322' onkeyup='mascara(this.name, this.value)'>
                    </div>";
                }
                if($contTipo == "Oki"){
                print "<fieldset data-role='controlgroup' data-type='horizontal'>
                        <legend>Contador:</legend>
                        <label for='cont-4'>Oki</label><input type='radio' name='cont-tipo' id='cont-4' value='Colorida' checked>
                    </fieldset>
                    <div id='contadores' class='ui-field-contain'>
                    <label for='Total_Page'>Total_Page:</label>
                        <input type='text' name='total_Page' id='total_Page' onkeyup='mascara(this.name, this.value)'>
                    <label for='Total_Usage'>Total_Usage:</label>
                        <input type='text' name='total_Usage' id='total_Usage' onkeyup='mascara(this.name, this.value)'>
                    </div>";
                }
                if($contTipo == "sem_contador"){
                print "<fieldset data-role='controlgroup' data-type='horizontal'>
                        <legend>Contador:</legend>
                        <label for='cont-5'>Sem contador</label><input type='radio' name='cont-tipo' id='cont-5' value='sem_contador' checked>
                    </fieldset>";
                }
            }
            else {
                print "<fieldset data-role='controlgroup' data-type='horizontal'>
                        <legend>Contador:</legend>
                        <label for='cont-1'>P/B</label><input type='radio' name='cont-tipo' id='cont-1' value='P/B' checked>
                        <label for='cont-2'>Colorida</label><input type='radio' name='cont-tipo' id='cont-2' value='colorida'>
                        <label for='cont-3'>IRC-1030</label><input type='radio' name='cont-tipo' id='cont-3' value='IRC-1030'>
                        <label for='cont-4'>Oki</label><input type='radio' name='cont-tipo' id='cont-4' value='Oki'>
                    </fieldset>
                    <div id='contadores' class='ui-field-contain'>
                        <label for='cont'>Total(101):</label>
                        <input type='text' name='total(101)' id='total101'>
                    </div>";
                }
            ?></div> <!-- fim Contadores -->
        <div class="ui-field-contain">
            <label for="armazem">Armazém:</label>
            <select name="armazem" id="armazem">
                <option value="Syncreon">Syncreon</option>
                <option value="Robotech">Robotech</option>
                <option value="DHL">DHL</option>
                <option value="TEGMA">TEGMA</option>
                <option value="Segura">Segura</option>
            </select>
        </div> 
            <!-- Armazem -->
        <fieldset data-role="controlgroup" data-type="horizontal">
            <legend>Recebido com:</legend>
            <label for="declaracao">Declaração</label><input type="radio" name='recebido' id="declaracao" value="declaracao">
            <label for="nota_fiscal">Nota fiscal</label><input type="radio" name='recebido' id="nota_fiscal" value="nota_fiscal" checked>
            <input type="text" name="texto_recebido" id="texto_recebido" data-wrapper-class="controlgroup-textinput" placeholder="Digite aqui o nº">
        </fieldset>
            <!--Se e com nota fiscal ou declaracao-->
            
        <label for="destruir">Destruir este equipamento</label>
        <input type="checkbox" name="" id="destruir">
        <textarea name="texto_destruir" id="texto_destrir" style="display: none" placeholder="Motivo da destruicao do equipamento"></textarea>
        <!-- fadein quando selecionar destruir -->

        <label for="contIlegivel">Contador ilegivel</label>
        <input type="checkbox" name="" id="contIlegivel">
        <textarea name="texto_contIlegivel" id="texto_contIlegivel" style="display: none" placeholder="Motivo do contador ilegivel"></textarea>
        <!-- fadein quando selecionar cont ilegivel -->

        <div data-role="collapsible-set">
        <p><b>Verifique os acessorios abaixo:</b></p>
        <?php
        while($tab1 = mysql_fetch_array($result1, MYSQL_ASSOC)){
            
            if($tab1['serie'] != $tab1['contrato']){
                $n = $n +1;
                    print  "<div data-role='ui-field-contain'>
                                <label for='".$tab1['nomeItem']."'>".$tab1['nomeItem']."  /  Serie: ".$tab1['serie']."</label>
                                <select name='acessorio-".$n."' data-role='flipswitch' id='".$tab1['nomeItem']."'>
                                        <option value='".$tab1['nomeItem']."*-nao*-".$tab1['serie']."*-".$tab1['codigoItem']."'>Não</option>
                                        <option value='".$tab1['nomeItem']."*-sim*-".$tab1['serie']."*-".$tab1['codigoItem']."'>Sim</option>
                                </select>
                            </div>"; // Imprimir o flip do acessorio
                    print "<div data-role='collapsible'>
                                <h3>Detalhes</h3>
                                <p>Volume: ".$tab1['volume']."</p>
                                <p>Mercury: ".$tab1['codigoItem']."</p>
                                <p>Serie: ".$tab1['serie']."</p>";
                    if($tab1['tipo'] == 'software'){
                        print "<a href='#software' data-rel='popup' class='ui-btn ui-shadow ui-corner-all ui-icon-eye ui-btn-icon-notext'>+Imagem</a></div>";
                    }
                    else{
                        if(file_exists("imagens/".str_replace( $char,"", $tab1['nomeItem']).".jpg")){
                            print "<div class='ui-content'><img src='imagens/". str_replace( $char,"", $tab1['nomeItem']) .".jpg' id='popup_img'></div></div>";
                        }
                        else{
                            print "<h1 style='color: red'>Imagem não cadastrada</h1></div>";
                        }
                    }
            }
        }
        ?>
        </div>
        <div class="ui-field-contain">
            <label for="observacao">observação</label>
            <input type="checkbox" name="" id="observacao">
            <textarea name="texto_observacao" id="texto_observacao" style="display: none" placeholder="Observações"></textarea>
            <!-- fadein quando selecionar obsercao -->
        </div>
        <!-- fim form preenchido pelo tecnico -->
        <div class="ui-grid-a">
            <div class="ui-block-a"><a href="index.php" class="ui-btn" data-ajax="false">Cancelar</a></div>
            <div class="ui-block-b"><input type="submit" value="enviar" ></div>
        </div>
    </form>
    </section>
    </div>
</body>
</html>