<?php

class Produto {

    private $idProduto;
    private $produtoCategoriaId;
    private $nomeProduto;
    private $valorProduto;
    private $descricao;
    private $conexao;

    function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function getProdutoCategoriaId() {
        return $this->produtoCategoriaId;
    }

    public function setProdutoCategoriaId($produtoCategoriaId) {
        $this->produtoCategoriaId = $produtoCategoriaId;
    }

    public function getIdProduto() {
        return $this->idProduto;
    }

    public function getNomeProduto() {
        return $this->nomeProduto;
    }

    public function getValorProduto() {
        return $this->valorProduto;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }

    public function setNomeProduto($nomeProduto) {
        $this->nomeProduto = $nomeProduto;
    }

    public function setValorProduto($valorProduto) {
        $this->valorProduto = $valorProduto;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function selectProduto($id) {
        $this->setIdProduto($id);
        $query = "SELECT * FROM `produto` WHERE `id` = $this->idProduto";
        $resultado = $this->conexao->sql_query($query);
        return $resultado;
    }

    public function insertProduto($nome, $produtoCategoriaId, $valor, $descricao) {
        $this->setProdutoCategoriaId($produtoCategoriaId);
        $this->setNomeProduto($nome);
        $this->setValorProduto($valor);
        $this->setDescricao($descricao);
        $query = "INSERT INTO `produto` (produto_categoria_id,nome,valor,descricao)VALUES ('$this->produtoCategoriaId','$this->nomeProduto', '$this->valorProduto','$this->descricao');";
        print $this->conexao->sql_query($query);
    }

    public function updateProduto($id, $produtoCategoriaId, $nome, $valor, $descricao) {
        $this->setIdProduto($id);
        $this->setProdutoCategoriaId($produtoCategoriaId);
        $this->setNomeProduto($nome);
        $this->setValorProduto($valor);
        $this->setDescricao($descricao);
        $query = "UPDATE `produto` SET `produto_categoria_id` = '$this->produtoCategoriaId',`nome` =  '$this->nomeProduto',`valor` =  '$this->valorProduto',`descricao` =  '$this->descricao' WHERE  `produto`.`id` =$this->idProduto;";
        print $this->conexao->sql_query($query);
    }

    public function deleteProduto($id) {
        $this->setIdProduto($id);
        $query = "DELETE FROM `produto` WHERE `produto`.`id` = $this->idProduto";
        print $this->conexao->sql_query($query);
    }

}
