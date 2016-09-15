<?php

class Impressao {

    public $idImpressao;
    public $nomeImpressao;
    public $valorImpressao;
    public $conexao;

    function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function getIdImpressao() {
        return $this->idImpressao;
    }

    public function getNomeImpressao() {
        return $this->nomeImpressao;
    }

    public function getValorImpressao() {
        return $this->valorImpressao;
    }
    public function setIdImpressao($idImpressao) {
        $this->idImpressao = $idImpressao;
    }

        public function setNomeImpressao($nomeImpressao) {
        $this->nomeImpressao = $nomeImpressao;
    }

    public function setValorImpressao($valorImpressao) {
        $this->valorImpressao = $valorImpressao;
    }

    public function selectImpressao($id) {
        $this->setIdImpressao($id);
        $query = "SELECT * FROM `impressao` WHERE `id` = $this->idImpressao";
        $resultado = $this->conexao->sql_query($query);
        return $resultado;
    }

    public function insertImpressao($nome, $valor) {
        $this->setNomeImpressao($nome);
        $this->setValorImpressao($valor);
        $query = "INSERT INTO `impressao` (nome,valor)VALUES ('$this->nomeImpressao', '$this->valorImpressao');";
        print $this->conexao->sql_query($query);
    }

    public function updateImpressao($id, $nome, $valor) {
        $this->setIdImpressao($id);
        $this->setNomeImpressao($nome);
        $this->setValorImpressao($valor);
        $query = "UPDATE `impressao` SET `nome` = '$this->nomeImpressao',`valor` =  '$this->valorImpressao' WHERE  `impressao`.`id` =$this->idImpressao;";
        print $this->conexao->sql_query($query);
    }

    public function deleteImpressao($id) {
        $this->setIdImpressao($id);
        $query = "DELETE FROM `impressao` WHERE `impressao`.`id` = $this->idImpressao";
        print $this->conexao->sql_query($query);
    }

}
