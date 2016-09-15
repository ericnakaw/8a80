<?php

class Acabamento {

    private $idAcabamento;
    private $nomeAcabamento;
    private $valorAcabamento;
    private $conexao;

    function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function getIdAcabamento() {
        return $this->idAcabamento;
    }

    public function getNomeAcabamento() {
        return $this->nomeAcabamento;
    }

    public function getValorAcabamento() {
        return $this->valorAcabamento;
    }

    function setIdAcabamento($idAcabamento) {
        $this->idAcabamento = $idAcabamento;
    }

    public function setNomeAcabamento($nomeAcabamento) {
        $this->nomeAcabamento = $nomeAcabamento;
    }

    public function setValorAcabamento($valorAcabamento) {
        $this->valorAcabamento = $valorAcabamento;
    }

    public function selectAcabamento($id) {
        $this->setIdAcabamento($id);
        $query = "SELECT * FROM `acabamento` WHERE `id` = $this->idAcabamento";
        $resultado = $this->conexao->sql_query($query);
        return $resultado;
    }

    public function insertAcabamento($nome, $valor) {
        $this->setNomeAcabamento($nome);
        $this->setValorAcabamento($valor);
        $query = "INSERT INTO `acabamento` (nome,valor)VALUES ('$this->nomeAcabamento', '$this->valorAcabamento');";
        print $this->conexao->sql_query($query);
    }

    public function updateAcabamento($id, $nome, $valor) {
        $this->setIdAcabamento($id);
        $this->setNomeAcabamento($nome);
        $this->setValorAcabamento($valor);
        $query = "UPDATE `acabamento` SET `nome` = '$this->nomeAcabamento',`valor` =  '$this->valorAcabamento' WHERE  `acabamento`.`id` =$this->idAcabamento;";
        print $this->conexao->sql_query($query);
    }

    public function deleteAcabamento($id) {
        $this->setIdAcabamento($id);
        $query = "DELETE FROM `acabamento` WHERE `acabamento`.`id` = $this->idAcabamento";
        print $this->conexao->sql_query($query);
    }

}
