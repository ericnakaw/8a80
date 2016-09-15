<?php
include './Produto.php';
include './Pedido.php';

class PedidoProduto {

    private $idProduto;
    private $idPedido;
    private $quantidade;
    private $dataEntrega;

    function __construct($idProduto, $idPedido, $quantidade, $dataEntrega) {
        $this->idProduto = $idProduto;
        $this->idPedido = $idPedido;
        $this->quantidade = $quantidade;
        $this->dataEntrega = $dataEntrega;
    }

    public function getIdProduto() {
        return $this->idProduto;
    }

    public function getIdPedido() {
        return $this->idPedido;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function getDataEntrega() {
        return $this->dataEntrega;
    }

    public function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function setDataEntrega($dataEntrega) {
        $this->dataEntrega = $dataEntrega;
    }

    public function selectPedidoProduto() {
        //put your code here
    }
    public function insertPedidoProduto() {
        //put your code here
    }
    public function updatePedidoProduto() {
        //put your code here
    }
    public function deletePedidoProduto() {
        //put your code here
    }
    
}
