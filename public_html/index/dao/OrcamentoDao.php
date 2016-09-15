<?php

class OrcamentoDao {

    private $idOrcamento = NULL;

    function getIdOrcamento() {
        return $this->idOrcamento;
    }

    public function insert(Orcamento $orcamento, $mysqli) {
        $queryError = NULL;

        $query = "INSERT INTO orcamento(id_funcionario, id_cliente, data_orcamento, status, local_venda) "
                . "VALUES ('{$orcamento->getIdFuncionario()}','{$orcamento->getIdCliente()}','{$orcamento->getDataOrcamento()}','{$orcamento->getStatus()}','{$orcamento->getLocalOrcamento()}')";
        if (!$verificaQuery = $mysqli->query($query)) {
            $queryError = $query;
            return $queryError;
        }
        $this->idOrcamento = $mysqli->insert_id;
        $orcamento->setIdOrcamento($this->idOrcamento);
        return $queryError;
    }

    public function select($id, $mysqli) {
        $query = "SELECT id_orcamento, id_funcionario, funcionario.nome as func_nome , funcionario.sobrenome as func_sobrenome, id_cliente, date_format(data_orcamento,'%d/%m/%Y %T') as data_orcamento, status, local_venda FROM orcamento left join funcionario on  orcamento.id_funcionario = funcionario.id where id_orcamento = {$id}";
        $result = $mysqli->query($query);
        $tabela = mysqli_fetch_assoc($result);
        return $tabela;
    }

    public function selectCliente($id, $mysqli) {
        $query = "SELECT id_orcamento, id_funcionario, funcionario.nome as func_nome , funcionario.sobrenome as func_sobrenome, id_cliente, date_format(data_orcamento,'%d/%m/%Y %T') as data_orcamento, status, local_venda FROM orcamento left join funcionario on  orcamento.id_funcionario = funcionario.id where id_cliente = {$id}";
        $result = $mysqli->query($query);
        while ($tabela = mysqli_fetch_assoc($result)) {
            $orcamentos[] = $tabela;
        }
        return $orcamentos;
    }
}
