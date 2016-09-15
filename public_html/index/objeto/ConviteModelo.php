<?php

class ConviteModelo {

    private $idModelo;
    private $cod;
    private $nomeModelo;
    private $alturaModelo;
    private $larguraModelo;
    private $aproveitamentoCartao;
    private $aproveitamentoEnvelope;
    private $formatoCartaoAltura;
    private $formatoCartaoLargura;
    private $formatoEnvelopeAltura;
    private $formatoEnvelopeLargura;
    private $composicao;
    private $duplaFace;
    private $dobra;
    private $colagem;
    private $empastamentoBorda;
    private $empastamentoBordaEnv;
    private $markup;
    private $observacao;
    private $conexao;

    function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function getIdModelo() {
        return $this->idModelo;
    }

    public function getNomeModelo() {
        return $this->nomeModelo;
    }

    public function getAlturaModelo() {
        return $this->alturaModelo;
    }

    public function getLarguraModelo() {
        return $this->larguraModelo;
    }

    public function getFormatoCartaoAltura() {
        return $this->formatoCartaoAltura;
    }

    public function getFormatoCartaoLargura() {
        return $this->formatoCartaoLargura;
    }

    public function getFormatoEnvelopeAltura() {
        return $this->formatoEnvelopeAltura;
    }

    public function getFormatoEnvelopeLargura() {
        return $this->formatoEnvelopeLargura;
    }

    public function getComposicao() {
        return $this->composicao;
    }

    public function setIdModelo($idModelo) {
        $this->idModelo = $idModelo;
    }

    public function setNomeModelo($nomeModelo) {
        $this->nomeModelo = $nomeModelo;
    }

    public function setAlturaModelo($alturaModelo) {
        $this->alturaModelo = $alturaModelo;
    }

    public function setLarguraModelo($larguraModelo) {
        $this->larguraModelo = $larguraModelo;
    }

    public function setFormatoCartaoAltura($formatoCartaoAltura) {
        $this->formatoCartaoAltura = $formatoCartaoAltura;
    }

    public function setFormatoCartaoLargura($formatoCartaoLargura) {
        $this->formatoCartaoLargura = $formatoCartaoLargura;
    }

    public function setFormatoEnvelopeAltura($formatoEnvelopeAltura) {
        $this->formatoEnvelopeAltura = $formatoEnvelopeAltura;
    }

    public function setFormatoEnvelopeLargura($formatoEnvelopeLargura) {
        $this->formatoEnvelopeLargura = $formatoEnvelopeLargura;
    }

    public function setComposicao($composicao) {
        $this->composicao = $composicao;
        print $composicao;
    }

    function getCod() {
        return $this->cod;
    }

    function getAproveitamentoCartao() {
        return $this->aproveitamentoCartao;
    }

    function getAproveitamentoEnvelope() {
        return $this->aproveitamentoEnvelope;
    }

    function getDuplaFace() {
        return $this->duplaFace;
    }

    function getDobra() {
        return $this->dobra;
    }

    function getColagem() {
        return $this->colagem;
    }

    function setCod($cod) {
        $this->cod = $cod;
    }

    function setAproveitamentoCartao($aproveitamentoCartao) {
        $this->aproveitamentoCartao = $aproveitamentoCartao;
    }

    function setAproveitamentoEnvelope($aproveitamentoEnvelope) {
        $this->aproveitamentoEnvelope = $aproveitamentoEnvelope;
    }

    function setDuplaFace($duplaFace) {
        $this->duplaFace = $duplaFace;
    }

    function setDobra($dobra) {
        $this->dobra = $dobra;
    }

    function setColagem($colagem) {
        $this->colagem = $colagem;
    }

    function getMarkup() {
        return $this->markup;
    }

    function setMarkup($markup) {
        $this->markup = $markup;
    }

    function getObservacao() {
        return $this->observacao;
    }

    function setObservacao($observacao) {
        $this->observacao = $observacao;
    }
    function getEmpastamentoBorda() {
        return $this->empastamentoBorda;
    }

    function setEmpastamentoBorda($empastamentoBorda) {
        $this->empastamentoBorda = $empastamentoBorda;
    }
    function getEmpastamentoBordaEnv() {
        return $this->empastamentoBordaEnv;
    }

    function setEmpastamentoBordaEnv($empastamentoBordaEnv) {
        $this->empastamentoBordaEnv = $empastamentoBordaEnv;
    }

    
    
    public function selectConviteModelo($id) {
        $this->setIdModelo($id);
        $query = "SELECT * FROM `convite_modelo` WHERE `id` = $this->idModelo;";
        $resultado = $this->conexao->sql_query($query);
        return $resultado;
    }

    public function insertConviteModelo($cod, $nomeModelo, $alturaModelo, $larguraModelo, $aproveitamentoCartao, $aproveitamentoEnvelope, $formatoCartaoAltura, $formatoCartaoLargura, $formatoEnvelopeAltura, $formatoEnvelopeLargura, $composicao, $dobra, $duplaFace, $colagem, $markup, $observacao,$empastamentoBorda,$empastamentoBordaEnv) {
        $this->setCod($cod);
        $this->setNomeModelo($nomeModelo);
        $this->setAlturaModelo($alturaModelo);
        $this->setLarguraModelo($larguraModelo);
        $this->setAproveitamentoCartao($aproveitamentoCartao);
        $this->setAproveitamentoEnvelope($aproveitamentoEnvelope);
        $this->setFormatoCartaoAltura($formatoCartaoAltura);
        $this->setFormatoCartaoLargura($formatoCartaoLargura);
        $this->setFormatoEnvelopeAltura($formatoEnvelopeAltura);
        $this->setFormatoEnvelopeLargura($formatoEnvelopeLargura);
        $this->setComposicao($composicao);
        $this->setDobra($dobra);
        $this->setDuplaFace($duplaFace);
        $this->setColagem($colagem);
        $this->setEmpastamentoBorda($empastamentoBorda);
        $this->setEmpastamentoBordaEnv($empastamentoBordaEnv);
        $this->setMarkup($markup);
        $this->setObservacao($observacao);
        $query = "INSERT INTO convite_modelo(id, nome, altura, largura, formato_cartao_altura, formato_cartao_largura, formato_envelope_altura, formato_envelope_largura, folha_unica, formato_cartao, formato_envelope, cod, colagem_pva, dupla_face, dobra,markup, observacao,empastamento_borda,empastamento_borda_envelope) VALUES ('','$this->nomeModelo','$this->alturaModelo','$this->larguraModelo','$this->formatoCartaoAltura','$this->formatoCartaoLargura','$this->formatoEnvelopeAltura','$this->formatoEnvelopeLargura','$this->composicao','$this->aproveitamentoCartao','$this->aproveitamentoEnvelope','$this->cod','$this->colagem','$this->duplaFace','$this->dobra','$this->markup','$this->observacao','$this->empastamentoBorda','$this->empastamentoBordaEnv');";
        print $this->conexao->sql_query($query);
    }

    public function updateConviteModelo($id, $cod, $nomeModelo, $alturaModelo, $larguraModelo, $aproveitamentoCartao, $aproveitamentoEnvelope, $formatoCartaoAltura, $formatoCartaoLargura, $formatoEnvelopeAltura, $formatoEnvelopeLargura, $composicao, $dobra, $duplaFace, $colagem, $markup, $observacao,$empastamentoBorda,$empastamentoBordaEnv) {
        $this->setCod($cod);
        $this->setNomeModelo($nomeModelo);
        $this->setAlturaModelo($alturaModelo);
        $this->setLarguraModelo($larguraModelo);
        $this->setAproveitamentoCartao($aproveitamentoCartao);
        $this->setAproveitamentoEnvelope($aproveitamentoEnvelope);
        $this->setFormatoCartaoAltura($formatoCartaoAltura);
        $this->setFormatoCartaoLargura($formatoCartaoLargura);
        $this->setFormatoEnvelopeAltura($formatoEnvelopeAltura);
        $this->setFormatoEnvelopeLargura($formatoEnvelopeLargura);
        $this->setComposicao($composicao);
        $this->setDobra($dobra);
        $this->setDuplaFace($duplaFace);
        $this->setColagem($colagem);
        $this->setEmpastamentoBorda($empastamentoBorda);
        $this->setEmpastamentoBordaEnv($empastamentoBordaEnv);
        $this->setMarkup($markup);
        $this->setObservacao($observacao);
        $query = "UPDATE `convite_modelo` SET `nome` = '$this->nomeModelo',`cod` = '$this->cod',`altura` = '$this->alturaModelo',`largura` = '$this->larguraModelo',`formato_cartao` = '$this->aproveitamentoCartao',`formato_envelope` = '$this->aproveitamentoEnvelope',`formato_cartao_altura` = '$this->formatoCartaoAltura',`formato_cartao_largura` = '$this->formatoCartaoLargura',`formato_envelope_altura` = '$this->formatoEnvelopeAltura',`formato_envelope_largura` = '$this->formatoEnvelopeLargura',`dobra` = '$this->dobra',`dupla_face` = '$this->duplaFace',`colagem_pva` = '$this->colagem',`markup` = '$this->markup',`empastamento_borda` = '$this->empastamentoBorda',`empastamento_borda_envelope` = '$this->empastamentoBordaEnv',`observacao` = '$this->observacao',`folha_unica` = '$this->composicao' WHERE  `convite_modelo`.`id` =$id;";
        print $this->conexao->sql_query($query);
    }

    public function deleteConviteModelo($id) {
        $this->setIdModelo($id);
        $query = "DELETE FROM `convite_modelo` WHERE `convite_modelo`.`id` = $this->idModelo";
        print $this->conexao->sql_query($query);
    }

}
