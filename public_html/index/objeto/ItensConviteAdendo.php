<?php

class ItensConviteAdendo {

    private $idItem;
    private $idAdendo;
    private $idPedido;
    private $quantidade;
    private $idConvite;
    private $valorUnitario;
    private $desconto;
    private $modelo_nome;

    function __construct($idItem, $idAdendo, $idPedido, $quantidade, $idConvite, $valorUnitario, $desconto) {
        $this->idItem = $idItem;
        $this->idAdendo = $idAdendo;
        $this->idPedido = $idPedido;
        $this->quantidade = $quantidade;
        $this->idConvite = $idConvite;
        $this->valorUnitario = $valorUnitario;
        $this->desconto = $desconto;
        $this->modelo_nome = $modelo_nome;
    }

    function getIdItem() {
        return $this->idItem;
    }

    function getIdAdendo() {
        return $this->idAdendo;
    }

    function getIdPedido() {
        return $this->idPedido;
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

    function setIdAdendo($idAdendo) {
        $this->idAdendo = $idAdendo;
    }

    function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
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
