<?php
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Carrinho";
$permissao = Array("gerente", "tecnico", "vendas");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}
$action = isset($_GET['action']) ? $_GET['action'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : "";
include './header.php';
include './conexao/Conexao.php';
?>
<script type="text/javascript" src="js/orcamento_carrinho.js"></script>
<script>
    function valida_orcamento() {
        var evento = document.forms["preAtendimento"]["evento"].value;
        var data_evento = document.forms["preAtendimento"]["data_evento"].value;
        var nome = document.forms["preAtendimento"]["nome"].value;
//        var email = document.forms["preAtendimento"]["email"].value;
        var localVenda = document.forms["preAtendimento"]["localVenda"].value;
        var tipo_solicitacao = document.forms["preAtendimento"]["tipo_solicitacao"].value;
        var nome2 = document.forms["preAtendimento"]["nome2"].value;
//        var email2 = document.forms["preAtendimento"]["email2"].value;
        if (evento == null || evento == "") {
            alert("Preencha o evento");
            return false;
        }
//        if (data_evento == null || data_evento == "") {
//            alert("Preencha a data");
//            return false;
//        }
        if (nome == null || nome == "") {
            alert("Preencha o nome do responsável 1");
            return false;
        }
//        if (email == null || email == "") {
//            alert("Preencha o email do responsável 1");
//            return false;
//        }
        if (localVenda == null || localVenda == "") {
            alert("Preencha o local da venda");
            return false;
        }
        if (tipo_solicitacao == null || tipo_solicitacao == "") {
            alert("Preencha o tipo da solicitacao");
            return false;
        }
//        if (nome2 == null || nome2 == "") {
//            alert("Preencha o nome do responsável 2");
//            return false;
//        }
//        if (email2 == null || email2 == "") {
//            alert("Preencha o email do responsável 2");
//            return false;
//        }
    }
</script>
<body>
    <form name="preAtendimento" class="form-horizontal" action="orcamento_cliente_salvar.php" method="POST" onsubmit="return valida_orcamento()">
        <div class="wrapper" role="main">
            <div class="container">
                <div class="row">
                    <div id="conteudo" class="col-md-12">
                        <div id="orcamento_carrinho_resumo">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-9"><h4><span class="glyphicon glyphicon-list"></span> Orçamento</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="btn-group">
                                                    <a class="btn btn-group btn-warning" href="orcamento_cliente_salvar.php?acao=limpar_pre_atendimento">Limpar</a>
                                                    <button type="submit" class="btn btn-success btn-group">Próximo</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-4">
                                        <div class="col-md-12">
                                            <br>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <span class="glyphicon glyphicon-globe"></span><b> Geral</b>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="col-md-12">
                                                        <label for="localVenda">Local de Venda:</label>
                                                        <select name="localVenda" class="form-control input-sm">
                                                            <option value="">Selecione</option>
                                                            <option value="tatuape" <?php
                                                            if ($_SESSION['local_venda'] == "tatuape") { 
                                                                print 'selected';
                                                            }
                                                            ?>>Loja Tatuapé</option>
                                                            <option value="guarulhos" <?php
                                                            if ($_SESSION['local_venda'] == "guarulhos") {
                                                                print 'selected';
                                                            }
                                                            ?>>Loja Guarulhos</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="tipo_solicitacao">Tipo de Solicitação:</label>
                                                        <select name="tipo_solicitacao" class="form-control input-sm">
                                                            <option value="">Selecione</option>
                                                            <option value="orcamento"<?php
                                                            if ($_SESSION['cliente']['tipo_solicitacao'] == "orcamento") {
                                                                print 'selected';
                                                            }
                                                            ?>>Orcamento</option>
                                                            <option value="pedido" <?php
                                                            if ($_SESSION['cliente']['tipo_solicitacao'] == "pedido") {
                                                                print 'selected';
                                                            }
                                                            ?>>Pedido</option>
                                                        </select>
                                                    </div>
                                                </div>  
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="col-md-12">
                                            <br>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <span class="glyphicon glyphicon-pushpin"></span><b> Evento</b>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="col-md-12">
                                                        <label for="evento"> Evento:</label>
                                                        <select name="evento" id="evento" class="form-control input-sm">
                                                            <option value="">Selecione um evento</option>
                                                            <option value="casamento" <?php
                                                            if ($_SESSION['cliente']["evento"] === "casamento") {
                                                                print 'selected';
                                                            }
                                                            ?>>Casamento</option>
                                                            <option value="debutante" <?php
                                                            if ($_SESSION['cliente']["evento"] === "debutante") {
                                                                print 'selected';
                                                            }
                                                            ?>>Debutante</option>
                                                            <option value="aniversario" <?php
                                                            if ($_SESSION['cliente']["evento"] === "aniversario") {
                                                                print 'selected';
                                                            }
                                                            ?>>Aniversário</option>
                                                            <option value="corporativo" <?php
                                                            if ($_SESSION['cliente']["evento"] === "corporativo") {
                                                                print 'selected';
                                                            }
                                                            ?>>Corporativo</option>
                                                            <option value="outros" <?php
                                                            if ($_SESSION['cliente']["evento"] === "outros") {
                                                                print 'selected';
                                                            }
                                                            ?>>Outros</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="localVenda">Data Evento:</label>
                                                        <input type="date" name="data_evento" placeholder="Ex: 20-12-2015" id="data_evento" class="form-control input-sm" value="<?= $_SESSION['cliente']["data_evento"] ?>">
                                                    </div>

                                                </div>  
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="col-md-12">
                                            <br>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <span class="glyphicon glyphicon-user"></span><b> Cliente</b>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="col-md-12">
                                                        <label for="nome"><span class="glyphicon glyphicon-user"></span> Noiva / Resp 1:</label>
                                                        <input type="text" name="nome" id="nome" placeholder="Nome: Noiva / Responsável" class="form-control input-sm" value="<?= $_SESSION['cliente']["nome"] ?>">
                                                    </div>
                                                    <!--                                                    <div class="col-md-12">
                                                                                                            <label for="emailResponsavel"><span class="glyphicon glyphicon-envelope"></span> Email:</label>
                                                                                                            <input type="email" name="email" id="email" placeholder="E-mail para busca no banco de dados" class="form-control input-sm" value="<?= $_SESSION['cliente']["email"] ?>">
                                                                                                        </div>-->
                                                    <div class="col-md-12">
                                                        <label for="nome2"><span class="glyphicon glyphicon-user"></span> Noivo / Resp 2:</label>
                                                        <input type="text" name="nome2" id="nome2" placeholder="Nome: Noivo / Aniversáriante" class="form-control input-sm" value="<?= $_SESSION['cliente']["nome2"] ?>">
                                                    </div>
                                                    <!--                                                    <div class="col-md-12">
                                                                                                            <label for="emailResponsavel"><span class="glyphicon glyphicon-envelope"></span> Email:</label>
                                                                                                            <input type="email" name="email2" id="email2" placeholder="E-mail para busca no banco de dados" class="form-control input-sm" value="<?= $_SESSION['cliente']["email2"] ?>">
                                                                                                        </div>-->
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                </div>
            </div>
    </form>
</body>