<?php

class Pessoa {

    private $idPessoa;
    private $nome;
    private $sobrenome;
    private $email;
    private $telefone;
    private $celular;
    private $rg;
    private $cpf;
    private $idCliente;

    function __construct($idCliente,$nome, $sobrenome, $email, $telefone, $celular, $rg, $cpf) {
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->celular = $celular;
        $this->rg = $rg;
        $this->cpf = $cpf;
        $this->idCliente = $idCliente;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getIdPessoa() {
        return $this->idPessoa;
    }

    function getNome() {
        return $this->nome;
    }

    function getSobrenome() {
        return $this->sobrenome;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getCelular() {
        return $this->celular;
    }

    function getRg() {
        return $this->rg;
    }

    function getCpf() {
        return $this->cpf;
    }

    function setIdPessoa($idPessoa) {
        $this->idPessoa = $idPessoa;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setRg($rg) {
        $this->rg = $rg;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

}
