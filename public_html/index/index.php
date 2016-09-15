<?php
if (!isset($_SESSION)) {
    session_start();
}
$permissao = Array("gerente", "tecnico", "vendas");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("Location: login.php?msg=Sem_permisao");
    die();
}
include_once './header.php';
?>

<style>
    .jumbotron {
        background-color: #594135;
        color: #fff;
        padding: 30px 25px;
    }
    /*        .container {
                padding: 60px 50px;
            }*/
    .bg-grey {
        background-color: #f6f6f6;
    }
    .logo-small {
        color: #555;
        font-size: 30px;
        transition: box-shadow 0.5s;
    }
    .btn-shadow{

    }
    .btn-shadow:hover {
        box-shadow: 5px 0px 40px rgba(0,0,0, .1);
    }
    .logo {
        color: #594135;
        font-size: 200px;
    }
    @media screen and (max-width: 768px) {
        .col-sm-4 {
            text-align: center;
            margin: 25px 0;
        }
    }
</style>
<!-- Aqui começa o conteudo -->
<div class="wrapper" role="main">
    <div class="container">
        <div class="row">
            <!-- Bloco 1 -->
            <div id="conteudo" class="col-md-12">
                <body>
                    <h2></h2>
                    <div class="row">
                        <div class="col-md-4">
                            <?php
                            include './index_panel_novo.php';
                            ?>
                        </div>
                        <div class="col-md-4">
                            <?php
                            include './index_panel_consultar.php';
                            ?>
                        </div>
                        <div class="col-md-4">
                            <?php
                            include './index_panel_acoes.php';
                            ?>
                        </div>
                    </div>
                    <div class="row">
                    </div>

                    <?php
                    die();
                    ?>
                    <div class="panel-group">
                        <div class="panel panel-warning">
                            <div class="panel-heading"><span class="glyphicon glyphicon-retweet"></span></div>
                            <div class="panel-body">
                                <div class="col-sm-4">
                                    <a href="consultar.php" class="btn btn-block btn-shadow">
                                        <span class="glyphicon glyphicon-list-alt logo-small"></span>
                                        <h5 style="color: red;"><span class="glyphicon glyphicon-remove-circle"></span> CANCELAR PEDIDO</h5>
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                    <a class="btn btn-block btn-shadow" href="painel_controle.php">
                                        <span class="glyphicon glyphicon-list-alt logo-small"></span>
                                        <h5 style="color: orange;">ALTERAR PEDIDO</h5>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-primary">
                            <div class="panel-heading">Panel with panel-primary class</div>
                            <div class="panel-body">Panel Content</div>
                        </div>

                        <div class="panel panel-success">
                            <div class="panel-heading">Panel with panel-success class</div>
                            <div class="panel-body">Panel Content</div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading">Panel with panel-info class</div>
                            <div class="panel-body">Panel Content</div>
                        </div>

                        <div class="panel panel-warning">
                            <div class="panel-heading">Panel with panel-warning class</div>
                            <div class="panel-body">Panel Content</div>
                        </div>

                        <div class="panel panel-danger">
                            <div class="panel-heading">Panel with panel-danger class</div>
                            <div class="panel-body">Panel Content</div>
                        </div>
                    </div>
                </body>
            </div>
            <!-- Fim bloco 1 -->
        </div>
    </div>
</div> 
<!-- Fim do conteudo -->