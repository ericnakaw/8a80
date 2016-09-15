<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
if (!isset($_SESSION)) {
    session_start();
}
$permissao = Array("gerente", "tecnico", "vendas");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("Location: login.php?msg=Sem_permisao");
    die();
}
include './header.php';
include './conexao/ConnectionFactory.php';
?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Consulta de Pedido</h3>
                <div class="row">
                    <div class="col-md-2">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pesquisar <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-toggle="modal" data-target="#myModalPedido"><span class="glyphicon glyphicon-search"></span> Pedido</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#myModalEvento"><span class="glyphicon glyphicon-search"></span> Evento</a></li>
                                <li><a href="#"data-toggle="modal" data-target="#myModalVendedor"><span class="glyphicon glyphicon-search"></span> Vendedor</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-filter"></span> Filtrar</span>
                            <input type="text" class="form-control" id="input-search" alt="lista-clientes" placeholder="Buscar nesta lista...os acentos são considerados...." />
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <?php
        $conexao = new ConnectionFactory();
        $mysqli = $conexao->get_Mysqli();
        if ($_POST["todos_pedidos"]) {
            $query = "SELECT ped.id_pedido, ped.id_funcionario, ped.id_cliente, date_format(data_pedido,'%d/%m/%Y') as data_pedido, ped.status, ped.local_venda, cli.id_cliente,date_format(data_evento,'%d/%m/%Y') data_evento, cli.evento_tipo, pes.id_pessoa AS pes_id, pes.nome AS pes_nome, pes.sobrenome AS pes_sobrenome, pes.email AS pes_email, pes.celular AS pes_celular, fun.nome AS func_nome, fun.sobrenome AS func_sobrenome 
                        FROM pedido AS ped 
                        LEFT JOIN cliente AS cli ON ped.id_cliente = cli.id_cliente 
                        LEFT JOIN pessoa AS pes ON ped.id_cliente = pes.id_cliente 
                        LEFT JOIN funcionario AS fun ON ped.id_funcionario = fun.id 
                        WHERE {$_POST["todos_pedidos"]} 
                        ORDER BY ped.id_pedido, pes_id ASC";
            $result = $mysqli->query($query);
        }
        if ($_POST["cod_pedido"]) {
            $query = "SELECT ped.id_pedido, ped.id_funcionario, ped.id_cliente, date_format(data_pedido,'%d/%m/%Y') as data_pedido, ped.status, ped.local_venda, cli.id_cliente,date_format(data_evento,'%d/%m/%Y') data_evento, cli.evento_tipo, pes.id_pessoa AS pes_id, pes.nome AS pes_nome, pes.sobrenome AS pes_sobrenome, pes.email AS pes_email, pes.celular AS pes_celular, fun.nome AS func_nome, fun.sobrenome AS func_sobrenome 
                        FROM pedido AS ped 
                        LEFT JOIN cliente AS cli ON ped.id_cliente = cli.id_cliente 
                        LEFT JOIN pessoa AS pes ON ped.id_cliente = pes.id_cliente 
                        LEFT JOIN funcionario AS fun ON ped.id_funcionario = fun.id 
                        WHERE ped.id_pedido = {$_POST["cod_pedido"]} 
                        ORDER BY ped.id_pedido, pes_id ASC";
            $result = $mysqli->query($query);
        }
        if ($_POST["cod_cliente"]) {
            $query = "SELECT ped.id_pedido, ped.id_funcionario, ped.id_cliente, date_format(data_pedido,'%d/%m/%Y') as data_pedido, ped.status, ped.local_venda, cli.id_cliente, date_format(data_evento,'%d/%m/%Y') data_evento, cli.evento_tipo, pes.id_pessoa AS pes_id, pes.nome AS pes_nome, pes.sobrenome AS pes_sobrenome, pes.email AS pes_email, pes.celular AS pes_celular, fun.nome AS func_nome, fun.sobrenome AS func_sobrenome
                    FROM pessoa AS pes
                    LEFT JOIN cliente AS cli ON pes.id_cliente = cli.id_cliente
                    LEFT JOIN pedido AS ped ON pes.id_cliente = ped.id_cliente
                    LEFT JOIN funcionario AS fun ON ped.id_funcionario = fun.id
                    WHERE pes.id_cliente ={$_POST["cod_cliente"]}
                    ORDER BY ped.id_pedido, pes_id ASC ";
            $result = $mysqli->query($query);
        }
        if ($_POST["email_1"]) {
            $query = "SELECT email, id_cliente FROM pessoa WHERE email = '{$_POST["email_1"]}'";
            $result1 = $mysqli->query($query);
            while ($tabelaPessoa = mysqli_fetch_assoc($result1)) {
                $query = "SELECT ped.id_pedido, ped.id_funcionario, ped.id_cliente, date_format(data_pedido,'%d/%m/%Y') as data_pedido, ped.status, ped.local_venda, cli.id_cliente, date_format(data_evento,'%d/%m/%Y') data_evento, cli.evento_tipo, pes.id_pessoa AS pes_id, pes.nome AS pes_nome, pes.sobrenome AS pes_sobrenome, pes.email AS pes_email, pes.celular AS pes_celular, fun.nome AS func_nome, fun.sobrenome AS func_sobrenome
                    FROM pessoa AS pes
                    LEFT JOIN cliente AS cli ON pes.id_cliente = cli.id_cliente
                    LEFT JOIN pedido AS ped ON pes.id_cliente = ped.id_cliente
                    LEFT JOIN funcionario AS fun ON ped.id_funcionario = fun.id
                    WHERE pes.id_cliente ={$tabelaPessoa["id_cliente"]}
                    ORDER BY ped.id_pedido, pes_id ASC ";
                $result2[] = $mysqli->query($query);
            }
        }
        if ($_POST["celular_1"]) {
            $query = "SELECT celular, id_cliente
                FROM pessoa WHERE celular LIKE '%{$_POST["celular_1"]}%'";
            $result1 = $mysqli->query($query);
            while ($tabelaPessoa = mysqli_fetch_assoc($result1)) {
                $query = "SELECT ped.id_pedido, ped.id_funcionario, ped.id_cliente, date_format(data_pedido,'%d/%m/%Y') as data_pedido, ped.status, ped.local_venda, cli.id_cliente, date_format(data_evento,'%d/%m/%Y') data_evento, cli.evento_tipo, pes.id_pessoa AS pes_id, pes.nome AS pes_nome, pes.sobrenome AS pes_sobrenome, pes.email AS pes_email, pes.celular AS pes_celular, fun.nome AS func_nome, fun.sobrenome AS func_sobrenome
                    FROM pessoa AS pes
                    LEFT JOIN cliente AS cli ON pes.id_cliente = cli.id_cliente
                    LEFT JOIN pedido AS ped ON pes.id_cliente = ped.id_cliente
                    LEFT JOIN funcionario AS fun ON ped.id_funcionario = fun.id
                    WHERE pes.id_cliente ={$tabelaPessoa["id_cliente"]}
                    ORDER BY ped.id_pedido, pes_id ASC ";
                $result2[] = $mysqli->query($query);
            }
        }
        if ($_POST["nome_1"]) {
            $query = "SELECT nome, id_cliente
                        FROM pessoa
                        WHERE nome LIKE  '%{$_POST["nome_1"]}%'";
            $result1 = $mysqli->query($query);
            while ($tabelaPessoa = mysqli_fetch_assoc($result1)) {
                $query = "SELECT ped.id_pedido, ped.id_funcionario, ped.id_cliente, date_format(data_pedido,'%d/%m/%Y') as data_pedido, ped.status, ped.local_venda, cli.id_cliente, date_format(data_evento,'%d/%m/%Y') data_evento, cli.evento_tipo, pes.id_pessoa AS pes_id, pes.nome AS pes_nome, pes.sobrenome AS pes_sobrenome, pes.email AS pes_email, pes.celular AS pes_celular, fun.nome AS func_nome, fun.sobrenome AS func_sobrenome
                    FROM pessoa AS pes
                    LEFT JOIN cliente AS cli ON pes.id_cliente = cli.id_cliente
                    LEFT JOIN pedido AS ped ON pes.id_cliente = ped.id_cliente
                    LEFT JOIN funcionario AS fun ON ped.id_funcionario = fun.id
                    WHERE pes.id_cliente ={$tabelaPessoa["id_cliente"]}
                    ORDER BY ped.id_pedido, pes_id ASC ";
                $result2[] = $mysqli->query($query);
            }
        }
        if ($_POST["evento"]) {
            if ($_POST["data_evento"]) {
                $date = date_format(date_create($_POST["data_evento"]), "Y-m-d");
            }
            $query = "SELECT id_cliente, data_evento, evento_tipo FROM cliente 
                        WHERE data_evento = '{$date}'
                        AND evento_tipo = '{$_POST["evento"]}'";
            $result1 = $mysqli->query($query);
            while ($tabelaPessoa = mysqli_fetch_assoc($result1)) {
                $query = "SELECT ped.id_pedido, ped.id_funcionario, ped.id_cliente, date_format(data_pedido,'%d/%m/%Y') as data_pedido, ped.status, ped.local_venda, cli.id_cliente, date_format(data_evento,'%d/%m/%Y') data_evento, cli.evento_tipo, pes.id_pessoa AS pes_id, pes.nome AS pes_nome, pes.sobrenome AS pes_sobrenome, pes.email AS pes_email, pes.celular AS pes_celular, fun.nome AS func_nome, fun.sobrenome AS func_sobrenome
                    FROM pessoa AS pes
                    LEFT JOIN cliente AS cli ON pes.id_cliente = cli.id_cliente
                    LEFT JOIN pedido AS ped ON pes.id_cliente = ped.id_cliente
                    LEFT JOIN funcionario AS fun ON ped.id_funcionario = fun.id
                    WHERE pes.id_cliente ={$tabelaPessoa["id_cliente"]}
                    ORDER BY ped.id_pedido, pes_id ASC ";
                $result2[] = $mysqli->query($query);
            }
        }
        if ($_POST["id_funcionario"]) {
            $query = "SELECT ped.id_pedido, ped.id_funcionario, ped.id_cliente, date_format(data_pedido,'%d/%m/%Y') as data_pedido, ped.status, ped.local_venda, cli.id_cliente,date_format(data_evento,'%d/%m/%Y') data_evento, cli.evento_tipo, pes.id_pessoa AS pes_id, pes.nome AS pes_nome, pes.sobrenome AS pes_sobrenome, pes.email AS pes_email, pes.celular AS pes_celular, fun.nome AS func_nome, fun.sobrenome AS func_sobrenome 
                        FROM pedido AS ped 
                        LEFT JOIN cliente AS cli ON ped.id_cliente = cli.id_cliente 
                        LEFT JOIN pessoa AS pes ON ped.id_cliente = pes.id_cliente 
                        LEFT JOIN funcionario AS fun ON ped.id_funcionario = fun.id 
                        WHERE ped.id_funcionario = {$_POST["id_funcionario"]} 
                        ORDER BY ped.id_pedido, pes_id ASC";
            $result = $mysqli->query($query);
        }
        if ($_POST["funcionario"]) {
            $query = "SELECT nome, id FROM funcionario WHERE nome = '{$_POST["funcionario"]}'";
            $resultFuncionario = $mysqli->query($query);
            $tabelaFuncionario = mysqli_fetch_assoc($resultFuncionario);
            $query = "SELECT ped.id_pedido, ped.id_funcionario, ped.id_cliente, date_format(data_pedido,'%d/%m/%Y') as data_pedido, ped.status, ped.local_venda, cli.id_cliente, date_format(data_evento,'%d/%m/%Y') data_evento, cli.evento_tipo, pes.id_pessoa AS pes_id, pes.nome AS pes_nome, pes.sobrenome AS pes_sobrenome, pes.email AS pes_email, pes.celular AS pes_celular, fun.nome AS func_nome, fun.sobrenome AS func_sobrenome
                    FROM pessoa AS pes
                    LEFT JOIN cliente AS cli ON pes.id_cliente = cli.id_cliente
                    LEFT JOIN pedido AS ped ON pes.id_cliente = ped.id_cliente
                    LEFT JOIN funcionario AS fun ON ped.id_funcionario = fun.id
                    WHERE ped.id_funcionario ={$tabelaFuncionario["id"]}
                    ORDER BY ped.id_pedido, pes_id ASC ";
            $result = $mysqli->query($query);
        }
        if (!empty($result2)) {
            foreach ($result2 as $key => $value) {
                while ($tabela = mysqli_fetch_assoc($value)) {
                    $pedidos[] = $tabela;
                }
            }
        } else {
            while ($tabela = mysqli_fetch_assoc($result)) {
                $pedidos[] = $tabela;
            }
        }
//        print '<pre>';
//        var_dump($pedidos);
//        print '</pre>';
        //die();
        $count = 0;
        foreach ($pedidos as $key => $value) {
            if ($pedidos[$key]["id_pedido"] !== NULL && $pedidos[$key]["id_pedido"] == $pedidos[$key + 1]["id_pedido"] && $pedidos[$key]["id_cliente"] == $pedidos[$key + 1]["id_cliente"]) {
                $pedido[$count] = $value;
                $pedido[$count]["pes_id2"] = $pedidos[$key + 1]["pes_id"];
                $pedido[$count]["pes_nome2"] = $pedidos[$key + 1]["pes_nome"];
                $pedido[$count]["pes_sobrenome2"] = $pedidos[$key + 1]["pes_sobrenome"];
                $pedido[$count]["pes_email2"] = $pedidos[$key + 1]["pes_email"];
                $pedido[$count]["pes_celular2"] = $pedidos[$key + 1]["pes_celular"];
                $count++;
            }
        }

        if ($pedido == NULL) {
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-list"></span> PEDIDO 
                        </div>
                        <!-- /.panel-heading -->
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
                                Nenhum pedido foi encontrado
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-list-alt"></span> PEDIDO [<?= $count ?> resultado(s) encontrado(s)]
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <div class="dataTable_wrapper">
                                <div class="table-responsive">
                                    <table class="lista-clientes table table-striped table-bordered table-hover table-condensed" id="tabela">
                                        <thead>
                                            <tr>
                                                <th>PEDIDO</th>
                                                <th>FUNC</th>
                                                <th>DATA_SOLIC</th>
                                                <th>CLIENTE</th>
                                                <th>EVENTO</th>
                                                <th>DATA_EVENTO</th>
                                                <th>LOCAL_VENDA</th>
                                                <th>STATUS</th>
                                                <th>VISUALIZAR</th>
                                            </tr>
                                        </thead>
                                        <tbody><?php
                                            foreach ($pedido as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td class="text-uppercase">Nº <?= $value["id_pedido"] ?></td>
                                                    <td class="text-uppercase"><?= $value["func_nome"] ?> <?= $value["func_sobrenome"] ?></td>
                                                    <td class="text-uppercase"><?= $value["data_pedido"] ?></td>
                                                    <td class="text-uppercase">
                                                        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal<?= $key ?>"><span class="glyphicon glyphicon-info-sign"></button>
                                                        <?= $value["pes_nome"] ?> <?= $value["pes_sobrenome"] ?>
                                                        e
                                                        <?= $value["pes_nome2"] ?> <?= $value["pes_sobrenome"] ?>
                                                    </td>
                                                    <td class="text-uppercase"><?= $value["evento_tipo"] ?></td>
                                                    <td class="text-uppercase"><?= $value["data_evento"] ?></td>
                                                    <td class="text-uppercase"><?= $value['local_venda'] ?></td>
                                                    <td class="text-uppercase"><?php
                                                        if ($value["status"] == 1) {
                                                            print "ativo";
                                                        } else {
                                                            print "cancelado";
                                                        }
                                                        ?></td>
                                                    <td class="text-center text-uppercase"><a href="pedido_realizado.php?pedido_id=<?= $value["id_pedido"] ?>"  target="_blank"  class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                                                </tr>
                                                <!-- Modal Cliente-->
                                            <div id="myModal<?= $key ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Cliente ID: <?= $value["id_cliente"] ?></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-group">
                                                                <li class="list-group-item">
                                                                    <b>Nome:</b> <?= $value["pes_nome"] ?> <?= $value["pes_sobrenome"] ?>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>E-mail:</b> <?= $value["pes_email"] ?>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Cel:</b> <?= $value["pes_celular"] ?>
                                                                </li>
                                                            </ul>
                                                            <ul class="list-group">
                                                                <li class="list-group-item">
                                                                    <b>Nome:</b> <?= $value["pes_nome2"] ?> <?= $value["pes_sobrenome2"] ?>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>E-mail:</b> <?= $value["pes_email2"] ?>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Cel:</b> <?= $value["pes_celular2"] ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</body>
<!-- Modal -->
<div class="modal fade" id="myModalPedido" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pedido</h4>
            </div>
            <div class="modal-body"> 
                <form class="form-inline" name="consultar_todos_pedidos" action="consultar_pedido.php" method="POST">
                    <div class="form-group">
                        <div class="input-group">
                            <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-search"></span> Todos os Pedidos</button>
                            <input type="hidden" class="form-control input-sm" name="todos_pedidos" id="todos_pedidos" value="1">
                        </div>
                    </div>
                </form>                            
                <br>
                <form class="form-inline" name="consultar_cod_pedido" action="consultar_pedido.php" method="POST">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-barcode"></span></div>
                            <input type="number" class="form-control input-sm" name="cod_pedido" id="cod_pedido" placeholder="Nº Pedido" value="<?= $_POST["cod_pedido"] ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm" onclick="return valida_cod_pedido()"><span class="glyphicon glyphicon-search"></span></button>
                </form>                            
                <br>
                <form class="form-inline" name="consultar_cod_cliente" action="consultar_pedido.php" method="POST">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-barcode"></span></div>
                            <input type="number" class="form-control input-sm" name="cod_cliente" id="cod_cliente" placeholder="Código do Cliente" value="<?= $_POST["cod_cliente"] ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm" onclick="return valida_cod_cliente()"><span class="glyphicon glyphicon-search"></span></button>
                </form>                            
                <br>
                <form class="form-inline" name="consultar_email_1" action="consultar_pedido.php" method="POST">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">@</div>
                            <input type="email" class="form-control input-sm" name="email_1" id="email_1" placeholder="E-mail" value="<?= $_POST["email_1"] ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm" onclick="return valida_email_1()"><span class="glyphicon glyphicon-search"></span></button>
                </form>
                <br>
                <form class="form-inline" name="consultar_celular_1" action="consultar_pedido.php" method="POST">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></div>
                            <input type="text" class="form-control input-sm" name="celular_1" id="telefone_1" placeholder="Celular" value="<?= $_POST["celular_1"] ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm" onclick="return valida_celular_1()"><span class="glyphicon glyphicon-search"></span></button>
                </form>
                <br>
                <form name="consultar_nome" class="form-inline" action="consultar_pedido.php" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control input-sm" name="nome_1" placeholder="1º Nome" value="<?= $_POST["nome_1"] ?>">
                    </div>
                    <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-search"></span></button>
                    <!--                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                                        <input type="text" class="form-control" name="nome_2" placeholder="Noivo / 2º Responsável">   
                                                    </div>-->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModalEvento" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Evento</h4>
            </div>
            <div class="modal-body">
                <form name="consultar_evento" class="form-inline" action="consultar_pedido.php" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-star"></span></span>
                        <select name="evento" id="evento" class="form-control input-sm">
                            <option value="">Selecione o Evento</option>
                            <option value="casamento" <?php
                            if ($_POST["evento"] == "casamento") {
                                print 'selected';
                            }
                            ?>>Casamento</option>
                            <option value="debutante" <?php
                            if ($_POST["evento"] == "debutante") {
                                print 'selected';
                            }
                            ?>>Debutante</option>
                            <option value="aniversario" <?php
                            if ($_POST["evento"] == "aniversario") {
                                print 'selected';
                            }
                            ?>>Aniversário</option>
                            <option value="corporativo"<?php
                            if ($_POST["evento"] == "corporativo") {
                                print 'selected';
                            }
                            ?>>Corporativo</option>
                            <option value="outros"<?php
                            if ($_POST["evento"] == "outros") {
                                print 'selected';
                            }
                            ?>>Outros</option>
                        </select>
                    </div><br><br>
                    <div class="input-group"> 
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type="date" class="form-control input-sm" name="data_evento" value="<?= $_POST["data_evento"] ?>" placeholder="Ex: dd-mm-aaaa">    
                    </div>
                    <button  type="submit" class="btn btn-success btn-sm" onclick="return valida_evento()"><span class="glyphicon glyphicon-search"></span></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModalVendedor" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Vendedor</h4>
            </div>
            <div class="modal-body">
                <form name="consultar_id_funcionario" class="form-inline" action="consultar_pedido.php" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="number" class="form-control input-sm" name="id_funcionario" placeholder="ID do vendedor" value="<?= $_POST["id_funcionario"] ?>" >
                    </div>
                    <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-search"></span></button>
                </form>
                <br>
                <form name="consultar_nome_funcionario" class="form-inline" action="consultar_pedido.php" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control input-sm" name="funcionario" placeholder="Nome do vendedor" value="<?= $_POST["funcionario"] ?>" >
                    </div>
                    <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-search"></span></button>
                </form>
            </div>  
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/tabela_buscar.js"></script>
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script>
            function valida_cod_pedido {
            var cod_cliente = document.forms["consultar_cod_pedido"]["cod_pedido"].value;
                    if (cod_pedido == null || cod_pedido == "") {
            alert("Preencha o código do pedido");
                    return false;
            }
            }
    function valida_cod_cliente() {
    var cod_cliente = document.forms["consultar_cod_cliente"]["cod_cliente"].value;
            if (cod_cliente == null || cod_cliente == "") {
    alert("Preencha o código do cliente");
            return false;
    }
    }
    function valida_email_1() {
    var email_1 = document.forms["consultar_email_1"]["email_1"].value;
            if (email_1 == null || email_1 == "") {
    alert("Preencha o e-mail");
            return false;
    }
    }
    function valida_celular_1() {
    var celular_1 = document.forms["consultar_celular_1"]["celular_1"].value;
            if (celular_1 == null || celular_1 == "") {
    alert("Preencha o celular *Somente números*");
            return false;
    }
    }
    function valida_evento() {
    var evento = document.forms["consultar_evento"]["evento"].value;
            var data_evento = document.forms["consultar_evento"]["data_evento"].value;
            if (evento == null || evento == "") {
    alert("Selecione o evento");
            return false;
    }
    if (data_evento == null || data_evento == "") {
    alert("Preencha a data do evento");
            return false;
    }
    }
    function valida_nome() {
    var nome_1 = document.forms["consultar_nome"]["nome_1"].value;
            var nome_2 = document.forms["consultar_nome"]["nome_2"].value;
            if (nome_1 == null || nome_1 == "") {
    alert("Preencha o nome da noiva ou 1º responsável ");
            return false;
    }
    if (nome_2 == null || nome_2 == "") {
    alert("Preencha o nome do noivo ou 2º responsável ");
            return false;
    }
    }
</script>