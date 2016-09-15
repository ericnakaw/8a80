<?php

class Orcamento {

    private $idOrcamento;
    private $idFuncionario;
    private $idCliente;
    private $dataOrcamento;
    private $status;
    private $localOrcamento;

    function __construct($idOrcamento, $idFuncionario, $idCliente, $dataOrcamento, $status, $localOrcamento) {
        $this->idOrcamento = $idOrcamento;
        $this->idFuncionario = $idFuncionario;
        $this->idCliente = $idCliente;
        $this->dataOrcamento = $dataOrcamento;
        $this->status = $status;
        $this->localOrcamento = $localOrcamento;
    }

    function getIdOrcamento() {
        return $this->idOrcamento;
    }

    function getIdFuncionario() {
        return $this->idFuncionario;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getDataOrcamento() {
        return $this->dataOrcamento;
    }

    function getStatus() {
        return $this->status;
    }

    function getLocalOrcamento() {
        return $this->localOrcamento;
    }

    function setIdOrcamento($idOrcamento) {
        $this->idOrcamento = $idOrcamento;
    }

    function setIdFuncionario($idFuncionario) {
        $this->idFuncionario = $idFuncionario;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setDataOrcamento($dataOrcamento) {
        $this->dataOrcamento = $dataOrcamento;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setLocalOrcamento($localOrcamento) {
        $this->localOrcamento = $localOrcamento;
    }

}
