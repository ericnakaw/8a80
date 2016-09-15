<?php

class FuncionarioDao {

    public function select($id, $mysqli) {
        $query = "SELECT id, nome, sobrenome, cargo, ativo, nivel, usuario FROM funcionario WHERE id = {$id}";
        $result = $mysqli->query($query);
        $tabela = mysqli_fetch_assoc($result);
        return $tabela;
    }

}
