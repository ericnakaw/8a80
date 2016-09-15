<?php
$msg = $_GET['msg'];
$form_id = $_GET['form'];
$serie = $_GET['serie'];
//print_r($_SESSION);

if (!isset($_SESSION)){ session_start(); }

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID'])) {
    // Destrói a sessão por segurança
    //print "Sem usuario";
    session_destroy();
}else{
    //print "Com usuario";
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset=utf-8>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Buscar Série</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<style>
#msg{
    font-size: 20px;
}
#conteudo{
    margin: 0 auto;
}
</style>
</head>
<body>
<!-- inicio pagina -->
<div data-role="page" id="page">
<!--inicio cabeçalho-->
<header data-role="header">
    <a href="#menu" data-display="overlay" data-icon="bars">Menu</a>
    <h1>Canon</h1>
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
</div><!--fim Login-->
<!--menu-->
<div data-role="panel" id="menu" data-display="overlay">
    <ul data-role="listview">
        <li><a href="index.php" class="ui-btn">Home</a></li>
        <li><a href="formularios/index.php" class="ui-btn" data-ajax="false">Formularios</a></li>
        <li><a href="info_equipamento/index.php" class="ui-btn" data-ajax="false">Equipamentos</a></li>
        <li><a href="usuario/index.php" class="ui-btn" data-ajax="false">Usuarios</a></li>
    </ul>
</div> <!--fim menu-->
<!--campo do conteudo-->
<div data-role="content" id="conteudo">
    <form action="valida_index.php" method="GET" id="form" data-ajax="false">
            <label for="form-serie" id="lbl-id">Série: </label>
            <div class="max">
                <input type="search" name="serie" id="form-serie">
            </div>
            <div class="max">
            <input type="submit" value="Buscar" class="ui-btn ui-btn-inline">
            </div>
    </form><!--fim campo do conteudo-->
    <div id="msg">
        <?php print $msg;
            // Opcao de impressao caso tenha 'sucesso' na msg
            if (stristr($msg, 'sucesso')) {
                print " nº ".$form_id;
                print "<br><a href='formularios/impressao.php?id=".$form_id."' class='ui-btn ui-corner-all ui-btn-inline' data-ajax='false' target='_blank'>Imprimir</a>";
            }
            if (stristr($msg, 'não encontrada')) {
                print "<br><a href='formulario_checar_generico.php?serie=$serie' class='ui-btn ui-corner-all ui-btn-inline' data-ajax='false' target='_blank'>Formulario generico</a>";
            }
        ?>
    </div>
</div><!--fim principal-->
</div> <!--fim pagina-->
</body>
</html>