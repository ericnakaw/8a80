<?php

class StatusPedido {

    private $idStatus;
    private $nomeStatus;

    function __construct($nomeStatus) {
        $this->nomeStatus = $nomeStatus;
    }

    public function getIdStatus() {
        return $this->idStatus;
    }

    public function getNomeStatus() {
        return $this->nomeStatus;
    }

    public function setNomeStatus($nomeStatus) {
        $this->nomeStatus = $nomeStatus;
    }

    public function selectStatusPedido() {
        //put your code here        
    }

    public function insertStatusPedido() {
        //put your code here        
    }

    public function updateStatusPedido() {
        //put your code here        
    }

    public function deleteStatusPedido() {
        //put your code here        
    }

}
