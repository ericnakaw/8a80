<?php

class ItensConviteOrcamento {

    private $idItem;
    private $idOrcamento;
    private $quantidade;
    private $idConvite;
    private $valorUnitario;
    private $desconto;
    private $modelo_nome;

    function __construct($idItem, $idOrcamento, $quantidade, $idConvite, $valorUnitario, $desconto) {
        $this->idItem = $idItem;
        $this->idOrcamento = $idOrcamento;
        $this->quantidade = $quantidade;
        $this->idConvite = $idConvite;
        $this->valorUnitario = $valorUnitario;
        $this->desconto = $desconto;
    }

    function getIdItem() {
        return $this->idItem;
    }

    function getIdOrcamento() {
        return $this->idOrcamento;
    }

    function getQuantidade() {
        return $this->quantidade;
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

    function getModelo_nome() {
        return $this->modelo_nome;
    }

    function setIdItem($idItem) {
        $this->idItem = $idItem;
    }

    function setIdOrcamento($idOrcamento) {
        $this->idOrcamento = $idOrcamento;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
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

    function setModelo_nome($modelo_nome) {
        $this->modelo_nome = $modelo_nome;
    }

}
