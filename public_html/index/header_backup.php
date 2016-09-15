<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html> 
<html>
    <head>
        <!--Tipo de caractere utilizado na página-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <!--viewport abaixo é responsável pelo site responsivel-->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

        <link rel="icon" href="../img/8a80.ico" type="image/gif" sizes="16x16">
        <!--jQuery/Ajax local-->
        <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

        <!--Bootstrap local-->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <!--Javascript local-->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>

        <!--animete do alert-->
        <link href="css/animate.min.css" rel="stylesheet" />
        <!-- Biblioteca do alert -->
        <script type="text/javascript" src="js/bootstrap-notify.js"></script>
        <!--Biblioteca do wizard-->
        <script type="text/javascript" src="js/wizard/jquery.bootstrap.wizard.js"></script>
        <script type="text/javascript" src="js/wizard/jquery.bootstrap.wizard.min.js"></script>

        <title></title>
    </head>
    <!-- Aqui começa o Navbar ou Menu-->
    <div class="container">
        <div class="row">
            <div id="conteudo" class="col-md-12">
                <nav class="navbar navbar-default"> 
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <!-- Agrupa uma lista com 3 listras formando um botão -->
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php">8a80</a>
                        <!--<a href="index.php"><img class="navbar-left" src="img/logo_8a80.png"></a>-->
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class=""><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-barcode"></span> Orcamento<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="orcamento_convite.php"><span class="glyphicon glyphicon-plus"></span> Novo</a></li>
                                    <li><a href="pedido.php"><span class="glyphicon glyphicon-search"></span> Consulta Pedido</a></li>
                                    <li><a href="pedido_imprimir.php"><span class="glyphicon glyphicon-print"></span> Imprimir Pedido</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> Painel de Controle<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="acabamento.php"><span class="glyphicon glyphicon-scissors"></span> Acessórios</a></li> 
                                    <li><a href="convite_modelo.php"><span class="glyphicon glyphicon-envelope"></span> Convite Modelos</a></li>
                                    <li><a href="fita.php"><span class="glyphicon glyphicon-tag"></span> Fita</a></li>
                                    <li><a href="fonte.php"><span class="glyphicon glyphicon-text-background"></span> Fonte</a></li>
                                    <li><a href="impressao.php"><span class="glyphicon glyphicon-print"></span> Impressão</a></li>
                                    <li><a href="mao_de_obra.php"><span class="glyphicon glyphicon-hand-right"></span> Mão de obra</a></li>
                                    <li><a href="papel.php"><span class="glyphicon glyphicon-file"></span> Papel</a></li>
                                    <li><a href="produto.php"><span class="glyphicon glyphicon-gift"></span> Produto</a></li>
                                    <li><a href="servico.php"><span class="glyphicon glyphicon-wrench"></span> Acabamento</a></li>
                                    <li><a href="catalogo.php"><span class="glyphicon glyphicon-book"></span> Catalogo</a></li>
                                    <li><a href="evento.php"><span class="glyphicon glyphicon-pushpin"></span> Evento</a></li>
                                </ul>
                            </li> 
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-folder-close"></span> Administração<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="funcionario.php"><span class="glyphicon glyphicon-user"></span> Funcionário</a></li>
                                </ul>
                            </li>
                            <?php
                            if (empty($_SESSION["UsuarioNome"])) {
                                $logado = 'Login';
                            } else {
                                $logado = 'Olá ' . $_SESSION["UsuarioNome"];
                            }
                            ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown" ><span class ="glyphicon glyphicon-user"></span> <?= $logado ?><strong class="caret"></strong></a>
                                <div class="dropdown-menu" style="padding: 15px; padding-bottom: 15px;">
                                    <?php
                                    if (!isset($_SESSION['UsuarioID'])) {
                                        ?>
                                        <form method="post" action="logar.php" accept-charset="UTF-8">
                                            <input class="form-control" style="margin-bottom: 15px;" type="text" placeholder="Usuario" id="usuario" name="usuario">
                                            <input class="form-control" style="margin-bottom: 15px;" type="password" placeholder="Senha" id="password" name="senha">
                                            <input  class="btn btn-primary btn-block" type="submit" id="sign-in" value="Logar">
                                        </form>
                                        <?php
                                    } else {
                                        ?>
                                        <span><i class="glyphicon glyphicon-user"></i>  </span><?= $_SESSION["UsuarioNome"] ?>
                                        <span class="divider"></span><br>
                                        <span><i class="glyphicon glyphicon-ok-circle"></i>  </span> <?= $_SESSION["UsuarioNivel"] ?>
                                        <a href="logout.php" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-off"></span> Sair</a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>