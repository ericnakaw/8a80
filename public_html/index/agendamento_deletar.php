<?php
include './conexao/ConnectionFactory.php';
include './objeto/Agendamento.php';
include './dao/AgendamentoDao.php';
$connectionFactory = new ConnectionFactory();
$mysqli = $connectionFactory->get_Mysqli();
//$agendamento = new Agendamento($_POST["id"], $_POST["nome1"], $_POST["nome2"], $_POST["evento"], $_POST["data"], $_POST["hora"], $_POST["local"], $_POST["data_evento"], $_POST["telefone"], $_POST["observacao"]);
$agendamentoDao = new AgendamentoDao();
$resultado = $agendamentoDao->delete($_GET["id"], $mysqli);
if ($resultado == TRUE) {
    header("location: agendamento.php?acao=deletar&result=true&msg=Agendamento excluido com sucesso&data={$_GET["data"]}&local={$_GET["local"]}");
} else {
    header("location: agendamento.php?acao=deletar&result=false&msg=Falha ao excluir o agendamento");
}


