<?php

class Adendo {

    private $idAdendo;
    private $idPedido;
    private $idFuncionario;
    private $idCliente;
    private $localRetirada;
    private $dataAdendo;
    private $status;
    private $localVenda;

    function __construct($idAdendo, $idPedido, $idFuncionario, $idCliente, $localRetirada, $dataAdendo, $status, $localVenda) {
        $this->idAdendo = $idAdendo;
        $this->idPedido = $idPedido;
        $this->idFuncionario = $idFuncionario;
        $this->idCliente = $idCliente;
        $this->localRetirada = $localRetirada;
        $this->dataAdendo = $dataAdendo;
        $this->status = $status;
        $this->localVenda = $localVenda;
    }

    function getIdAdendo() {
        return $this->idAdendo;
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

    function getDataAdendo() {
        return $this->dataAdendo;
    }

    function getStatus() {
        return $this->status;
    }

    function getLocalVenda() {
        return $this->localVenda;
    }

    function setIdAdendo($idAdendo) {
        $this->idAdendo = $idAdendo;
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

    function setDataAdendo($dataAdendo) {
        $this->dataAdendo = $dataAdendo;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setLocalVenda($localVenda) {
        $this->localVenda = $localVenda;
    }

}
