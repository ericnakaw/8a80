<?php

include './Papel.php';
include './Impressao.php';
include './AcabamentoConvite.php';
include './CorImpressao.php';
include './Fonte.php';
include './Servico.php';

class CartaoConvite {

    private $idCartao;
    private $papelCartao;
    private $impressaoCartao;
    private $acabamentoCartao;
    private $detalheCartao;
    private $escritaFonte;
    private $corImpressao;
    private $servico;

    //Getter and Setter
    public function getIdCartao() {
        return $this->idCartao;
    }

    public function getPapelCartao() {
        return $this->papelCartao;
    }

    public function getImpressaoCartao() {
        return $this->impressaoCartao;
    }

    public function getAcabamentoCartao() {
        return $this->acabamentoCartao;
    }

    public function getDetalheCartao() {
        return $this->detalheCartao;
    }

    public function getEscritaFonte() {
        return $this->escritaFonte;
    }

    public function getCorImpressao() {
        return $this->corImpressao;
    }

    public function getServico() {
        return $this->servico;
    }

    public function setPapelCartao($papelCartao) {
        $this->papelCartao = $papelCartao;
    }

    public function setImpressaoCartao($impressaoCartao) {
        $this->impressaoCartao = $impressaoCartao;
    }

    public function setAcabamentoCartao($acabamentoCartao) {
        $this->acabamentoCartao = $acabamentoCartao;
    }

    public function setDetalheCartao($detalheCartao) {
        $this->detalheCartao = $detalheCartao;
    }

    public function setEscritaFonte($escritaFonte) {
        $this->escritaFonte = $escritaFonte;
    }

    public function setCorImpressao($corImpressao) {
        $this->corImpressao = $corImpressao;
    }

    public function setServico($servico) {
        $this->servico = $servico;
    }

    //CRUD do banco de dados

    public function selectCartaoConvite() {
        //Put your code here
    }

    public function insertCartaoConvite() {
        //Put your code here
    }

    public function updateCartaoConvite() {
        //Put your code here
    }

    public function deleteCartaoConvite() {
        //Put your code here
    }

}
