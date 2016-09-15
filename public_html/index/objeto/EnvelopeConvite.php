<?php

include './Papel.php';
include './Impressao.php';
include './AcabamentoConvite.php';
include './CorImpressao.php';
include './Fonte.php';
include './Servico.php';

class EnvelopeConvite {

    private $idEnvelope;
    private $papelEnvelope;
    private $impressaoEnvelope;
    private $acabamentoEnvelope;
    private $detalheEnvelope;
    private $corImpressao;
    private $escritaFonte;
    private $servico;

    public function getIdEnvelope() {
        return $this->idEnvelope;
    }

    public function getPapelEnvelope() {
        return $this->papelEnvelope;
    }

    public function getImpressaoEnvelope() {
        return $this->impressaoEnvelope;
    }

    public function getAcabamentoEnvelope() {
        return $this->acabamentoEnvelope;
    }

    public function getDetalheEnvelope() {
        return $this->detalheEnvelope;
    }

    public function getCorImpressao() {
        return $this->corImpressao;
    }

    public function getEscritaFonte() {
        return $this->escritaFonte;
    }

    public function getServico() {
        return $this->servico;
    }

    public function setPapelEnvelope($papelEnvelope) {
        $this->papelEnvelope = $papelEnvelope;
    }

    public function setImpressaoEnvelope($impressaoEnvelope) {
        $this->impressaoEnvelope = $impressaoEnvelope;
    }

    public function setAcabamentoEnvelope($acabamentoEnvelope) {
        $this->acabamentoEnvelope = $acabamentoEnvelope;
    }

    public function setDetalheEnvelope($detalheEnvelope) {
        $this->detalheEnvelope = $detalheEnvelope;
    }

    public function setCorImpressao($corImpressao) {
        $this->corImpressao = $corImpressao;
    }

    public function setEscritaFonte($escritaFonte) {
        $this->escritaFonte = $escritaFonte;
    }

    public function setServico($servico) {
        $this->servico = $servico;
    }

    //put your code here
}
