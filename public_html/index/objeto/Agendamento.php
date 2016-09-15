<?php

class Agendamento {

    private $id;
    private $nome1;
    private $nome2;
    private $evento;
    private $data;
    private $hora;
    private $local;
    private $data_evento;
    private $telefone;
    private $observacao;
    private $atendimento;

    function __construct($id, $nome1, $nome2, $evento, $data, $hora, $local, $data_evento, $telefone, $observacao, $atendimento) {
        $this->id = $id;
        $this->nome1 = $nome1;
        $this->nome2 = $nome2;
        $this->evento = $evento;
        $this->data = $data;
        $this->hora = $hora;
        $this->local = $local;
        $this->data_evento = $data_evento;
        $this->telefone = $telefone;
        $this->observacao = $observacao;
        $this->atendimento = $atendimento;
    }
    function getAtendimento() {
        return $this->atendimento;
    }

    function setAtendimento($atendimento) {
        $this->atendimento = $atendimento;
    }

        
    function getId() {
        return $this->id;
    }

    function getNome1() {
        return $this->nome1;
    }

    function getNome2() {
        return $this->nome2;
    }

    function getEvento() {
        return $this->evento;
    }

    function getData() {
        return $this->data;
    }

    function getHora() {
        return $this->hora;
    }

    function getLocal() {
        return $this->local;
    }

    function getData_evento() {
        return $this->data_evento;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getObservacao() {
        return $this->observacao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome1($nome1) {
        $this->nome1 = $nome1;
    }

    function setNome2($nome2) {
        $this->nome2 = $nome2;
    }

    function setEvento($evento) {
        $this->evento = $evento;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setLocal($local) {
        $this->local = $local;
    }

    function setData_evento($data_evento) {
        $this->data_evento = $data_evento;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

}
