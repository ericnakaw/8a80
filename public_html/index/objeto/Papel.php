<?php

class Papel {

    private $idPapel;
    private $nomePapel;
    private $gramaturaPapel;
    private $categoriaPapelId;
    private $conexao;

    function __construct($conexao) {
        $this->conexao= $conexao;
    }

    function getIdPapel() {
        return $this->idPapel;
    }

    function getNomePapel() {
        return $this->nomePapel;
    }

    function getGramaturaPapel() {
        return $this->gramaturaPapel;
    }

    function getCategoriaPapelId() {
        return $this->categoriaPapelId;
    }

    function getConexao() {
        return $this->conexao;
    }

    function setIdPapel($idPapel) {
        $this->idPapel = $idPapel;
    }

    function setNomePapel($nomePapel) {
        $this->nomePapel = $nomePapel;
    }

    function setGramaturaPapel($gramaturaPapel) {
        $this->gramaturaPapel = $gramaturaPapel;
    }

    function setCategoriaPapelId($categoriaPapel) {
        $this->categoriaPapelId = $categoriaPapel;
    }

    function setConexao($conexao) {
        $this->conexao = $conexao;
    }

    public function selectPapel($id) {
        $this->setIdPapel($id);
        $query = "SELECT * FROM `papel` WHERE `id` = $this->idPapel";
        $resultado = $this->conexao->sql_query($query);
        return $resultado;
    }

    public function insertPapel($papel,$categoriaPapelId,$gramaturaPapel) {
        $this->setNomePapel($papel);
        $this->setCategoriaPapelId($categoriaPapelId);
        $this->setGramaturaPapel($gramaturaPapel);
        $query = "INSERT INTO `papel` (categoria_papel_id ,nome,gramatura)VALUES ('$this->categoriaPapelId','$this->nomePapel','$this->gramaturaPapel');";
        print $this->conexao->sql_query($query);
    }

public function updatePapel($id,$nomePapel,$categoriaPapelId,$gramaturaPapel) {
        $this->setNomePapel($nomePapel);
        $this->setCategoriaPapelId($categoriaPapelId);
        $this->setGramaturaPapel($gramaturaPapel);
        $query = "UPDATE `papel` SET `categoria_papel_id` = '$this->categoriaPapelId',`nome` =  '$this->nomePapel',`gramatura` =  '$this->gramaturaPapel' WHERE  `papel`.`id` =$id;";
        print $this->conexao->sql_query($query);
    }

    public function deletePapel($id) {
        $this->setIdPapel($id);
        $query = "DELETE FROM `papel` WHERE `papel`.`id` = $this->idPapel";
        print $this->conexao->sql_query($query);
    }

}
