<?php

class Catalogo {

    private $id_catalogo;
    private $id_convite;
    private $pagina;
    private $item;

    function __construct($id_catalogo, $id_convite, $pagina, $item) {
        $this->id_catalogo = $id_catalogo;
        $this->id_convite = $id_convite;
        $this->pagina = $pagina;
        $this->item = $item;
    }

    function getId_catalogo() {
        return $this->id_catalogo;
    }

    function getId_convite() {
        return $this->id_convite;
    }

    function getPagina() {
        return $this->pagina;
    }

    function getItem() {
        return $this->item;
    }

}
