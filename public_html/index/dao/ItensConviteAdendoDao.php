<?php

class ItensConviteAdendoDao {

    private $idItem = NULL;

    function getIdItem() {
        return $this->idItem;
    }

    public function insert(ItensConviteAdendo $itensConviteAdendo, $mysqli) {
        $queryError = NULL;
        $query = "INSERT INTO itens_convite_adendo(id_adendo, id_pedido, quantidade, valor, id_convite, desconto_porcentagem) VALUES ('{$itensConviteAdendo->getIdAdendo()}','{$itensConviteAdendo->getIdPedido()}','{$itensConviteAdendo->getQuantidade()}','{$itensConviteAdendo->getValorUnitario()}','{$itensConviteAdendo->getIdConvite()}','{$itensConviteAdendo->getDesconto()}')";
        print $query;
        die();
        if (!$verificaQuery = $mysqli->query($query)) {
            $queryError = $query;
            return $queryError;
        }
        $this->idItem = $mysqli->insert_id;
        $itensConviteAdendo->setIdItem($this->idItem);
        return $queryError;
    }

    public function select($id, $mysqli) {
        $query = "SELECT id_item, id_adendo, id_pedido, quantidade, valor, id_convite,cm.nome as modelo_nome, desconto_porcentagem
                 FROM itens_convite_adendo
                 left join convite
                 on id_convite = convite.id
                 left join convite_modelo as cm
                 on id_modelo = cm.id
                 where id_adendo = {$id}";
        $result = $mysqli->query($query);
        while ($tabela = mysqli_fetch_assoc($result)) {
            $itens[] = $tabela;
        }
        return $itens;
    }

}
