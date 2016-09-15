<?php

class ItensConvite {

    private $idItem;
    private $idPedido;
    private $quantidade;
    private $dataEntrega;
    private $idConvite;
    private $valorUnitario;
    private $desconto;
    private $modelo_nome;
    private $idOrcamento;

    function __construct($idPedido, $quantidade, $dataEntrega, $idConvite, $valorUnitario, $desconto, $idOrcamento) {
        $this->idPedido = $idPedido;
        $this->quantidade = $quantidade;
        $this->dataEntrega = $dataEntrega;
        $this->idConvite = $idConvite;
        $this->valorUnitario = $valorUnitario;
        $this->desconto = $desconto;
        $this->idOrcamento = $idOrcamento;
    }

    function getIdOrcamento() {
        return $this->idOrcamento;
    }

    function setIdOrcamento($idOrcamento) {
        $this->idOrcamento = $idOrcamento;
    }

    function getModelo_nome() {
        return $this->modelo_nome;
    }

    function setModelo_nome($modelo_nome) {
        $this->modelo_nome = $modelo_nome;
    }

    function getIdItem() {
        return $this->idItem;
    }

    function getIdPedido() {
        return $this->idPedido;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function getDataEntrega() {
        return $this->dataEntrega;
    }

    function getIdConvite() {
        return $this->idConvite;
    }

    function getValorUnitario() {
        return $this->valorUnitario;
    }

    function getDesconto() {
        return $this->desconto;
    }

    function setIdItem($idItem) {
        $this->idItem = $idItem;
    }

    function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    function setDataEntrega($dataEntrega) {
        $this->dataEntrega = $dataEntrega;
    }

    function setIdConvite($idConvite) {
        $this->idConvite = $idConvite;
    }

    function setValorUnitario($valorUnitario) {
        $this->valorUnitario = $valorUnitario;
    }

    function setDesconto($desconto) {
        $this->desconto = $desconto;
    }

}
