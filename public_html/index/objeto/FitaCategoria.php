<?php

class FitaCategoria {

    private $idCategoria;
    private $nomeCategoria;
    private $valorCategoria;
    private $conexao;

    function __construct($conexao) {
        $this->conexao = $conexao;
    }

    function getIdCategoria() {
        return $this->idCategoria;
    }

    function getNomeCategoria() {
        return $this->nomeCategoria;
    }

    function getValorCategoria() {
        return $this->valorCategoria;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    function setNomeCategoria($nomeCategoria) {
        $this->nomeCategoria = $nomeCategoria;
    }

    function setValorCategoria($valorCategoria) {
        $this->valorCategoria = $valorCategoria;
    }

    public function selectFitaCategoria($id) {
        $this->setIdCategoria($id);
        $query = "SELECT * FROM `fita_categoria` WHERE `id` = $this->idCategoria";
        $resultado = $this->conexao->sql_query($query);
        return $resultado;
    }

    public function insertFitaCategoria($nome, $valor) {
        $this->setNomeCategoria($nome);
        $this->setValorCategoria($valor);
        $query = "INSERT INTO `fita_categoria` (nome,valor)VALUES ('$this->nomeCategoria', '$this->valorCategoria');";
        print $this->conexao->sql_query($query);
    }

    public function updateFitaCategoria($id, $nome, $valor) {
        $this->setIdCategoria($id);
        $this->setNomeCategoria($nome);
        $this->setValorCategoria($valor);
        $query = "UPDATE `fita_categoria` SET `nome` = '$this->nomeCategoria',`valor` =  '$this->valorCategoria' WHERE  `fita_categoria`.`id` =$this->idCategoria;";
        print $this->conexao->sql_query($query);
    }

    public function deleteFitaCategoria($id) {
        $this->setIdCategoria($id);
        $query = "DELETE FROM `fita_categoria` WHERE `fita_categoria`.`id` = $this->idCategoria";
        print $this->conexao->sql_query($query);
    }

}
