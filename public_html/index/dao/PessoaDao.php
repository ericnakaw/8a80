<?php

class PessoaDao {

    private $idPessoa = NULL;

    function getIdPessoa() {
        return $this->idPessoa;
    }

    public function insert(Pessoa $pessoa, $mysqli) {
        $queryError = NULL;

        $query = "INSERT INTO pessoa(nome, sobrenome, email, telefone, celular, cpf, rg, id_cliente) "
                . "VALUES ('{$pessoa->getNome()}','{$pessoa->getSobrenome()}','{$pessoa->getEmail()}','{$pessoa->getTelefone()}','{$pessoa->getCelular()}','{$pessoa->getCpf()}','{$pessoa->getRg()}','{$pessoa->getIdCliente()}')";
        if (!$verificaQuery = $mysqli->query($query)) {
            $queryError = $query;
            return $queryError;
        }
        $this->idPessoa = $mysqli->insert_id;
        $pessoa->setIdPessoa($this->idPessoa);
        return $queryError;
    }

    public function select($id, $mysqli) {
        $query = "SELECT * FROM `pessoa` WHERE `id_cliente` = {$id}";
        $result = $mysqli->query($query);
        while ($tabela = mysqli_fetch_assoc($result)) {
            $pessoas[] = $tabela;
        }
        return $pessoas;
    }

    public function update(Pessoa $pessoa, $mysqli) {
        $queryError = NULL;
        print $query = "UPDATE pessoa SET 
                    nome = '{$pessoa->getNome()}',
                    sobrenome = '{$pessoa->getSobrenome()}',
                    email = '{$pessoa->getEmail()}',
                    telefone = '{$pessoa->getTelefone()}',
                    celular = '{$pessoa->getCelular()}',
                    cpf = '{$pessoa->getCpf()}',
                    rg = '{$pessoa->getRg()}' 
                    WHERE id_pessoa = {$pessoa->getIdPessoa()}";
        if (!$verificaQuery = $mysqli->query($query)) {
            $queryError = $query;
            return $queryError;
        }
        $this->idPessoa = $pessoa->getIdPessoa();
        return $queryError;
    }

}
