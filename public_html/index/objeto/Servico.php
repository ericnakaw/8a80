<?php

class Servico {

    private $idServico;
    private $nomeServico;
    private $valorServico;
    private $conexao;

    function __construct($conexao) {
        $this->conexao = $conexao;
    }

    function setIdServico($idServico) {
        $this->idServico = $idServico;
    }

    function getConexao() {
        return $this->conexao;
    }

    function setConexao($conexao) {
        $this->conexao = $conexao;
    }

    public function getIdServico() {
        return $this->idServico;
    }

    public function getNomeServico() {
        return $this->nomeServico;
    }

    public function getValorServico() {
        return $this->valorServico;
    }

    public function setNomeServico($nomeServico) {
        $this->nomeServico = $nomeServico;
    }

    public function setValorServico($valorServico) {
        $this->valorServico = $valorServico;
    }

    public function selectServico($id) {
        $query = "SELECT * FROM `servico` WHERE `id` = $id";
        $resultado = $this->conexao->sql_query($query);
        return $resultado;
    }

    public function insertServico($nome, $valor) {
        $this->setNomeServico($nome);
        $this->setValorServico($valor);
        $query = "INSERT INTO `servico` (`nome`, `valor`) VALUES ('$this->nomeServico', '$this->valorServico');";
        print $this->conexao->sql_query($query);
    }

    public function updateServico($id, $nome, $valor) {
        $query = "UPDATE `servico` SET `nome` = '$nome',`valor` =  '$valor' WHERE  `servico`.`id` =$id;";
        print $this->conexao->sql_query($query);
    }

    public function deleteServico($id) {
        $this->setIdServico($id);
        $query = "DELETE FROM `servico` WHERE `servico`.`id` = $this->idServico";
        print $this->conexao->sql_query($query);
    }

}
