<?php

class ClienteDao {

    private $idCliente = NULL;

    function getIdCliente() {
        return $this->idCliente;
    }

    public function insert(Cliente $cliente, $mysqli) {
        $queryError = NULL;
        $query = "INSERT INTO cliente(data_evento, evento_tipo, rua, numero, complemento, estado, bairro, cidade, cep, observacao) "
                . "VALUES ('{$cliente->getDataEvento()}','{$cliente->getEvento()}','{$cliente->getRua()}','{$cliente->getNumero()}','{$cliente->getComplemento()}','{$cliente->getEstado()}','{$cliente->getBairro()}','{$cliente->getCidade()}','{$cliente->getCep()}','{$cliente->getObservacao()}')";
        if (!$verificaQuery = $mysqli->query($query)) {
            $queryError = $query;
            return $queryError;
        }
        $this->idCliente = $mysqli->insert_id;
        $cliente->setIdCliente($this->idCliente);
        return $queryError;
    }

    public function select($id, $mysqli) {
        $query = "SELECT id_cliente, date_format(data_evento,'%d/%m/%Y') as data_evento, evento_tipo, rua, numero, complemento, estado, bairro, cidade, cep, observacao FROM cliente WHERE id_cliente = {$id}";
        $result = $mysqli->query($query);
        $tabela = mysqli_fetch_assoc($result);
        return $tabela;
    }

    public function update(Cliente $cliente, $mysqli) {
        $queryError = NULL;
        $query = "UPDATE cliente SET
                    data_evento= '{$cliente->getDataEvento()}',
                    evento_tipo= '{$cliente->getEvento()}',
                    rua= '{$cliente->getRua()}',
                    numero= '{$cliente->getNumero()}',
                    complemento= '{$cliente->getComplemento()}',
                    estado= '{$cliente->getEstado()}',
                    bairro= '{$cliente->getBairro()}',
                    cidade= '{$cliente->getCidade()}',
                    cep= '{$cliente->getCep()}',
                    observacao= '{$cliente->getObservacao()}'
                    WHERE id_cliente = {$cliente->getIdCliente()}";
        if (!$verificaQuery = $mysqli->query($query)) {
            $queryError = $query;
            return $queryError;
        }
        $this->idCliente = $cliente->getIdCliente();
        $cliente->setIdCliente($this->idCliente);
        return $queryError;
    }

}
