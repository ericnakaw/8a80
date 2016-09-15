<?php

class Formato {

    private $comprimento;
    private $largura;
    private $formato;
    private $papel_largura;
    private $papel_comprimento;
    private $quantidade_pedido;

    function __construct($largura, $comprimento, $formato, $papel_largura, $papel_comprimento, $quantidade_pedido) {
        $this->largura = $largura;
        $this->comprimento = $comprimento;
        $this->formato = $formato;
        $this->papel_largura = $papel_largura;
        $this->papel_comprimento = $papel_comprimento;
        $this->quantidade_pedido = $quantidade_pedido;
    }

    function getQuantidade_pedido() {
        return $this->quantidade_pedido;
    }

    function getComprimento() {
        return $this->comprimento;
    }

    function getLargura() {
        return $this->largura;
    }

    function getFormato() {
        return $this->formato;
    }

    function getPapel_largura() {
        return $this->papel_largura; 
    }

    function getPapel_comprimento() {
        return $this->papel_comprimento;
    } 

    function calculaFormato($inverter) {
        $formtato1 = intval(($this->getPapel_largura() / $this->getLargura())) * intval(($this->getPapel_comprimento() / $this->getComprimento()));
        $formtato2 = intval(($this->getPapel_comprimento() / $this->getLargura())) * intval(($this->getPapel_largura() / $this->getComprimento()));
        if ($formtato1 > $formtato2) {
            $formtato["a"] = intval(($this->getPapel_largura() / $this->getLargura()));
            $formtato["b"] = intval(($this->getPapel_comprimento() / $this->getComprimento()));
            $formtato["folha_inteira"] = ceil($this->getQuantidade_pedido() / $formtato1);
            if (($this->getPapel_comprimento() - ($formtato["a"] * $this->getLargura()))>= 0 && ($this->getPapel_largura() - ($formtato["b"] * $this->getComprimento())) >= 0) {
                $formtato["sobra_a"] = $this->getPapel_comprimento() - ($formtato["a"] * $this->getLargura());
                $formtato["sobra_b"] = $this->getPapel_largura() - ($formtato["b"] * $this->getComprimento());
            } else {
                $formtato["sobra_a"] = $this->getPapel_largura() - ($formtato["a"] * $this->getLargura());
                $formtato["sobra_b"] = $this->getPapel_comprimento() - ($formtato["b"] * $this->getComprimento());
            }
            print $formtato["sobra_a"];
            print "<br>" . $formtato["sobra_b"];
            //die();
            $formtato["formato"] = $formtato1; 
            return $formtato;
        } else {
            $formtato["a"] = intval(($this->getPapel_comprimento() / $this->getLargura()));
            $formtato["b"] = intval(($this->getPapel_largura() / $this->getComprimento()));
            $formtato["folha_inteira"] = ceil($this->getQuantidade_pedido() / $formtato2);
            if (($this->getPapel_comprimento() - ($formtato["a"] * $this->getLargura()))>= 0 && ($this->getPapel_largura() - ($formtato["b"] * $this->getComprimento())) >= 0) {
                $formtato["sobra_a"] = $this->getPapel_comprimento() - ($formtato["a"] * $this->getLargura());
                $formtato["sobra_b"] = $this->getPapel_largura() - ($formtato["b"] * $this->getComprimento());
            } else {
                $formtato["sobra_a"] = $this->getPapel_largura() - ($formtato["a"] * $this->getLargura());
                $formtato["sobra_b"] = $this->getPapel_comprimento() - ($formtato["b"] * $this->getComprimento());
            }
            print $formtato["sobra_a"];
            print "<br>" . $formtato["sobra_b"];
            //die();
            $formtato["formato"] = $formtato2;
            return $formtato;
        }
    }

}
