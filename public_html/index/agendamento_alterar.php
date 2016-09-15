<?php
include './conexao/ConnectionFactory.php';
include './objeto/Agendamento.php';
include './dao/AgendamentoDao.php';
$connectionFactory = new ConnectionFactory();
$mysqli = $connectionFactory->get_Mysqli();
$agendamento = new Agendamento($_POST["id"], $_POST["nome1"], $_POST["nome2"], $_POST["evento"], $_POST["data"], $_POST["hora"], $_POST["local"], $_POST["data_evento"], $_POST["telefone"], $_POST["observacao"], $_POST["atendimento"]);
$agendamentoDao = new AgendamentoDao();
$resultado = $agendamentoDao->update($agendamento, $mysqli);
if ($resultado == TRUE) {
    header("location: agendamento.php?acao=alterar&result=true&msg=Agendamento alterado com sucesso&data={$_POST["data"]}&local={$_POST["local"]}");
} else {
    header("location: agendamento.php?acao=alterar&result=false&msg=Falha ao alterar o agendamento");
}
