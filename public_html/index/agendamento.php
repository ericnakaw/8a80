<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Agendamento</title>
        <script src="js/jquery-2.1.4.min.js"></script>
    </head>
    <body>
        <?php
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
        if (!isset($_SESSION)) {
            session_start();
        }
        $permissao = Array("gerente", "tecnico", "vendas");

        if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
            header("location: login.php?msg=Sem_permisao");
            die();
        }
        include './header.php';
        include './dao/AgendamentoDao.php';
        include './conexao/ConnectionFactory.php';
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">AGENDA</div>
                        <div class="panel-body">
                            <a href="agendamento_formulario.php" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a>
                            <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></a>
                            <?php
                            $semana = 0;
                            while ($semana < 4) {
                                ?>
                                <!--Inicio: Esta semana button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo 'Este sábado' . date(",d M Y", strtotime("saturday + $semana week")); ?>     <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-header">AGENDAMENTO</li>
                                        <li class="dropdown-submenu">
                                            <a tabindex="-1" href="#">AGENDAR</a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-header">LOCAL</li>
                                                <li class="dropdown-submenu">
                                                    <a href="#">TATUAPÉ</a>
                                                    <ul class="dropdown-menu">
                                                        <li class="text-uppercase"><a href="agendamento_formulario.php?data=<?= date("Y-m-d", strtotime("saturday + $semana week")) ?>&local=tatuape&evento=casamento">Casamento</a></li>
                                                        <li class="text-uppercase"><a href="agendamento_formulario.php?data=<?= date("Y-m-d", strtotime("saturday + $semana week")) ?>&local=tatuape&evento=debutante">Debutante</a></li>
                                                        <li class="text-uppercase"><a href="agendamento_formulario.php?data=<?= date("Y-m-d", strtotime("saturday + $semana week")) ?>&local=tatuape&evento=aniversario">Aniversário</a></li>
                                                        <li class="text-uppercase"><a href="agendamento_formulario.php?data=<?= date("Y-m-d", strtotime("saturday + $semana week")) ?>&local=tatuape&evento=corporativo">Corporativo</a></li>
                                                        <li class="text-uppercase"><a href="agendamento_formulario.php?data=<?= date("Y-m-d", strtotime("saturday + $semana week")) ?>&local=tatuape&evento=outros">Outros</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-submenu">
                                                    <a href="#">GUARULHOS</a>
                                                    <ul class="dropdown-menu">
                                                        <li class="text-uppercase"><a href="agendamento_formulario.php?data=<?= date("Y-m-d", strtotime("saturday + $semana week")) ?>&local=guarulhos&evento=casamento">Casamento</a></li>
                                                        <li class="text-uppercase"><a href="agendamento_formulario.php?data=<?= date("Y-m-d", strtotime("saturday + $semana week")) ?>&local=guarulhos&evento=debutante">Debutante</a></li>
                                                        <li class="text-uppercase"><a href="agendamento_formulario.php?data=<?= date("Y-m-d", strtotime("saturday + $semana week")) ?>&local=guarulhos&evento=aniversario">Aniversário</a></li>
                                                        <li class="text-uppercase"><a href="agendamento_formulario.php?data=<?= date("Y-m-d", strtotime("saturday + $semana week")) ?>&local=guarulhos&evento=corporativo">Corporativo</a></li>
                                                        <li class="text-uppercase"><a href="agendamento_formulario.php?data=<?= date("Y-m-d", strtotime("saturday + $semana week")) ?>&local=guarulhos&evento=outros">Outros</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li class="dropdown-header">CONSULTAR</li>
                                        <li class="dropdown-submenu">
                                            <a tabindex="-1" href="#">CONSULTAR</a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-header">LOCAL</li>
                                                <li><a href="agendamento.php?acao=<?= $semana ?>&local=tatuape">TATUAPÉ</a></li>
                                                <li><a href="agendamento.php?acao=<?= $semana ?>&local=guarulhos">GUARULHOS</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <!--Fim: Esta semana button -->
                                <?php
                                $semana++;
                            }
                            ?>
                            <br>
                            <br>
                            <div class="table table-responsive">
                                <table class="table-condensed table-hover table-striped table-bordered">
                                    <?php
                                    $connectionFactory = new ConnectionFactory();
                                    $mysqli = $connectionFactory->get_Mysqli();
                                    $agendamentoDao = new AgendamentoDao();
                                    if ($_GET['acao'] == 'inserir' && $_GET['result'] == 'true') {
                                        $result = $agendamentoDao->selectCalendar($_GET['data'], $_GET['local'], $mysqli);
                                    } elseif ($_GET['acao'] == 'alterar' && $_GET['result'] == 'true') {
                                        $result = $agendamentoDao->selectCalendar($_GET['data'], $_GET['local'], $mysqli);
                                    } elseif ($_GET['acao'] == 'deletar' && $_GET['result'] == 'true') {
                                        $result = $agendamentoDao->selectCalendar($_GET['data'], $_GET['local'], $mysqli);
                                    } elseif ($_GET['acao'] == 'selecionar') {
                                        $result = $agendamentoDao->selectCalendar($_POST["dia"], $_POST["local"], $mysqli);
                                    } elseif ($_GET['acao'] == 0) {
                                        $result = $agendamentoDao->selectCalendar(date("Y-m-d", strtotime("saturday")), $_GET["local"], $mysqli);
                                    } elseif ($_GET['acao'] == 1) {
                                        $result = $agendamentoDao->selectCalendar(date("Y-m-d", strtotime("saturday + 1 week")), $_GET["local"], $mysqli);
                                    } elseif ($_GET['acao'] == 2) {
                                        $result = $agendamentoDao->selectCalendar(date("Y-m-d", strtotime("saturday + 2 week")), $_GET["local"], $mysqli);
                                    } elseif ($_GET['acao'] == 3) {
                                        $result = $agendamentoDao->selectCalendar(date("Y-m-d", strtotime("saturday + 3 week")), $_GET["local"], $mysqli);
                                    }
                                    if ($mysqli->affected_rows == 0) {
                                        ?>
                                        <div class="panel-body text-center">
                                            <br>
                                            <span 
                                                style="color: #eee;
                                                font-size: 100px;
                                                transition: box-shadow 0.5s;" 
                                                class="glyphicon glyphicon-hdd"
                                                >
                                            </span>
                                            <br>
                                            <br>
                                            <div class="alert alert-danger" role="alert">
                                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                <span class="sr-only">Error:</span>
                                                Nenhum agendamento foi encontrado para esta data: 
                                                <?php
                                                if (empty($_POST["dia"])) {
                                                    if ($_GET["acao"] == 0) {
                                                        print date("Y-m-d", strtotime("saturday")) . " e local: " . $_GET["local"];
                                                    } elseif ($_GET["acao"] == 1) {
                                                        print date("Y-m-d", strtotime("saturday + 1 week")) . " e local: " . $_GET["local"];
                                                    } elseif ($_GET["acao"] == 2) {
                                                        print date("Y-m-d", strtotime("saturday + 2 weeks")) . " e local: " . $_GET["local"];
                                                    } elseif ($_GET["acao"] == 3) {
                                                        print date("Y-m-d", strtotime("saturday + 3 weeks")) . " e local: " . $_GET["local"];
                                                    }
                                                } else {
                                                    print $_POST["dia"]
                                                            . " e local: " .
                                                            $_POST["local"];
                                                }
                                                ?> 

                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <tr>
                                            <!--<th>#</th>-->
                                            <th>DATA</th>
                                            <th>HORA</th>
                                            <th>LOCAL</th>
                                            <th>NOIVA/ RESP_1</th>
                                            <th>NOIVO/ RESP_2</th>
                                            <th>EVENTO</th>
                                            <th>DATA EVENTO</th>
                                            <th>TELEFONE</th>
                                            <th>OBS</th>
                                            <th>ATENDIMENTO</th>
                                            <th>EDITAR</th>
                                            <th>DELETAR</th>
                                        </tr>
                                        <?php
                                        while ($tabela = mysqli_fetch_assoc($result)) {
                                            $tabelaAgendamento[] = $tabela;
                                        }
                                        foreach ($tabelaAgendamento as $key => $value) {
                                            //Ajustando a data para dd/mm/aaaa
                                            list($ano, $mes, $dia) = explode('-', $value["data"]);
                                            list($ano2, $mes2, $dia2) = explode('-', $value["data_evento"]);
                                            if ($value["atendimento"] == '0') {
                                                $atendimento = 'Aguardando ';
                                                $class = 'btn-warning';
                                                $span = 'glyphicon glyphicon-time';
                                            } elseif ($value["atendimento"] == '1') {
                                                $atendimento = 'Atendido ';
                                                $class = 'btn-info';
                                                $span = 'glyphicon glyphicon-ok-circle';
                                            } elseif($value["atendimento"] == '2') {
                                                $atendimento = 'Fechou ';
                                                $class = 'btn-success';
                                                $span = 'glyphicon glyphicon-thumbs-up';
                                            }  else {
                                                $atendimento = 'Cancelado ';
                                                $class = 'btn-danger';
                                                $span = 'glyphicon glyphicon-thumbs-down';
                                                
                                            }
                                            ?>
                                            <tr>
                                       <!--<td>1</td> -->
                                                <td><?php print $dia . '/' . $mes . '/' . $ano ?></td>
                                                <td><?= $value["hora"] ?></td>
                                                <td><?= $value["local"] ?></td>
                                                <td><?= $value["nome_1"] ?></td>
                                                <td><?= $value["nome_2"] ?></td>
                                                <td><?= $value["evento"] ?></td>
                                                <td><?php print $dia2 . '/' . $mes2 . '/' . $ano2 ?></td>
                                                <td><?= $value["telefone"] ?></td>
                                                <td><?= $value["observacao"] ?></td>
                                                <td><button type="button" class="btn btn-success <?= $class ?> btn-sm" data-toggle="modal" data-target="#atendimento_<?= $value["id"] ?>"><?= $atendimento ?><span class="<?= $span ?>"></span></button></td>
                                                <td><a href="agendamento_formulario.php?id=<?= $value["id"] ?>" class = "btn btn-primary btn-sm">Editar</a></td>
                                                <td><a href="agendamento_deletar.php?id=<?= $value["id"] ?>&data=<?= $value["data"] ?>&local=<?= $value["local"] ?>" class = "btn btn-danger btn-sm">Deletar</a></td>
                                            </tr>
                                            <!-- Modal -->
                                            <form action="agendamento_alterar.php" method="POST" role="form">
                                                <div class="modal fade" id="atendimento_<?= $value["id"] ?>" role="dialog">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Atendimento</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="id" value="<?= $value["id"] ?>">
                                                                    <input type="hidden" name="data" value="<?= $value["data"] ?>">
                                                                    <input type="hidden" name="hora" value="<?= $value["hora"] ?>">
                                                                    <input type="hidden" name="local" value="<?= $value["local"] ?>">
                                                                    <input type="hidden" name="nome1" value="<?= $value["nome_1"] ?>">
                                                                    <input type="hidden" name="nome2" value="<?= $value["nome_2"] ?>">
                                                                    <input type="hidden" name="evento" value="<?= $value["evento"] ?>">
                                                                    <input type="hidden" name="data_evento" value="<?= $value["data_evento"] ?>">
                                                                    <input type="hidden" name="telefone" value="<?= $value["telefone"] ?>">
                                                                    <label for="atendimento">Status</label>
                                                                    <select class="form-control" name="atendimento">
                                                                        <option value="0" <?php
                                                                        if ($value["atendimento"] == '0') {
                                                                            print selected;
                                                                        }
                                                                        ?>>Aguardando</option>
                                                                        <option value="1"<?php
                                                                        if ($value["atendimento"] == '1') {
                                                                            print selected;
                                                                        }
                                                                        ?>>Atendido</option>
                                                                        <option value="2"<?php
                                                                        if ($value["atendimento"] == '2') {
                                                                            print selected;
                                                                        }
                                                                        ?>>Fechou</option>
                                                                        <option value="3"<?php
                                                                        if ($value["atendimento"] == '3') {
                                                                            print selected;
                                                                        }
                                                                        ?>>Cancelado</option>
                                                                    </select>
                                                                    <br>
                                                                    <textarea rows="5" type="text" class="form-control" name="observacao" id="observacao" placeholder="Observações"><?= $value["observacao"] ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                                                                <button type="submit" class="btn btn-success">Alterar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <?php
                                        }
                                    }
                                    ?>
                                </table>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Pesquisar</h4>
                    </div>
                    <form class="form-group" name="dia" action="agendamento.php?acao=selecionar" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                    <input type="date" class="form-control input-sm" name="dia" id="dia" value="">
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                <select class="form-control input-sm" name="local">
                                    <option value="">Selecione</option>
                                    <option value="tatuape">Tatuapé</option>
                                    <option value="guarulhos">Guarulhos</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Pesquisar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </body>
    <style>

        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
            margin-left: -1px;
            -webkit-border-radius: 0 6px 6px 6px;
            -moz-border-radius: 0 6px 6px;
            border-radius: 0 6px 6px 6px;
        }

        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
        }

        .dropdown-submenu>a:after {
            display: block;
            content: " ";
            float: right;
            width: 0;
            height: 0;
            border-color: transparent;
            border-style: solid;
            border-width: 5px 0 5px 5px;
            border-left-color: #ccc;
            margin-top: 5px;
            margin-right: -10px;
        }

        .dropdown-submenu:hover>a:after {
            border-left-color: #fff;
        }

        .dropdown-submenu.pull-left {
            float: none;
        }

        .dropdown-submenu.pull-left>.dropdown-menu {
            left: -100%;
            margin-left: 10px;
            -webkit-border-radius: 6px 0 6px 6px;
            -moz-border-radius: 6px 0 6px 6px;
            border-radius: 6px 0 6px 6px;
        }
    </style>
</html>

