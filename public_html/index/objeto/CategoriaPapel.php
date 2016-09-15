<?php

class CategoriaPapel {

    private $idCategoriaPapel;
    private $nomeCategoriaPapel;
    private $valorCategoriaPapel;
    private $conexao;

    function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function getIdCategoriaPapel() {
        return $this->idCategoriaPapel;
    }

    public function getNomeCategoriaPapel() {
        return $this->nomeCategoriaPapel;
    }

    public function getValorCategoriaPapel() {
        return $this->valorCategoriaPapel;
    }

    public function setIdCategoriaPapel($idCategoriaPapel) {
        $this->idCategoriaPapel = $idCategoriaPapel;
    }

    public function setNomeCategoriaPapel($nomeCategoriaPapel) {
        $this->nomeCategoriaPapel = $nomeCategoriaPapel;
    }

    public function setValorCategoriaPapel($valorCategoriaPapel) {
        if (is_numeric($valorCategoriaPapel)) {
            $this->valorCategoriaPapel = $valorCategoriaPapel;
        }
    }

//Seleciona pelo id
    public function selectCategoriaPapel($id) {
        $this->setIdCategoriaPapel($id);
        $query = "SELECT * FROM `categoria_papel` WHERE `id` = $this->idCategoriaPapel";
        $resultado = $this->conexao->sql_query($query);
        return $resultado;
    }

    public function insertCategoriaPapel($nome, $valor) {
        $this->setNomeCategoriaPapel($nome);
        $this->setValorCategoriaPapel($valor);
        $query = "INSERT INTO `categoria_papel` (nome,valor)VALUES ('$this->nomeCategoriaPapel', '$this->valorCategoriaPapel');";
        print $this->conexao->sql_query($query);
    }

    public function updateCategoriaPapel($id, $nome, $valor) {
        $this->setIdCategoriaPapel($id);
        $this->setNomeCategoriaPapel($nome);
        $this->setValorCategoriaPapel($valor);
        $query = "UPDATE `categoria_papel` SET `nome` = '$this->nomeCategoriaPapel',`valor` =  '$this->valorCategoriaPapel' WHERE  `categoria_papel`.`id` =$this->idCategoriaPapel;";
        print $this->conexao->sql_query($query);
    }

    public function deleteCategoriaPapel($id) {
        $this->setIdCategoriaPapel($id);
        $query = "DELETE FROM `categoria_papel` WHERE `categoria_papel`.`id` = $this->idCategoriaPapel";
        print $this->conexao->sql_query($query);
    }

}
