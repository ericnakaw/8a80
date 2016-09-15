<?php

class AdendoDao {

    private $idAdendo = null;

    function getIdAdendo() {
        return $this->idAdendo;
    }

    public function insert(Adendo $adendo, $mysqli) {
        $queryError = NULL;

        $query = "INSERT INTO adendo(id_pedido,id_funcionario, id_cliente, local_retirada, data_adendo, status, local_venda) "
                . "VALUES ('{$adendo->getIdPedido()}','{$adendo->getIdFuncionario()}','{$adendo->getIdCliente()}','{$adendo->getLocalRetirada()}','{$adendo->getDataAdendo()}','{$adendo->getStatus()}','{$adendo->getLocalVenda()}')";
        if (!$verificaQuery = $mysqli->query($query)) {
            $queryError = $query;
            return $queryError;
        }
        $this->idAdendo = $mysqli->insert_id;
        $adendo->setIdAdendo($this->idAdendo);
        return $queryError;
    }

    public function select($id, $mysqli) {
        $query = "SELECT id_adendo,id_pedido, id_funcionario, funcionario.nome as func_nome , funcionario.sobrenome as func_sobrenome, id_cliente, local_retirada, date_format(data_adendo,'%d/%m/%Y %T') as data_adendo, status, local_venda FROM adendo left join funcionario on  adendo.id_funcionario = funcionario.id where id_adendo = {$id}";
        $result = $mysqli->query($query);
        $tabela = mysqli_fetch_assoc($result);
        return $tabela;
    }

}
