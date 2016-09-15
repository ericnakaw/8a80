<?php
include './Funcionario.php';
include './Cliente.php';
include './Pedido.php';
class Lancamento {

    private $idLancamento;
    private $funcionarioId;
    private $clienteId;
    private $pedidoId;
    private $dataLancamento;
    private $descricao;

    function __construct($funcionarioId, $clienteId, $pedidoId, $dataLancamento) {
        $this->funcionarioId = $funcionarioId;
        $this->clienteId = $clienteId;
        $this->pedidoId = $pedidoId;
        $this->dataLancamento = $dataLancamento;
    }

    public function getIdLancamento() {
        return $this->idLancamento;
    }

    public function getFuncionarioId() {
        return $this->funcionarioId;
    }

    public function getClienteId() {
        return $this->clienteId;
    }

    public function getPedidoId() {
        return $this->pedidoId;
    }

    public function getDataLancamento() {
        return $this->dataLancamento;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setFuncionarioId($funcionarioId) {
        $this->funcionarioId = $funcionarioId;
    }

    public function setClienteId($clienteId) {
        $this->clienteId = $clienteId;
    }

    public function setPedidoId($pedidoId) {
        $this->pedidoId = $pedidoId;
    }

    public function setDataLancamento($dataLancamento) {
        $this->dataLancamento = $dataLancamento;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function selectLancamento() {
        //put your code here        
    }

    public function insertLancamento() {
        //put your code here        
    }

    public function updateLancamento() {
        //put your code here        
    }

    public function deleteLancamento() {
        //put your code here        
    }

}
