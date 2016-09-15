<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulário Agendamento</title>
    </head>
    <body>
        <?php
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
        if (!isset($_SESSION)) {
            session_start();
        }
        include './conexao/ConnectionFactory.php';
        include './dao/AgendamentoDao.php';
        include './header.php';
        $permissao = Array("gerente", "tecnico", "vendas");
        if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
            header("location: login.php?msg=Sem_permisao");
            die();
        }
        if (empty($_GET["id"])) {
            $id = "";
            $nome1 = ""; 
            $nome2 = "";
            !empty($_GET["evento"]) ? $evento = $_GET["evento"] : $evento = "";
            !empty($_GET["data"]) ? $data = $_GET["data"] : $data = "";
            $hora = "";
            !empty($_GET["local"]) ? $local = $_GET["local"] : $local = "";
            $data_evento = "";
            $telefone = "";
            $observacao = "";
            $atendimento = "";
            $botao = "Inserir";
            $pageName = "Novo Agendamento";
            $acao = "agendamento_inserir.php";
        } else {
            $connectionFactory = new ConnectionFactory();
            $mysqli = $connectionFactory->get_Mysqli();
            $agendamentoDao = new AgendamentoDao();
            $tabelaAgendamento = $agendamentoDao->select($_GET["id"], $mysqli);
            $id = $tabelaAgendamento["id"];
            $nome1 = $tabelaAgendamento["nome_1"];
            $nome2 = $tabelaAgendamento["nome_2"];
            $evento = $tabelaAgendamento["evento"];
            $data = $tabelaAgendamento["data"];
            list($h, $m) = explode(":", $tabelaAgendamento["hora"]);
            $hora = $h . ":" . $m;
            $local = $tabelaAgendamento["local"];
            $data_evento = $tabelaAgendamento["data_evento"];
            $telefone = $tabelaAgendamento["telefone"];
            $observacao = $tabelaAgendamento["observacao"];
            $atendimento = $tabelaAgendamento["atendimento"];
            $botao = "Alterar";
            $pageName = "Alterar Agendamento";
            $acao = "agendamento_alterar.php";
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">NOVO AGENDAMENTO</div>
                        <div class="panel-body">
                            <form action="<?= $acao ?>" method="POST" role="form">
                                <div class="row">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <input type="hidden" name="atendimento" value="<?= $atendimento ?>">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nome1">Noiva / Resp 1:
                                            </label>
                                            <input type="text" class="form-control" value= "<?= $nome1 ?>" name="nome1" id="nome1" placeholder="Noiva ou Responsável">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nome2">Noivo / Resp 2:
                                            </label>
                                            <input type="text" class="form-control" value= "<?= $nome2 ?>" name="nome2" id="nome2"  placeholder="Noivo ou Responsável">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="evento">Evento:
                                            </label>
                                            <select name="evento" class="form-control">
                                                <option value="">SELECIONE</option>
                                                <option value="casamento" <?php
                                                if ($evento == "casamento") {
                                                    print "selected";
                                                }
                                                ?>>Casamento</option>
                                                <option value="debutante" <?php
                                                if ($evento == "debutante") {
                                                    print "selected";
                                                }
                                                ?>>Debutante</option>
                                                <option value="aniversario" <?php
                                                if ($evento == "aniversario") {
                                                    print "selected";
                                                }
                                                ?>>Aniversário</option>
                                                <option value="corporativo" <?php
                                                if ($evento == "corporativo") {
                                                    print "selected";
                                                }
                                                ?>>Corporativo</option>
                                                <option value="outros" <?php
                                                if ($evento == "outros") {
                                                    print "selected";
                                                }
                                                ?>>Outros</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="data">Data:</label>
                                            <input type="date" class="form-control" value= "<?= $data ?>" name="data" id="data">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="hora">Hora:
                                            </label>
                                            <select name="hora" class="form-control">
                                                <option value="">SELECIONE</option>
                                                <option value="08:00" <?php
                                                if ($hora == "08:00") {
                                                    print "selected";
                                                }
                                                ?>>8:00</option>
                                                <!--                                                <option value="08:30" <?php
                                                if ($hora == "08:30") {
                                                    print "selected";
                                                }
                                                ?>>8:30</option>-->
                                                <option value="09:00" <?php
                                                if ($hora == "09:00") {
                                                    print "selected";
                                                }
                                                ?>>9:00</option>
                                                <!--                                                <option value="09:30" <?php
                                                if ($hora == "09:30") {
                                                    print "selected";
                                                }
                                                ?>>9:30</option>-->
                                                <option value="10:00" <?php
                                                if ($hora == "10:00") {
                                                    print "selected";
                                                }
                                                ?>>10:00</option>
                                                <!--                                                <option value="10:30" <?php
                                                if ($hora == "10:30") {
                                                    print "selected";
                                                }
                                                ?>>10:30</option>-->
                                                <option value="11:00" <?php
                                                if ($hora == "11:00") {
                                                    print "selected";
                                                }
                                                ?>>11:00</option>
                                                <!--                                                <option value="11:30" <?php
                                                if ($hora == "11:30") {
                                                    print "selected";
                                                }
                                                ?>>11:30</option>-->
                                                <option value="12:00" <?php
                                                if ($hora == "12:00") {
                                                    print "selected";
                                                }
                                                ?>>12:00</option>
                                                <!--                                                <option value="12:30" <?php
                                                if ($hora == "12:30") {
                                                    print "selected";
                                                }
                                                ?>>12:30</option>-->
                                                <option value="13:00" <?php
                                                if ($hora == "13:00") {
                                                    print "selected";
                                                }
                                                ?>>13:00</option>
                                                <!--                                                <option value="13:30" <?php
                                                if ($hora == "13:30") {
                                                    print "selected";
                                                }
                                                ?>>13:30</option>-->
                                                <option value="14:00" <?php
                                                if ($hora == "14:00") {
                                                    print "selected";
                                                }
                                                ?>>14:00</option>
                                                <!--                                                <option value="14:30" <?php
                                                if ($hora == "14:30") {
                                                    print "selected";
                                                }
                                                ?>>14:30</option>-->
                                                <option value="15:00" <?php
                                                if ($hora == "15:00") {
                                                    print "selected";
                                                }
                                                ?>>15:00</option>
                                                <!--                                                <option value="15:30" <?php
                                                if ($hora == "15:30") {
                                                    print "selected";
                                                }
                                                ?>>15:30</option>-->
                                                <option value="16:00" <?php
                                                if ($hora == "16:00") {
                                                    print "selected";
                                                }
                                                ?>>16:00</option>
                                                <!--                                                <option value="16:30" <?php
                                                if ($hora == "16:30") {
                                                    print "selected";
                                                }
                                                ?>>16:30</option>-->
                                                <option value="17:00" <?php
                                                if ($hora == "17:00") {
                                                    print "selected";
                                                }
                                                ?>>17:00</option>
                                                <!--                                                <option value="17:30" <?php
                                                if ($hora == "17:30") {
                                                    print "selected";
                                                }
                                                ?>>17:30</option>-->
                                                <option value="18:00" <?php
                                                if ($hora == "18:00") {
                                                    print "selected";
                                                }
                                                ?>>18:00</option>
                                                <!--                                                <option value="18:30" <?php
                                                if ($hora == "18:30") {
                                                    print "selected";
                                                }
                                                ?>>18:30</option>-->
                                                <option value="19:00" <?php
                                                if ($hora == "19:00") {
                                                    print "selected";
                                                }
                                                ?>>19:00</option>
                                                <!--                                                <option value="19:30" <?php
                                                if ($hora == "19:30") {
                                                    print "selected";
                                                }
                                                ?>>19:30</option>-->
                                                <option value="20:00" <?php
                                                if ($hora == "20:00") {
                                                    print "selected";
                                                }
                                                ?>>20:00</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="local">Loja:
                                            </label>
                                            <select name="local" class="form-control">
                                                <option value="">SELECIONE</option>
                                                <option value="tatuape" <?php
                                                if ($local == "tatuape") {
                                                    print "selected";
                                                }
                                                ?>>Loja Tatuapé</option>
                                                <option value="guarulhos" <?php
                                                if ($local == "guarulhos") {
                                                    print "selected";
                                                }
                                                ?>>Loja Guarulhos</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="data_evento">Data do evento:
                                            </label>
                                            <input type="date" class="form-control" value= "<?= $data_evento ?>" name="data_evento" id="data_evento">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="telefone">Telefone:
                                            </label>
                                            <input type="text" class="form-control" value= "<?= $telefone ?>" name="telefone" id="telefone" placeholder="Telefone para contato">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="observacao">Observação:
                                            </label>
                                            <textarea type="text" class="form-control" name="observacao" id="observacao" placeholder="Observações"><?= $observacao ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-10">

                                    </div>
                                    <div class="col-md-2">
                                        <a href="agendamento.php" class="btn btn-default">Voltar</a>
                                        <button class="btn btn-success"><?= $botao ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        // Validador do Formulario
        function valida() {
            if ($("#nomeAcabamento").val() === "") {
                alert('preencha o nome do acabamento');
                $("#nomeAcabamento").focus();
                return false;
            }
            if ($("#valorAcabamento").val() === "") {
                alert('preencha o valor do acabamento');
                $("#valorAcabamento").focus();
                return false;
            }
        }
    </script>
</html>
