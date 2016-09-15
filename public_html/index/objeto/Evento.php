<?php

class Evento {

    private $idEvento;
    private $nomeEvento;
    private $conexao;
    
    function __construct($conexao) {
        $this->conexao = $conexao;
    }

    function getIdEvento() {
        return $this->idEvento;
    }

    function getNomeEvento() {
        return $this->nomeEvento;
    }

    function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

    function setNomeEvento($nomeEvento) {
        $this->nomeEvento = $nomeEvento;
    }
    
    public function selectEvento($id) {
        $this->setIdEvento($id);
        $query = "SELECT * FROM `evento` WHERE `id` = $this->idEvento";
        $resultado = $this->conexao->sql_query($query);
        return $resultado;
    }

    public function insertEvento($nome) {
        $this->setNomeEvento($nome);
        $query = "INSERT INTO `evento` (nome)VALUES ('$this->nomeEvento');";
        print $this->conexao->sql_query($query);
    }

    public function updateEvento($id, $nome) {
        $this->setIdEvento($id);
        $this->setNomeEvento($nome);
        $query = "UPDATE `evento` SET `nome` = '$this->nomeEvento' WHERE  `evento`.`id` =$this->idEvento;";
        print $this->conexao->sql_query($query);
    }

    public function deleteEvento($id) {
        $this->setIdEvento($id);
        $query = "DELETE FROM `evento` WHERE `evento`.`id` = $this->idEvento";
        print $this->conexao->sql_query($query);
    }

}
