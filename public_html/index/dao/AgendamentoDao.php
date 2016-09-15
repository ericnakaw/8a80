<?php

class AgendamentoDao {

    public function selectAll($mysqli) {
        $query = "SELECT * FROM agenda";
        $result = $mysqli->query($query);
        return $result;
    }

    public function select($id, $mysqli) {
        $query = "SELECT * FROM agenda where id = $id";
        $result = $mysqli->query($query);
        $tabela = mysqli_fetch_assoc($result);
        return $tabela;
    }

    public function selectCalendar($dia, $local, $mysqli) {
        $query = "SELECT * FROM agenda where data = '$dia' AND local = '$local' ORDER BY hora";
        $result = $mysqli->query($query);
        return $result;
    }

    public function insert(Agendamento $agendamento, $mysqli) {
        $query = "INSERT INTO `agenda` (`id`, `data`, `hora`, `local`, `nome_1`, `nome_2`, `evento`, `data_evento`, `telefone`, `observacao`, `atendimento`)"
                . "VALUES (NULL, '{$_POST["data"]}', '{$_POST["hora"]}', '{$_POST["local"]}', '{$_POST["nome1"]}', '{$_POST["nome2"]}', '{$_POST["evento"]}', '{$_POST["data_evento"]}', '{$_POST["telefone"]}', '{$_POST["observacao"]}', '{$_POST["atendimento"]}')";
        $result = $mysqli->query($query);
        if ($result = TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update(Agendamento $agendamento, $mysqli) {
        $query = "UPDATE agenda SET 
                    data = '{$agendamento->getData()}',
                    hora = '{$agendamento->getHora()}',
                    local = '{$agendamento->getLocal()}',
                    nome_1 = '{$agendamento->getNome1()}',
                    nome_2 = '{$agendamento->getNome2()}',
                    evento = '{$agendamento->getEvento()}',
                    data_evento = '{$agendamento->getData_evento()}',
                    telefone = '{$agendamento->getTelefone()}',
                    observacao = '{$agendamento->getObservacao()}', 
                    atendimento = '{$agendamento->getAtendimento()}' 
                    WHERE id = {$agendamento->getId()}";
        $result = $mysqli->query($query);
        if ($result = TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete($id, $mysqli) {
        $query = "DELETE FROM agenda WHERE id = $id";
        $result = $mysqli->query($query);
        if ($result = TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
