<?php

class Pedido {

    private $idPedido;
    private $idFuncionario;
    private $idCliente;
    private $localRetirada;
    private $dataPedido;
    private $status;
    private $pedidoTipo;
    private $localVenda;

    function __construct($idPedido, $idFuncionario, $idCliente, $localRetirada, $dataPedido, $status, $pedidoTipo,$localVenda) {
        $this->idPedido = $idPedido;
        $this->idFuncionario = $idFuncionario;
        $this->idCliente = $idCliente;
        $this->localRetirada = $localRetirada;
        $this->dataPedido = $dataPedido;
        $this->status = $status;
        $this->pedidoTipo = $pedidoTipo;
        $this->localVenda = $localVenda;
    }

    function getLocalVenda() {
        return $this->localVenda;
    }

    function setLocalVenda($localVenda) {
        $this->localVenda = $localVenda;
    }

        function getIdPedido() {
        return $this->idPedido;
    }

    function getIdFuncionario() {
        return $this->idFuncionario;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getLocalRetirada() {
        return $this->localRetirada;
    }

    function getDataPedido() {
        return $this->dataPedido;
    }

    function getStatus() {
        return $this->status;
    }

    function getPedidoTipo() {
        return $this->pedidoTipo;
    }

    function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    function setIdFuncionario($idFuncionario) {
        $this->idFuncionario = $idFuncionario;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setLocalRetirada($localRetirada) {
        $this->localRetirada = $localRetirada;
    }

    function setDataPedido($dataPedido) {
        $this->dataPedido = $dataPedido;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setPedidoTipo($pedidoTipo) {
        $this->pedidoTipo = $pedidoTipo;
    }

}
