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
        <link href="css/simple-sidebar.css" rel="stylesheet" />
        <!--Javascript local-->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>

        <!--animete do alert-->
        <link href="css/animate.min.css" rel="stylesheet" />
        <!-- Biblioteca do alert -->
        <script type="text/javascript" src="js/bootstrap-notify.js"></script>
        <!--Biblioteca do wizard-->
        <script type="text/javascript" src="js/wizard/jquery.bootstrap.wizard.js"></script>
        <script type="text/javascript" src="js/wizard/jquery.bootstrap.wizard.min.js"></script>
        <style>
            .header_li_novo{
                color:#5cb85c;
            }
            .header_li_alterar{
                color:#f0ad4e;
            }
            .header_li_cancelar{
                color:#d9534f;
            }
            .header_li_consultar{
                color:#428bca;
            }
        </style>

        <title></title>
    </head>
    <!-- Aqui começa o Navbar ou Menu-->
    <div class="container">
        <div class="row">
            <div id="conteudo" class="col-md-12">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="index.php">8a80</a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li class=""><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-file"></span> Solicitações <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-header">Novo</li>
                                        <li><a href="orcamento_novo.php"><span class="glyphicon glyphicon-plus header_li_novo"></span> Orçamento</a></li>
                                        <li><a href="orcamento_cliente.php"><span class="glyphicon glyphicon-plus header_li_novo"></span> Pedido</a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-plus header_li_novo"></span> Adendo [em construção]</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li class="dropdown-header">Consultar</li>
                                        <li><a href="consultar_orcamento.php"><span class="glyphicon glyphicon-search header_li_consultar"></span> Orçamento</a></li>
                                        <li><a href="consultar_pedido.php"><span class="glyphicon glyphicon-search header_li_consultar"></span> Pedido</a></li>
                                        <li><a href="consultar_adendo.php"><span class="glyphicon glyphicon-search header_li_consultar"></span> Adendo [em construção]</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li class="dropdown-header">Alteração</li>
                                        <li><a href="#"><span class="glyphicon glyphicon-retweet header_li_alterar"></span> Pedido [em construção]</a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-retweet header_li_alterar"></span> Adendo [em construção]</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li class="dropdown-header">Cancelamento</li>
                                        <li><a href="#"><span class="glyphicon glyphicon-ban-circle header_li_cancelar"></span> Pedido [em construção]</a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-ban-circle header_li_cancelar"></span> Adendo  [em construção]</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Meu Cliente<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="cliente.php"><span class="glyphicon glyphicon-user"></span> Cliente</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-wrench"></span> Ferramentas<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="formato.php"><span class="glyphicon glyphicon-th"></span> Calcular Formato</a></li>
                                        <li><a href="orcamento_convite.php"><span class="glyphicon glyphicon-scale"></span> Simular Convite</a></li>
                                        <li><a href="agendamento.php"><span class="glyphicon glyphicon-calendar"></span> Agendamento</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> Painel de Controle<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="acabamento.php"><span class="glyphicon glyphicon-leaf"></span> Acessórios</a></li> 
                                        <li><a href="convite_modelo.php"><span class="glyphicon glyphicon-envelope"></span> Convite Modelos</a></li>
                                        <li><a href="fita.php"><span class="glyphicon glyphicon-bookmark"></span> Fita</a></li>
                                        <li><a href="fonte.php"><span class="glyphicon glyphicon-text-background"></span> Fonte</a></li>
                                        <li><a href="impressao.php"><span class="glyphicon glyphicon-print"></span> Impressão</a></li>
                                        <li><a href="mao_de_obra.php"><span class="glyphicon glyphicon-hand-right"></span> Mão de obra</a></li>
                                        <li><a href="papel.php"><span class="glyphicon glyphicon-file"></span> Papel</a></li>
                                        <li><a href="produto.php"><span class="glyphicon glyphicon-gift"></span> Produto</a></li>
                                        <li><a href="servico.php"><span class="glyphicon glyphicon-scissors"></span> Acabamento</a></li>
                                        <li><a href="catalogo.php"><span class="glyphicon glyphicon-book"></span> Catalogo</a></li>
                                        <li><a href="evento.php"><span class="glyphicon glyphicon-pushpin"></span> Evento</a></li>
                                    </ul>
                                </li> 
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-folder-open"></span> Administração<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="funcionario.php"><span class="glyphicon glyphicon-user"></span> Funcionário</a></li>
                                    </ul>
                                </li>
                                <?php
                                if (empty($_SESSION["UsuarioNome"])) {
                                    $logado = 'Login';
                                } else {
                                    $logado = 'Olá ' . $_SESSION["UsuarioNome"] . ' (' . $_SESSION['UsuarioID'] . ')';
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
                                            <span><i class="glyphicon glyphicon-user"></i></span><?= $_SESSION["UsuarioNome"] ?>
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
                    </div>
                </nav>
            </div>
        </div>
    </div>