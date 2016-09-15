<?php

class Fita {

    private $idFita;
    private $corFita;
    private $codigoFita;
    private $fabricanteFita;
    private $imagemFita;
    private $conexao;

    function __construct($conexao) {
        $this->conexao = $conexao;
    }

    function getImagemFita() {
        return $this->imagemFita;
    }

    function setImagemFita($imagemFita) {
        $this->imagemFita = $imagemFita;
    }

    function setIdFita($idFita) {
        $this->idFita = $idFita;
    }

    public function getIdFita() {
        return $this->idFita;
    }

    public function getCorFita() {
        return $this->corFita;
    }

    public function getCodigoFita() {
        return $this->codigoFita;
    }

    public function getFabricanteFita() {
        return $this->fabricanteFita;
    }

    public function setCorFita($corFita) {
        $this->corFita = $corFita;
    }

    public function setCodigoFita($codigoFita) {
        $this->codigoFita = $codigoFita;
    }

    public function setFabricanteFita($fabricanteFita) {
        $this->fabricanteFita = $fabricanteFita;
    }

    public function selectFita($id) {
        $this->setIdFita($id);
        $query = "SELECT * FROM `fita` WHERE `id` = $this->idFita";
        $resultado = $this->conexao->sql_query($query);
        return $resultado;
    }

    public function insertFita($cor, $codigo, $fabricante, $imagemFita) {
        $this->setCorFita($cor);
        $this->setCodigoFita($codigo);
        $this->setFabricanteFita($fabricante);
        $this->setImagemFita($imagemFita);
        $query = "INSERT INTO `fita` (cor,codigo,fabricante,imagem)VALUES ('$this->corFita','$this->codigoFita','$this->fabricanteFita','$this->imagemFita');";
        print $this->conexao->sql_query($query);
    }

    public function updateFita($id, $cor, $codigo, $fabricante, $imagemFita,$target_dir) {
        $this->setIdFita($id);
        $this->setCorFita($cor);
        $this->setCodigoFita($codigo);
        $this->setFabricanteFita($fabricante);
        $this->setImagemFita($imagemFita);
        //verifica se há o endereço na variavel $imagemFita não tem o nome da imagem
        if ($this->imagemFita == $target_dir) {
            $query = "UPDATE `fita` SET `cor` = '$this->corFita',`codigo` =  '$this->codigoFita',`fabricante` =  '$this->fabricanteFita' WHERE  `fita`.`id` =$id;";
        } else {
            $query = "UPDATE `fita` SET `cor` = '$this->corFita',`codigo` =  '$this->codigoFita',`imagem` =  '$this->imagemFita',`fabricante` =  '$this->fabricanteFita' WHERE  `fita`.`id` =$id;";
        }
        print $this->conexao->sql_query($query);
    }

    public function deleteFita($id) {
        $this->setIdFita($id);
        $query = "DELETE FROM `fita` WHERE `fita`.`id` = $this->idFita";
        print $this->conexao->sql_query($query);
    }

}
