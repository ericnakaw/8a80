<?php

class Convite {

    private $idConvite;
    private $idModelo;
    private $idPapelEnvelope;
    private $idPapelCartao;
    private $impressaoCartao;
    private $impressaoEnvelope;
    private $acabamentoCartao;
    private $acabamentoEnvelope;
    private $detalheCartao;
    private $detalheEnvelope;
    private $servicoCartao;
    private $servicoEnvelope;
    private $fonteCartao;
    private $fonteEnvelope;
    private $fita;

    function __construct($idConvite, $idModelo, $idPapelEnvelope, $idPapelCartao, $impressaoCartao, $impressaoEnvelope, $acabamentoCartao, $acabamentoEnvelope, $detalheCartao, $detalheEnvelope, $servicoCartao, $servicoEnvelope, $fonteCartao, $fonteEnvelope, $fita) {
        $this->idConvite = $idConvite;
        $this->idModelo = $idModelo;
        $this->idPapelEnvelope = $idPapelEnvelope;
        $this->idPapelCartao = $idPapelCartao;
        $this->impressaoCartao = $impressaoCartao;
        $this->impressaoEnvelope = $impressaoEnvelope;
        $this->acabamentoCartao = $acabamentoCartao;
        $this->acabamentoEnvelope = $acabamentoEnvelope;
        $this->detalheCartao = $detalheCartao;
        $this->detalheEnvelope = $detalheEnvelope;
        $this->servicoCartao = $servicoCartao;
        $this->servicoEnvelope = $servicoEnvelope;
        $this->fonteCartao = $fonteCartao;
        $this->fonteEnvelope = $fonteEnvelope;
        $this->fita = $fita;
    }

    public function getIdConvite() {
        return $this->idConvite;
    }

    function getIdModelo() {
        return $this->idModelo;
    }

    function getIdPapelEnvelope() {
        return $this->idPapelEnvelope;
    }

    function getIdPapelCartao() {
        return $this->idPapelCartao;
    }

    function getImpressaoCartao() {
        return $this->impressaoCartao;
    }

    function getImpressaoEnvelope() {
        return $this->impressaoEnvelope;
    }

    function getAcabamentoCartao() {
        return $this->acabamentoCartao;
    }

    function getAcabamentoEnvelope() {
        return $this->acabamentoEnvelope;
    }

    function getDetalheCartao() {
        return $this->detalheCartao;
    }

    function getDetalheEnvelope() {
        return $this->detalheEnvelope;
    }

    function getServicoCartao() {
        return $this->servicoCartao;
    }

    function getServicoEnvelope() {
        return $this->servicoEnvelope;
    }

    function getFonteCartao() {
        return $this->fonteCartao;
    }

    function getFonteEnvelope() {
        return $this->fonteEnvelope;
    }

    function getFita() {
        return $this->fita;
    }

    function setIdConvite($idConvite) {
        $this->idConvite = $idConvite;
    }

    function setIdModelo($idModelo) {
        $this->idModelo = $idModelo;
    }

    function setIdPapelEnvelope($idPapelEnvelope) {
        $this->idPapelEnvelope = $idPapelEnvelope;
    }

    function setIdPapelCartao($idPapelCartao) {
        $this->idPapelCartao = $idPapelCartao;
    }

    function setImpressaoCartao($impressaoCartao) {
        $this->impressaoCartao = $impressaoCartao;
    }

    function setImpressaoEnvelope($impressaoEnvelope) {
        $this->impressaoEnvelope = $impressaoEnvelope;
    }

    function setAcabamentoCartao($acabamentoCartao) {
        $this->acabamentoCartao = $acabamentoCartao;
    }

    function setAcabamentoEnvelope($acabamentoEnvelope) {
        $this->acabamentoEnvelope = $acabamentoEnvelope;
    }

    function setDetalheCartao($detalheCartao) {
        $this->detalheCartao = $detalheCartao;
    }

    function setDetalheEnvelope($detalheEnvelope) {
        $this->detalheEnvelope = $detalheEnvelope;
    }

    function setServicoCartao($servicoCartao) {
        $this->servicoCartao = $servicoCartao;
    }

    function setServicoEnvelope($servicoEnvelope) {
        $this->servicoEnvelope = $servicoEnvelope;
    }

    function setFonteCartao($fonteCartao) {
        $this->fonteCartao = $fonteCartao;
    }

    function setFonteEnvelope($fonteEnvelope) {
        $this->fonteEnvelope = $fonteEnvelope;
    }

    function setFita($fita) {
        $this->fita = $fita;
    }

}
