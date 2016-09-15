<?php

include './CartaoConvite.php';
include './EnvelopeConvite.php';
include './Modelo.php';

class CartaoEnvelope {

    private $idCartaoEnvelope;
    private $modelo;
    private $cartaoConvite;
    private $envelopeConvite;

    public function getIdCartaoEnvelope() {
        return $this->idCartaoEnvelope;
    }

    public function getModelo() {
        return $this->modelo;
    }

    public function getCartaoConvite() {
        return $this->cartaoConvite;
    }

    public function getEnvelopeConvite() {
        return $this->envelopeConvite;
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    public function setCartaoConvite($cartaoConvite) {
        $this->cartaoConvite = $cartaoConvite;
    }

    public function setEnvelopeConvite($envelopeConvite) {
        $this->envelopeConvite = $envelopeConvite;
    }

    public function selectCartaoEnvelope() {
    //put your code here    
    }
    public function insertCartaoEnvelope() {
    //put your code here    
    }
    public function updateCartaoEnvelope() {
    //put your code here    
    }
    public function deleteCartaoEnvelope() {
    //put your code here    
    }
    
}
