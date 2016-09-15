<?php

class ItensConviteOrcamentoDao {

    private $idItem = NULL;

    function getIdItem() {
        return $this->idItem;
    }

    public function insert(ItensConviteOrcamento $itensConviteOrcamento, $mysqli) {
        $queryError = NULL;

        $query = "INSERT INTO itens_convite_orcamento(id_orcamento, quantidade, valor, id_convite, desconto_porcentagem) "
                . "VALUES ('{$itensConviteOrcamento->getIdOrcamento()}','{$itensConviteOrcamento->getQuantidade()}','{$itensConviteOrcamento->getValorUnitario()}','{$itensConviteOrcamento->getIdConvite()}','{$itensConviteOrcamento->getDesconto()}')";
        //print $query;
        //die();
        if (!$verificaQuery = $mysqli->query($query)) {
            $queryError = $query;
            return $queryError;
        }
        $this->idItem = $mysqli->insert_id;
        $itensConviteOrcamento->setIdItem($this->idItem);
        return $queryError;
    }

    public function select($id, $mysqli) {
        $query = "SELECT id_item, id_orcamento, quantidade, valor, id_convite,cm.nome as modelo_nome, desconto_porcentagem
                 FROM itens_convite_orcamento
                 left join convite
                 on id_convite = convite.id
                 left join convite_modelo as cm
                 on id_modelo = cm.id
                 where id_orcamento = {$id}";
        $result = $mysqli->query($query);
        while ($tabela = mysqli_fetch_assoc($result)) {
            $itens[] = $tabela;
        }
        return $itens;
    }

}
