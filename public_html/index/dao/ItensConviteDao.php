<?php

class ItensConviteDao {

    private $idItem = NULL;

    function getIdItem() {
        return $this->idItem;
    }

    public function insert(ItensConvite $itensConvite, $mysqli) {
        $queryError = NULL;

        $query = "INSERT INTO itens_convite(id_pedido, quantidade, data_entrega, valor, id_convite, desconto_porcentagem, id_orcamento) "
                . "VALUES ('{$itensConvite->getIdPedido()}','{$itensConvite->getQuantidade()}','{$itensConvite->getDataEntrega()}','{$itensConvite->getValorUnitario()}','{$itensConvite->getIdConvite()}','{$itensConvite->getDesconto()}','{$itensConvite->getIdOrcamento()}')";
        if (!$verificaQuery = $mysqli->query($query)) {
            $queryError = $query;
            return $queryError;
        }
        $this->idItem = $mysqli->insert_id;
        $itensConvite->setIdItem($this->idItem);
        return $queryError;
    }

    public function select($id, $mysqli) {
        $query = "SELECT id_item, id_pedido, quantidade, data_entrega, valor, id_convite,cm.nome as modelo_nome, desconto_porcentagem 
                 FROM itens_convite
                 left join convite
                 on id_convite = convite.id
                 left join convite_modelo as cm
                 on id_modelo = cm.id
                 where id_pedido = {$id}";
        $result = $mysqli->query($query);
        while ($tabela = mysqli_fetch_assoc($result)) {
            $itens[] = $tabela;
        }
        return $itens;
    }

}
