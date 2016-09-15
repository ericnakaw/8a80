<?php

class Fonte {

    private $idFonte;
    private $nomeFonte;
    private $conexao;

    function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function getIdFonte() {
        return $this->idFonte;
    }

    public function getNomeFonte() {
        return $this->nomeFonte;
    }

    public function setIdFonte($idFonte) {
        $this->idFonte = $idFonte;
    }

    public function setNomeFonte($nomeFonte) {
        $this->nomeFonte = $nomeFonte;
    }

    public function selectFonte($id) {
        $this->setIdFonte($id);
        $query = "SELECT * FROM `fonte` WHERE `id` = $this->idFonte;";
        $resultado = $this->conexao->sql_query($query);
        return $resultado;
    }

    public function insertFonte($nome) {
        $this->setNomeFonte($nome);
        $query = "INSERT INTO `fonte` (nome)VALUES ('$this->nomeFonte');";
        print $this->conexao->sql_query($query);
    }

    public function updateFonte($id, $nome) {
        $this->setIdFonte($id);
        $this->setNomeFonte($nome);
        $query = "UPDATE `fonte` SET `nome` = '$this->nomeFonte' WHERE  `fonte`.`id` =$this->idFonte;";
        print $this->conexao->sql_query($query);
    }

    public function deleteFonte($id) {
        $this->setIdFonte($id);
        $query = "DELETE FROM `fonte` WHERE `fonte`.`id` = $this->idFonte;";
        print $this->conexao->sql_query($query);
    }

}
