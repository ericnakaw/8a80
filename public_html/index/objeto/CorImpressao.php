<?php

class CorImpressao {

    private $idCorImpressao;
    private $nomeImpressao;
    private $detalheImpressao;
    private $conexao;

    function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function getIdCorImpressao() {
        return $this->idCorImpressao;
    }

    public function getNomeImpressao() {
        return $this->nomeImpressao;
    }

    public function getDetalheImpressao() {
        return $this->detalheImpressao;
    }

    public function setIdCorImpressao($idCorImpressao) {
        $this->idCorImpressao = $idCorImpressao;
    }

    public function setNomeImpressao($nomeImpressao) {
        $this->nomeImpressao = $nomeImpressao;
    }

    public function setDetalheImpressao($detalheImpressao) {
        $this->detalheImpressao = $detalheImpressao;
    }

    public function selectCorImpressao($id) {
        $this->setIdCorImpressao($id);
        $query = "SELECT * FROM `impressao_cor` WHERE `id` = $this->idCorImpressao";
        $resultado = $this->conexao->sql_query($query);
        return $resultado;
    }

    public function insertCorImpressao($nomeCorImpressao, $detalheCorImpressao) {
        $this->setNomeImpressao($nomeCorImpressao);
        $this->setDetalheImpressao($detalheCorImpressao);
        $query = "INSERT INTO `impressao_cor` (nome,detalhe)VALUES ('$this->nomeImpressao', '$this->detalheImpressao');";
        print $this->conexao->sql_query($query);
    }

    public function updateCorImpressao($id,$nomeCorImpressao, $detalheCorImpressao) {
        $this->setIdCorImpressao($id);
        $this->setNomeImpressao($nomeCorImpressao);
        $this->setDetalheImpressao($detalheCorImpressao);
        $query = "UPDATE `impressao_cor` SET `nome` = '$this->nomeImpressao',`detalhe` =  '$this->detalheImpressao' WHERE  `impressao_cor`.`id` =$this->idCorImpressao;";
        print $this->conexao->sql_query($query);
    }

    public function deleteCorImpressao($id) {
        $this->setIdCorImpressao($id);
        $query = "DELETE FROM `impressao_cor` WHERE `impressao_cor`.`id` = $this->idCorImpressao";
        print $this->conexao->sql_query($query);
    }

}
