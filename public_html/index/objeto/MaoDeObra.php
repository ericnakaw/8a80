<?php

class MaoDeObra {

    private $idMaoDeObra;
    private $nomeMaoDeObra;
    private $valorMaoDeObra;
    private $conexao;

    function __construct($conexao) {
        $this->conexao = $conexao;
    }

    function getIdMaoDeObra() {
        return $this->idMaoDeObra;
    }

    function getNomeMaoDeObra() {
        return $this->nomeMaoDeObra;
    }

    function getValorMaoDeObra() {
        return $this->valorMaoDeObra;
    }

    function setIdMaoDeObra($idMaoDeObra) {
        $this->idMaoDeObra = $idMaoDeObra;
    }

    function setNomeMaoDeObra($nomeMaoDeObra) {
        $this->nomeMaoDeObra = $nomeMaoDeObra;
    }

    function setValorMaoDeObra($valorMaoDeObra) {
        $this->valorMaoDeObra = $valorMaoDeObra;
    }

    public function selectMaoDeObra($id) {
        $this->setIdMaoDeObra($id);
        $query = "SELECT * FROM `mao_de_obra` WHERE `id` = $this->idMaoDeObra";
        $resultado = $this->conexao->sql_query($query);
        return $resultado;
    }

    public function insertMaoDeObra($nome, $valor) {
        $this->setNomeMaoDeObra($nome);
        $this->setValorMaoDeObra($valor);
        $query = "INSERT INTO `mao_de_obra` (nome,valor)VALUES ('$this->nomeMaoDeObra', '$this->valorMaoDeObra');";
        print $this->conexao->sql_query($query);
    }

    public function updateMaoDeObra($id, $nome, $valor) {
        $this->setIdMaoDeObra($id);
        $this->setNomeMaoDeObra($nome);
        $this->setValorMaoDeObra($valor);
        $query = "UPDATE `mao_de_obra` SET `nome` = '$this->nomeMaoDeObra',`valor` =  '$this->valorMaoDeObra' WHERE  `mao_de_obra`.`id` =$this->idMaoDeObra;";
        print $this->conexao->sql_query($query);
    }

    public function deleteMaoDeObra($id) {
        $this->setIdMaoDeObra($id);
        $query = "DELETE FROM `mao_de_obra` WHERE `mao_de_obra`.`id` = $this->idMaoDeObra";
        print $this->conexao->sql_query($query);
    }

}
