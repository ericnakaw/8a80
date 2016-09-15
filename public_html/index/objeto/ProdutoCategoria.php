<?php

class ProdutoCategoria {

    private $id;
    private $nome;
    private $conexao;

    function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function selectProdutoCategoria($id) {
        $this->setId($id);
        $query = "SELECT * FROM `produto_categoria` WHERE `id` = $this->id";
        $resultado = $this->conexao->sql_query($query);
        return $resultado;
    }

    public function insertProdutoCategoria($nome) {
        $this->setNome($nome);
        $query = "INSERT INTO `produto_categoria` (nome)VALUES ('$this->nome');";
        print $this->conexao->sql_query($query);
    }

    public function updateProdutoCategoria($id, $nome) {
        $this->setId($id);
        $this->setNome($nome);
        $query = "UPDATE `produto_categoria` SET `nome` =  '$this->nome' WHERE  `produto_categoria`.`id` =$this->id;";
        print $this->conexao->sql_query($query);
    }

    public function deleteProdutoCategoria($id) {
        $this->setId($id);
        $query = "DELETE FROM `produto_categoria` WHERE `produto_categoria`.`id` = $this->id";
        print $this->conexao->sql_query($query);
    }

}
