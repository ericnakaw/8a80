<?php

class LocalRetirada {

    private $idLocalRetirada;
    private $nomeLocalRetirada;

    function __construct($nomeLocalRetirada) {
        $this->nomeLocalRetirada = $nomeLocalRetirada;
    }

    public function getIdLocalRetirada() {
        return $this->idLocalRetirada;
    }

    public function getNomeLocalRetirada() {
        return $this->nomeLocalRetirada;
    }

    public function setNomeLocalRetirada($nomeLocalRetirada) {
        $this->nomeLocalRetirada = $nomeLocalRetirada;
    }

    public function selectLocalRetirada() {
        //put your code here        
    }

    public function insertLocalRetirada() {
        //put your code here        
    }

    public function updateLocalRetirada() {
        //put your code here        
    }

    public function deleteLocalRetirada() {
        //put your code here        
    }

}
