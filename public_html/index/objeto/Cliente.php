<?php

class Cliente {

    private $idCliente;
    private $dataEvento;
    private $evento;
    private $rua;
    private $numero;
    private $complemento;
    private $estado;
    private $bairro;
    private $cidade;
    private $cep;
    private $observacao;

    function __construct($dataEvento, $evento, $rua, $numero, $complemento, $estado, $bairro, $cidade, $cep, $observacao) {
        $this->dataEvento = $dataEvento;
        $this->evento = $evento;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->complemento = $complemento;
        $this->estado = $estado;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->cep = $cep;
        $this->observacao = $observacao;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getDataEvento() {
        return $this->dataEvento;
    }

    function getEvento() {
        return $this->evento;
    }

    function getRua() {
        return $this->rua;
    }

    function getNumero() {
        return $this->numero;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function getEstado() {
        return $this->estado;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getCep() {
        return $this->cep;
    }

    function getObservacao() {
        return $this->observacao;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setDataEvento($dataEvento) {
        $this->dataEvento = $dataEvento;
    }

    function setEvento($evento) {
        $this->evento = $evento;
    }

    function setRua($rua) {
        $this->rua = $rua;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

}
