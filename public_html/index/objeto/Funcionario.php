<?php

class Funcionario {

    private $idFuncionario;
    private $nomeFuncionario;
    private $sobrenomeFuncionario;
    private $cargoFuncionario;
    private $ativoFuncionario;
    private $nivelFuncionario;
    private $usuario;
    private $senhaFuncionario;
    private $conexao;

    function getUsuario() {
        return $this->usuario;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function __construct($conexao) {
        $this->conexao = $conexao;
    }

    function getSenhaFuncionario() {
        return $this->senhaFuncionario;
    }

    function setSenhaFuncionario($senhaFuncionario) {
        $this->senhaFuncionario = $senhaFuncionario;
    }

    function getAtivoFuncionario() {
        return $this->ativoFuncionario;
    }

    function getNivelFuncionario() {
        return $this->nivelFuncionario;
    }

    function setAtivoFuncionario($ativoFuncionario) {
        $this->ativoFuncionario = $ativoFuncionario;
    }

    function setNivelFuncionario($nivelFuncionario) {
        $this->nivelFuncionario = $nivelFuncionario;
    }

    public function getIdFuncionario() {
        return $this->idFuncionario;
    }

    public function getNomeFuncionario() {
        return $this->nomeFuncionario;
    }

    public function getSobrenomeFuncionario() {
        return $this->sobrenomeFuncionario;
    }

    public function getCargoFuncionario() {
        return $this->cargoFuncionario;
    }

    public function getConexao() {
        return $this->conexao;
    }

    public function setIdFuncionario($idFuncionario) {
        $this->idFuncionario = $idFuncionario;
    }

    public function setNomeFuncionario($nomeFuncionario) {
        $this->nomeFuncionario = $nomeFuncionario;
    }

    public function setSobrenomeFuncionario($sobrenomeFuncionario) {
        $this->sobrenomeFuncionario = $sobrenomeFuncionario;
    }

    public function setCargoFuncionario($cargoFuncionario) {
        $this->cargoFuncionario = $cargoFuncionario;
    }

    public function setConexao($conexao) {
        $this->conexao = $conexao;
    }

    public function selectFuncionario($id) {
        $this->setIdFuncionario($id);
        $query = "SELECT * FROM `funcionario` WHERE `id` = $this->idFuncionario;";
        $resultado = $this->conexao->sql_query($query);
        return $resultado;
    }

    public function insertFuncionario($nome, $sobrenome, $cargo, $nivel, $ativo, $usuario) {
        $this->setNomeFuncionario($nome);
        $this->setSobrenomeFuncionario($sobrenome);
        $this->setCargoFuncionario($cargo);
        $this->setNivelFuncionario($nivel);
        $this->setAtivoFuncionario($ativo);
        $this->setUsuario($usuario);
        $query = "INSERT INTO `funcionario` (nome,sobrenome,cargo, ativo, nivel, usuario)VALUES ('$this->nomeFuncionario','$this->sobrenomeFuncionario','$this->cargoFuncionario', '$this->ativoFuncionario', '$this->nivelFuncionario', '$this->usuario');";
        print $this->conexao->sql_query($query);
    }

    public function updateFuncionario($id, $nome, $sobrenome, $cargo, $ativo, $nivel, $usuario) {
        $this->setIdFuncionario($id);
        $this->setNomeFuncionario($nome);
        $this->setSobrenomeFuncionario($sobrenome);
        $this->setCargoFuncionario($cargo);
        $this->setAtivoFuncionario($ativo);
        $this->setNivelFuncionario($nivel);
        $this->setUsuario($usuario);
        $query = "UPDATE `funcionario` SET `nome` = '$this->nomeFuncionario',`sobrenome` = '$this->sobrenomeFuncionario',`cargo` = '$this->cargoFuncionario',`ativo` = '$this->ativoFuncionario',`nivel` = '$this->nivelFuncionario',`usuario` = '$this->usuario' WHERE  `funcionario`.`id` =$this->idFuncionario;";
        print $this->conexao->sql_query($query);
    }

    public function updateSenhaFuncionario($usuario, $senha) {
        $this->setUsuario($usuario);
        $this->setSenhaFuncionario(sha1($senha));
        $this->setAtivoFuncionario(1);
        $query = "UPDATE `funcionario` SET `senha` = '$this->senhaFuncionario', ativo = '$this->ativoFuncionario' WHERE `usuario` = '$this->usuario';";
        print $this->conexao->sql_query($query);
    }

    public function deleteFuncionario($id) {
        $this->setIdFuncionario($id);
        $query = "DELETE FROM `funcionario` WHERE `funcionario`.`id` = $this->idFuncionario";
        print $this->conexao->sql_query($query);
    }

}
