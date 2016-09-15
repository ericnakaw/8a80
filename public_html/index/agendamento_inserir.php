<?php
include './conexao/ConnectionFactory.php';
include './objeto/Agendamento.php';
include './dao/AgendamentoDao.php';
$connectionFactory = new ConnectionFactory();
$mysqli = $connectionFactory->get_Mysqli();
$agendamento = new Agendamento($_POST["id"], $_POST["nome1"], $_POST["nome2"], $_POST["evento"], $_POST["data"], $_POST["hora"], $_POST["local"], $_POST["data_evento"], $_POST["telefone"], $_POST["observacao"]);
$agendamentoDao = new AgendamentoDao();
$resultado = $agendamentoDao->insert($agendamento, $mysqli);
if ($resultado == TRUE) {
    header("location: agendamento.php?acao=inserir&result=true&msg=Agendamento realizado com sucesso&data={$_POST["data"]}&local={$_POST["local"]}");
} else {
    header("location: agendamento.php?acao=inserir&result=false&msg=Falha ao inserir o agendamento");
}


