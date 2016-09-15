<?php

if (!isset($_SESSION)) {
    session_start();
}

class ConviteDao {

    private $idConvite = NULL;
    private $convite;

    function getConvite() {
        return $this->convite;
    }

    function getIdConvite() {
        return $this->idConvite;
    }

    public function insertConvite(Convite $convite, $mysqli, $folhaUnica) {

        $queryError = NULL;

        if ($convite->getIdModelo() !== null) {
            //[x]Convite: INSERT INTO `convite`(`id`, `id_modelo`, `descricao_cartao`, `descricao_envelope`) VALUES ([value-1],[value-2],[value-3],[value-4])
            $query = "INSERT INTO `convite`(`id_modelo`, `descricao_cartao`, `descricao_envelope`) VALUES ({$convite->getIdModelo()},'{$convite->getDetalheCartao()}','{$convite->getDetalheEnvelope()}')";
            //var_dump($query);
            if (!$verificaQuery = $mysqli->query($query)) {
                $queryError = $query;
                return $queryError;
            }
            $this->idConvite = $mysqli->insert_id;
            $convite->setIdConvite($this->idConvite);
        }
        foreach ($convite->getIdPapelCartao() as $key => $value) {
            if ($this->idConvite !== null && $convite->getIdPapelCartao() !== "" && $queryError == NULL) {
                if ($value["empastamento"] == NULL) {
                    $value["empastamento"] = 0;
                }
                //[x]Papel Cartao: INSERT INTO `cartao_papel`(`id_convite`, `id_papel`,) VALUES ([value-1],[value-2])
                $query = "INSERT INTO `cartao_papel`(`id_convite`, `id_papel`,`empastamento`) VALUES ({$this->idConvite},{$value["id"]},{$value["empastamento"]})";
                if (!$verificaQuery = $mysqli->query($query)) {
                    $queryError = $query;
                    return $queryError;
                }
            }
        }
        //[x]Impressao Cartao: INSERT INTO `cartao_impressao`(`id_convite`, `id_impressao`, `descricao`) VALUES ([value-1],[value-2],[value-3])
        foreach ($convite->getImpressaoCartao() as $key => $value) {
            if ($this->idConvite !== null && $value['id'] !== null && $queryError == NULL) {
                $query = "INSERT INTO `cartao_impressao`(`id_convite`, `id_impressao`, `descricao`) VALUES ({$this->idConvite},{$value['id']},'{$value['descricao']}')";
                //var_dump($query);
                if (!$verificaQuery = $mysqli->query($query)) {
                    $queryError = $query;
                    return $queryError;
                }
            }
        }

        //[x]Acabamento Cartao: INSERT INTO `cartao_acabamento`(`id_convite`, `id_acabamento`, `detalhe`) VALUES ([value-1],[value-2],[value-3])
        foreach ($convite->getAcabamentoCartao() as $key => $value) {
            if ($this->idConvite !== null && $value['id'] !== null && $queryError == NULL) {
                $query = "INSERT INTO `cartao_acabamento`(`id_convite`, `id_acabamento`, `detalhe`) VALUES ({$this->idConvite},{$value['id']},'{$value['descricao']}')";
                //var_dump($query);
                if (!$verificaQuery = $mysqli->query($query)) {
                    $queryError = $query;
                    return $queryError;
                }
            }
        }

        //[X]Fonte Cartao: INSERT INTO `cartao_fonte`(`id_convite`, `id_fonte`, `detalhe`) VALUES ([value-1],[value-2],[value-3])
        foreach ($convite->getFonteCartao() as $key => $value) {
            if ($this->idConvite !== null && $value['id'] !== null && $queryError == NULL) {
                $query = "INSERT INTO `cartao_fonte`(`id_convite`, `id_fonte`, `detalhe`) VALUES ({$this->idConvite},{$value['id']},'{$value['descricao']}')";
                //var_dump($query);
                if (!$verificaQuery = $mysqli->query($query)) {
                    $queryError = $query;
                    return $queryError;
                }
            }
        }

        //[X]Servico Cartao: INSERT INTO `cartao_servico`(`id_convite`, `id_servico`, `detalhe`) VALUES ([value-1],[value-2],[value-3])
        foreach ($convite->getServicoCartao() as $key => $value) {
            if ($this->idConvite !== null && $value['id'] !== null && $queryError == NULL) {
                $query = "INSERT INTO `cartao_servico`(`id_convite`, `id_servico`, `detalhe`) VALUES ({$this->idConvite},{$value['id']},'{$value['descricao']}')";
                //var_dump($query);
                if (!$verificaQuery = $mysqli->query($query)) {
                    $queryError = $query;
                    return $queryError;
                }
            }
        }

        //[X]Papel Envelope: INSERT INTO `envelope_papel`(`id_convite`, `id_papel`) VALUES ([value-1],[value-2])
        if ($this->idConvite !== null && $convite->getIdPapelEnvelope() !== "" && $queryError == NULL) {
            $query = "INSERT INTO `envelope_papel`(`id_convite`, `id_papel`) VALUES ({$this->idConvite},{$convite->getIdPapelEnvelope()})";
            //var_dump($query);
            if (!$verificaQuery = $mysqli->query($query)) {
                $queryError = $query;
                return $queryError;
            }
        }

        //[X]Impressao Envelope: INSERT INTO `envelope_impressao`(`id_convite`, `id_impressao`, `detalhe`) VALUES ([value-1],[value-2],[value-3])
        foreach ($convite->getImpressaoEnvelope() as $key => $value) {
            if ($this->idConvite !== null && $value['id'] !== null && $queryError == NULL) {
                $query = "INSERT INTO `envelope_impressao`(`id_convite`, `id_impressao`, `detalhe`) VALUES ({$this->idConvite},{$value['id']},'{$value['descricao']}')";
                //var_dump($query);
                if (!$verificaQuery = $mysqli->query($query)) {
                    $queryError = $query;
                    return $queryError;
                }
            }
        }
        //[X]Acabamento Envelope: INSERT INTO `envelope_acabamento`(`id_convite`, `id_acabamento`, `detalhe`) VALUES ([value-1],[value-2],[value-3])
        foreach ($convite->getAcabamentoEnvelope() as $key => $value) {
            if ($this->idConvite !== null && $value['id'] !== null && $queryError == NULL) {
                $query = "INSERT INTO `envelope_acabamento`(`id_convite`, `id_acabamento`, `detalhe`) VALUES ({$this->idConvite},{$value['id']},'{$value['descricao']}')";
                //var_dump($query);
                if (!$verificaQuery = $mysqli->query($query)) {
                    $queryError = $query;
                    return $queryError;
                }
            }
        }
        //[X]Fonte Envelope: INSERT INTO `envelope_fonte`(`id_convite`, `id_fonte`, `detalhe`) VALUES ([value-1],[value-2],[value-3])
        foreach ($convite->getFonteEnvelope() as $key => $value) {
            if ($this->idConvite !== null && $value['id'] !== null && $queryError == NULL) {
                $query = "INSERT INTO `envelope_fonte`(`id_convite`, `id_fonte`, `detalhe`) VALUES ({$this->idConvite},{$value['id']},'{$value['descricao']}')";
                //var_dump($query);
                if (!$verificaQuery = $mysqli->query($query)) {
                    $queryError = $query;
                    return $queryError;
                }
            }
        }
        //[X]Servico Envelope: INSERT INTO `envelope_servico`(`id_convite`, `id_servico`, `detalhe`) VALUES ([value-1],[value-2],[value-3])
        foreach ($convite->getServicoEnvelope() as $key => $value) {
            if ($this->idConvite !== null && $value['id'] !== null && $queryError == NULL) {
                $query = "INSERT INTO `envelope_servico`(`id_convite`, `id_servico`, `detalhe`) VALUES ({$this->idConvite},{$value['id']},'{$value['descricao']}')";
                //var_dump($query);
                if (!$verificaQuery = $mysqli->query($query)) {
                    $queryError = $query;
                    return $queryError;
                }
            }
        }
        //[X]Fita Envelope: INSERT INTO `envelope_fita`(`id_convite`, `id_fita_categoria`, `largura`, `id_fita`) VALUES ([value-1],[value-2],[value-3],[value-4])
        $fita = $convite->getFita();
        if (!empty($this->idConvite) && !empty($fita["id_laco"]) && empty($queryError)) {
            $query = "INSERT INTO `envelope_fita`(`id_convite`, `id_fita_categoria`, `largura`, `id_fita`) VALUES ({$this->idConvite},{$fita["id_laco"]},'{$fita["largura"]}','{$fita["id_fita"]}')";
            //var_dump($query);
            if (!$verificaQuery = $mysqli->query($query)) {
                $queryError = $query;
                return $queryError;
            }
        }
        //Retorna um ARRAY vazio se não der erro, e se der erro, retorna a query que ocasionou o erro 
        return $queryError;
    }

    public function selectConviteSessao($idConvite, $mysqli) {
        $query = "SELECT * FROM convite WHERE id = {$idConvite}";
        $result = $mysqli->query($query);
        $tabelaConvite = $result->fetch_assoc();
        $query = "SELECT * FROM convite_modelo where id = {$tabelaConvite['id_modelo']} ";
        $result = $mysqli->query($query);
        $tabelaModeloConvite = $result->fetch_assoc();
        $_SESSION['convite']['modelo'] = $tabelaModeloConvite["id"] . ':' . $tabelaModeloConvite["nome"] . ':' . $tabelaModeloConvite["folha_unica"] . ':' . $tabelaModeloConvite["formato_envelope"] . ':' . $tabelaModeloConvite["formato_cartao"] . ':' . $tabelaModeloConvite["colagem_pva"] . ':' . $tabelaModeloConvite["dupla_face"] . ':' . $tabelaModeloConvite["dobra"] . ':' . $tabelaModeloConvite["markup"] . ':' . $tabelaModeloConvite["empastamento_borda"] . ':' . $tabelaModeloConvite["empastamento_borda_envelope"] . ':' . $tabelaModeloConvite["formato_cartao_altura"] . ':' . $tabelaModeloConvite["formato_cartao_largura"] . ':' . $tabelaModeloConvite["formato_envelope_altura"] . ':' . $tabelaModeloConvite["formato_envelope_largura"];
        $_SESSION['convite']['cartao']['detalhe'] = $tabelaConvite["descricao_cartao"];
        $_SESSION['convite']['envelope']['detalhe'] = $tabelaConvite["descricao_envelope"];

        $query = "SELECT * FROM `cartao_acabamento` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        while ($tabelaCartaoAcabamento = mysqli_fetch_assoc($result)) {
            $query = "SELECT * FROM `acabamento` WHERE id = {$tabelaCartaoAcabamento["id_acabamento"]}";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $_SESSION['convite']['cartao']['acabamento'][] = $tabela['id'] . ':' . $tabela['nome'] . ':' . $tabela['valor'] . ':' . $tabelaCartaoAcabamento["detalhe"];
        }

        $query = "SELECT * FROM `cartao_fonte` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        while ($tabelaCartaoFonte = mysqli_fetch_assoc($result)) {
            $query = "SELECT * FROM `fonte` WHERE id = {$tabelaCartaoFonte['id_fonte']} ";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $_SESSION['convite']['cartao']['fonte'][] = $tabela["id"] . ':' . $tabela["nome"] . ':' . $tabelaCartaoFonte["detalhe"];
        }

        $query = "SELECT * FROM `cartao_impressao` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        while ($tabelaCartaoImpressao = mysqli_fetch_assoc($result)) {
            $query = "SELECT * FROM `impressao` WHERE id = {$tabelaCartaoImpressao["id_impressao"]} ";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $_SESSION['convite']['cartao']['impressao'][] = $tabela["id"] . ':' . $tabela["nome"] . ':' . $tabela["valor"] . ':' . $tabelaCartaoImpressao["descricao"];
        }
        $query = "SELECT * FROM `cartao_papel` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        if (mysqli_num_rows($result) > 0) {
            while ($tabelaCartaoPapel = mysqli_fetch_assoc($result)) {
                $query = "SELECT p.id, p.nome, cp.valor, cp.nome as categoria FROM papel p left join categoria_papel cp on p.categoria_papel_id = cp.id where p.id = {$tabelaCartaoPapel["id_papel"]}";
                $result1 = $mysqli->query($query);
                $tabela = $result1->fetch_assoc();
                $_SESSION['convite']['cartao']['papel'][] = $tabela["id"] . ':' . $tabela["nome"] . ':' . $tabela["valor"] . ':' . $tabela["categoria"] . ':' . $tabelaCartaoPapel["empastamento"];
            }
        }
        $query = "SELECT * FROM `cartao_servico` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        while ($tabelaCartaoServico = mysqli_fetch_assoc($result)) {
            $query = "SELECT * FROM `servico` WHERE id = {$tabelaCartaoServico["id_servico"]} ";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $_SESSION['convite']['cartao']['servico'][] = $tabela["id"] . ':' . $tabela["nome"] . ':' . $tabela["valor"] . ':' . $tabelaCartaoServico["detalhe"];
        }

        $query = "SELECT * FROM `envelope_acabamento` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        while ($tabelaEnvelopeAcabamento = mysqli_fetch_assoc($result)) {
            $query = "SELECT * FROM `acabamento` WHERE id = {$tabelaEnvelopeAcabamento["id_acabamento"]}";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $_SESSION['convite']['envelope']['acabamento'][] = $tabela['id'] . ':' . $tabela['nome'] . ':' . $tabela['valor'] . ':' . $tabelaEnvelopeAcabamento["detalhe"];
        }

        $query = "SELECT * FROM `envelope_fita` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        $tabelaEnvelopeFita = mysqli_fetch_assoc($result);
        $query = "SELECT * FROM fita_categoria where id = {$tabelaEnvelopeFita["id_fita_categoria"]} ";
        $result = $mysqli->query($query);
        if (mysqli_num_rows($result) > 0) {
            $tabelaFitaCategoria = mysqli_fetch_assoc($result);
            // Se o valor da tabela for "À definir" ou "Indefinido", não será executada a query abaixo e será utilizada o mesmo valor da tabela de ligação: `envelope_fita`
            if (is_numeric($tabelaEnvelopeFita["id_fita"])) {
                $query = "SELECT * FROM fita where id = {$tabelaEnvelopeFita["id_fita"]} ";
                $result = $mysqli->query($query);
                $tabelaFita = mysqli_fetch_assoc($result);
            } else {
                $tabelaFita['cor'] = $tabelaEnvelopeFita["id_fita"];
            }
            $_SESSION['convite']['envelope']['fita'] = $tabelaFitaCategoria['id'] . ':' . $tabelaFitaCategoria['nome'] . ':' . $tabelaFitaCategoria['valor'] . ':' . $tabelaFita['id'] . ':' . $tabelaFita['cor'] . ':' . $tabelaEnvelopeFita["largura"];
        }
        $query = "SELECT * FROM `envelope_fonte` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        while ($tabelaEnvelopeFonte = mysqli_fetch_assoc($result)) {
            $query = "SELECT * FROM `fonte` WHERE id = {$tabelaEnvelopeFonte['id_fonte']} ";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $_SESSION['convite']['envelope']['fonte'][] = $tabela["id"] . ':' . $tabela["nome"] . ':' . $tabelaEnvelopeFonte["detalhe"];
        }

        $query = "SELECT * FROM `envelope_impressao` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        while ($tabelaEnvelopeImpressao = mysqli_fetch_assoc($result)) {
            $query = "SELECT * FROM `impressao` WHERE id = {$tabelaEnvelopeImpressao["id_impressao"]} ";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $_SESSION['convite']['envelope']['impressao'][] = $tabela["id"] . ':' . $tabela["nome"] . ':' . $tabela["valor"] . ':' . $tabelaEnvelopeImpressao["detalhe"];
        }
        $query = "SELECT * FROM `envelope_papel` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        if (mysqli_num_rows($result) > 0) {
            $tabelaEnvelopePapel = $result->fetch_assoc();
            $query = "SELECT p.id, p.nome, cp.valor, cp.nome as categoria FROM papel p left join categoria_papel cp on p.categoria_papel_id = cp.id where p.id = {$tabelaEnvelopePapel["id_papel"]}";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $_SESSION['convite']['envelope']['papel'] = $tabela["id"] . ':' . $tabela["nome"] . ':' . $tabela["valor"] . ':' . $tabela["categoria"];
        }

        $query = "SELECT * FROM `envelope_servico` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        while ($tabelaEnvelopeServico = mysqli_fetch_assoc($result)) {
            $query = "SELECT * FROM `servico` WHERE id = {$tabelaEnvelopeServico["id_servico"]} ";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $_SESSION['convite']['envelope']['servico'][] = $tabela["id"] . ':' . $tabela["nome"] . ':' . $tabela["valor"] . ':' . $tabelaEnvelopeServico["detalhe"];
        }
    }

    public function selectConvite($idConvite, $mysqli) {
        $query = "SELECT * FROM convite WHERE id = {$idConvite}";
        $result = $mysqli->query($query);
        $tabelaConvite = $result->fetch_assoc();
        $query = "SELECT * FROM convite_modelo where id = {$tabelaConvite['id_modelo']} ";
        $result = $mysqli->query($query);
        $tabelaModeloConvite = $result->fetch_assoc();

        $modelo = $tabelaModeloConvite["id"] . ':' . $tabelaModeloConvite["nome"] . ':' . $tabelaModeloConvite["folha_unica"] . ':' . $tabelaModeloConvite["formato_envelope"] . ':' . $tabelaModeloConvite["formato_cartao"] . ':' . $tabelaModeloConvite["colagem_pva"] . ':' . $tabelaModeloConvite["dupla_face"] . ':' . $tabelaModeloConvite["dobra"] . ':' . $tabelaModeloConvite["markup"] . ':' . $tabelaModeloConvite["empastamento_borda"] . ':' . $tabelaModeloConvite["empastamento_borda_envelope"] . ':' . $tabelaModeloConvite["formato_cartao_altura"] . ':' . $tabelaModeloConvite["formato_cartao_largura"] . ':' . $tabelaModeloConvite["formato_envelope_altura"] . ':' . $tabelaModeloConvite["formato_envelope_largura"];
        $cartaoDetalhe = $tabelaConvite["descricao_cartao"];
        $envelopeDetalhe = $tabelaConvite["descricao_envelope"];

        $query = "SELECT * FROM `cartao_acabamento` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        while ($tabelaCartaoAcabamento = mysqli_fetch_assoc($result)) {
            $query = "SELECT * FROM `acabamento` WHERE id = {$tabelaCartaoAcabamento["id_acabamento"]}";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $cartaoAcabamento[] = $tabela['id'] . ':' . $tabela['nome'] . ':' . $tabela['valor'] . ':' . $tabelaCartaoAcabamento["detalhe"];
        }

        $query = "SELECT * FROM `cartao_fonte` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        while ($tabelaCartaoFonte = mysqli_fetch_assoc($result)) {
            $query = "SELECT * FROM `fonte` WHERE id = {$tabelaCartaoFonte['id_fonte']} ";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $cartaoFonte[] = $tabela["id"] . ':' . $tabela["nome"] . ':' . $tabelaCartaoFonte["detalhe"];
        }

        $query = "SELECT * FROM `cartao_impressao` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        while ($tabelaCartaoImpressao = mysqli_fetch_assoc($result)) {
            $query = "SELECT * FROM `impressao` WHERE id = {$tabelaCartaoImpressao["id_impressao"]} ";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $cartaoImpressao[] = $tabela["id"] . ':' . $tabela["nome"] . ':' . $tabela["valor"] . ':' . $tabelaCartaoImpressao["descricao"];
        }
        $query = "SELECT * FROM `cartao_papel` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        if (mysqli_num_rows($result) > 0) {
            while ($tabelaCartaoPapel = mysqli_fetch_assoc($result)) {
                $query = "SELECT p.id, p.nome, cp.valor, cp.nome as categoria FROM papel p left join categoria_papel cp on p.categoria_papel_id = cp.id where p.id = {$tabelaCartaoPapel["id_papel"]}";
                $result1 = $mysqli->query($query);
                $tabela = $result1->fetch_assoc();
                $cartaoPapel[] = $tabela["id"] . ':' . $tabela["nome"] . ':' . $tabela["valor"] . ':' . $tabela["categoria"] . ':' . $tabelaCartaoPapel["empastamento"];
            }
        }
        $query = "SELECT * FROM `cartao_servico` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        while ($tabelaCartaoServico = mysqli_fetch_assoc($result)) {
            $query = "SELECT * FROM `servico` WHERE id = {$tabelaCartaoServico["id_servico"]} ";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $cartaoServico[] = $tabela["id"] . ':' . $tabela["nome"] . ':' . $tabela["valor"] . ':' . $tabelaCartaoServico["detalhe"];
        }

        $query = "SELECT * FROM `envelope_acabamento` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        while ($tabelaEnvelopeAcabamento = mysqli_fetch_assoc($result)) {
            $query = "SELECT * FROM `acabamento` WHERE id = {$tabelaEnvelopeAcabamento["id_acabamento"]}";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $envelopeAcabamento[] = $tabela['id'] . ':' . $tabela['nome'] . ':' . $tabela['valor'] . ':' . $tabelaEnvelopeAcabamento["detalhe"];
        }

        $query = "SELECT * FROM `envelope_fita` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        $tabelaEnvelopeFita = mysqli_fetch_assoc($result);
        $query = "SELECT * FROM fita_categoria where id = {$tabelaEnvelopeFita["id_fita_categoria"]} ";
        $result = $mysqli->query($query);
        if (mysqli_num_rows($result) !== null) {
            $tabelaFitaCategoria = mysqli_fetch_assoc($result);
            // Se o valor da tabela for "À definir" ou "Indefinido", não será executada a query abaixo e será utilizada o mesmo valor da tabela de ligação: `envelope_fita`
            if (is_numeric($tabelaEnvelopeFita["id_fita"])) {
                $query = "SELECT * FROM fita where id = {$tabelaEnvelopeFita["id_fita"]} ";
                $result = $mysqli->query($query);
                $tabelaFita = mysqli_fetch_assoc($result);
            } else {
                $tabelaFita['cor'] = $tabelaEnvelopeFita["id_fita"];
            }
            $envelopeFita = $tabelaFitaCategoria['id'] . ':' . $tabelaFitaCategoria['nome'] . ':' . $tabelaFitaCategoria['valor'] . ':' . $tabelaFita['id'] . ':' . $tabelaFita['cor'] . ':' . $tabelaEnvelopeFita["largura"];
        }
        $query = "SELECT * FROM `envelope_fonte` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        while ($tabelaEnvelopeFonte = mysqli_fetch_assoc($result)) {
            $query = "SELECT * FROM `fonte` WHERE id = {$tabelaEnvelopeFonte['id_fonte']} ";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $envelopeFonte[] = $tabela["id"] . ':' . $tabela["nome"] . ':' . $tabelaEnvelopeFonte["detalhe"];
        }

        $query = "SELECT * FROM `envelope_impressao` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        while ($tabelaEnvelopeImpressao = mysqli_fetch_assoc($result)) {
            $query = "SELECT * FROM `impressao` WHERE id = {$tabelaEnvelopeImpressao["id_impressao"]} ";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $envelopeImpressao[] = $tabela["id"] . ':' . $tabela["nome"] . ':' . $tabela["valor"] . ':' . $tabelaEnvelopeImpressao["detalhe"];
        }

        $query = "SELECT * FROM `envelope_papel` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        if (mysqli_num_rows($result) > 0) {
            $tabelaEnvelopePapel = $result->fetch_assoc();
            $query = "SELECT p.id, p.nome, cp.valor, cp.nome as categoria FROM papel p left join categoria_papel cp on p.categoria_papel_id = cp.id where p.id = {$tabelaEnvelopePapel["id_papel"]}";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $envelopePapel = $tabela["id"] . ':' . $tabela["nome"] . ':' . $tabela["valor"] . ':' . $tabela["categoria"];
        }

        $query = "SELECT * FROM `envelope_servico` WHERE id_convite = {$idConvite}";
        $result = $mysqli->query($query);
        while ($tabelaEnvelopeServico = mysqli_fetch_assoc($result)) {
            $query = "SELECT * FROM `servico` WHERE id = {$tabelaEnvelopeServico["id_servico"]} ";
            $result1 = $mysqli->query($query);
            $tabela = $result1->fetch_assoc();
            $envelopeServico[] = $tabela["id"] . ':' . $tabela["nome"] . ':' . $tabela["valor"] . ':' . $tabelaEnvelopeServico["detalhe"];
        }
        $this->convite = new Convite($idConvite, $modelo, $envelopePapel, $cartaoPapel, $cartaoImpressao, $envelopeImpressao, $cartaoAcabamento, $envelopeAcabamento, $cartaoDetalhe, $envelopeDetalhe, $cartaoServico, $envelopeServico, $cartaoFonte, $envelopeFonte, $envelopeFita);
        return$this->convite;
//return new Convite($idConvite, $modelo, $envelopePapel, $cartaoPapel, $cartaoImpressao, $envelopeImpressao, $cartaoAcabamento, $envelopeAcabamento, $cartaoDetalhe, $envelopeDetalhe, $cartaoServico, $envelopeServico, $cartaoFonte, $envelopeFonte, $envelopeFita);
    }

}
