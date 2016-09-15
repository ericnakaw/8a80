<?php

class PedidoDao {

    private $idPedido = NULL;

    function getIdPedido() {
        return $this->idPedido;
    }

    public function insert(Pedido $pedido, $mysqli) {
        $queryError = NULL;

        $query = "INSERT INTO pedido(id_funcionario, id_cliente, local_retirada, data_pedido, status, pedido_tipo, local_venda) "
                . "VALUES ('{$pedido->getIdFuncionario()}','{$pedido->getIdCliente()}','{$pedido->getLocalRetirada()}','{$pedido->getDataPedido()}','{$pedido->getStatus()}','{$pedido->getPedidoTipo()}','{$pedido->getLocalVenda()}')";
        if (!$verificaQuery = $mysqli->query($query)) {
            $queryError = $query;
            return $queryError;
        }
        $this->idPedido = $mysqli->insert_id;
        $pedido->setIdPedido($this->idPedido);
        return $queryError;
    }

    public function select($id, $mysqli) {
        $query = "SELECT id_pedido, id_funcionario, funcionario.nome as func_nome , funcionario.sobrenome as func_sobrenome, id_cliente, local_retirada, date_format(data_pedido,'%d/%m/%Y %T') as data_pedido, status, pedido_tipo,local_venda FROM pedido left join funcionario on  pedido.id_funcionario = funcionario.id where id_pedido = {$id}";
        $result = $mysqli->query($query);
        $tabela = mysqli_fetch_assoc($result);
        return $tabela;
    }

}
