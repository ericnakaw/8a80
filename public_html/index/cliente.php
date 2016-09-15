<!DOCTYPE html>
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
                <h3>Consulta de Orçamento</h3>
                <?php
                $conexao = new ConnectionFactory();
                $mysqli = $conexao->get_Mysqli();
                $query = "SELECT cli.id_cliente, date_format(data_evento,'%d/%m/%Y') as data_evento, evento_tipo, rua, numero, complemento, estado, bairro, cidade, cep, observacao, id_pessoa, nome, sobrenome, email, telefone, celular, cpf, rg 
                            FROM cliente as cli 
                            LEFT JOIN pessoa as pes ON cli.id_cliente = pes.id_cliente 
                            ORDER BY id_cliente ASC";
                $result = $mysqli->query($query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                }
                $count = 0;
                foreach ($rows as $key => $value) {
                    if ($rows[$key]["id_cliente"] == $rows[$key + 1]["id_cliente"]) {
                        $tabela[$count] = $value;
                        $tabela[$count]["id_pessoa2"] = $rows[$key + 1]["id_pessoa"];
                        $tabela[$count]["nome2"] = $rows[$key + 1]["nome"];
                        $tabela[$count]["sobrenome2"] = $rows[$key + 1]["sobrenome"];
                        $tabela[$count]["email2"] = $rows[$key + 1]["email"];
                        $tabela[$count]["telefone2"] = $rows[$key + 1]["telefone"];
                        $tabela[$count]["celular2"] = $rows[$key + 1]["celular"];
                        $tabela[$count]["cpf2"] = $rows[$key + 1]["cpf"];
                        $tabela[$count]["rg2"] = $rows[$key + 1]["rg"];
                        $count++;
                    }
                }
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Lista de Clientes</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Noiva/Resp1</th>
                                    <th>Noivo/Resp2</th>
                                    <th>Evento</th>
                                    <th>Data Evento</th>
                                    <th>Endereço</th>
                                    <th>Editar</th>
                                </tr>
                                <?php
                                foreach ($tabela as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?= $value["id_cliente"] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal<?= $value["id_pessoa"] ?>"><span class="glyphicon glyphicon-info-sign"></span></button>
                                            <?= $value["nome"] ?> <?= $value["sobrenome"] ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal<?= $value["id_pessoa2"] ?>"><span class="glyphicon glyphicon-info-sign"></span></button>
                                            <?= $value["nome2"] ?> <?= $value["sobrenome2"] ?>
                                        </td>
                                        <td><?= $value["evento_tipo"] ?></td>
                                        <td><?= $value["data_evento"] ?></td>
                                        <td><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal<?= $key ?>">Endereço <span class="glyphicon glyphicon-info-sign"></span></button></td>
                                        <td>
                                            <?php
                                                list($dia,$mes,$ano)=explode("/",$value["data_evento"]);
                                                $data_evento = $dia."-".$mes."-".$ano;
                                            ?>
                                            <a href="cliente_formulario.php?id_cliente=<?= $value["id_cliente"] ?>&data_evento=<?= $data_evento ?>&evento_tipo=<?= $value["evento_tipo"] ?>&rua=<?= $value["rua"] ?>&numero=<?= $value["numero"] ?>&complemento=<?= $value["complemento"] ?>&estado=<?= $value["estado"] ?>&bairro=<?= $value["bairro"] ?>&cidade=<?= $value["cidade"] ?>&cep=<?= $value["cep"] ?>&observacao=<?= $value["observacao"] ?>&id_pessoa=<?= $value["id_pessoa"] ?>&id_pessoa2=<?= $value["id_pessoa2"] ?>&nome=<?= $value["nome"] ?>&nome2=<?= $value["nome2"] ?>&sobrenome=<?= $value["sobrenome"] ?>&sobrenome2=<?= $value["sobrenome2"] ?>&email=<?= $value["email"] ?>&email2=<?= $value["email2"] ?>&telefone=<?= $value["telefone"] ?>&telefone2=<?= $value["telefone2"] ?>&celular=<?= $value["celular"] ?>&celular2=<?= $value["celular2"] ?>&rg=<?= $value["rg"] ?>&rg2=<?= $value["rg2"] ?>&cpf=<?= $value["cpf"] ?>&cpf2=<?= $value["cpf2"] ?>" 
                                               class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="myModal<?= $key ?>" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"><?= $value["id_cliente"] ?></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <b>Endereço: </b><?= $value["rua"] ?>, <?= $value["numero"] ?> - Comp: <?= $value["complemento"] ?><br>
                                                    <?= $value["bairro"] ?> - <?= $value["cidade"] ?> - <?= $value["estado"] ?><br>
                                                    CEP: <?= $value["cep"] ?><br>
                                                    <b>OBS: </b><?= $value["observacao"] ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal fade" id="myModal<?= $value["id_pessoa"] ?>" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"><?= $value["id_pessoa"] ?></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <b>Nome:</b> <?= $value["nome"] ?> <?= $value["sobrenome"] ?><br>
                                                    <b>E-mail:</b> <?= $value["email"] ?><br>
                                                    <b>Tel:</b> <?= $value["telefone"] ?><br>
                                                    <b>Cel:</b> <?= $value["celular"] ?><br>
                                                    <b>CPF:</b> <?= $value["cpf"] ?><br>
                                                    <b>RG:</b> <?= $value["rg"] ?><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal fade" id="myModal<?= $value["id_pessoa2"] ?>" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"><?= $value["id_pessoa2"] ?></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <b>Nome:</b> <?= $value["nome2"] ?> <?= $value["sobrenome2"] ?><br>
                                                    <b>E-mail:</b> <?= $value["email2"] ?><br>
                                                    <b>Tel:</b> <?= $value["telefone2"] ?><br>
                                                    <b>Cel:</b> <?= $value["celular2"] ?><br>
                                                    <b>CPF:</b> <?= $value["cpf2"] ?><br>
                                                    <b>RG:</b> <?= $value["rg2"] ?><br>
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

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>