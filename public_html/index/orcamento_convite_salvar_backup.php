<?php
error_reporting(NULL);
if (!isset($_SESSION)) {
    session_start();
}
include './conexao/Conexao.php';
include './conexao/ConnectionFactory.php';
include './objeto/Convite.php';
include './dao/ConviteDao.php';
include './dao/CatalogoDao.php';

print '<a href = "orcamento_convite.php"><h2>Voltar</h2></a>';
print '<pre >';

// captura variaveis, se nao existir fica em branco
$catalogo = isset($_GET['catalogo']) ? $_GET['catalogo'] : '';
$modelo = isset($_GET['modelo']) ? $_GET['modelo'] : '';
$quantidade = isset($_GET['quantidade']) ? $_GET['quantidade'] : '';
$porcentagem = isset($_GET['desconto']) ? $_GET['desconto'] : '';
$elemento = isset($_GET['elemento']) ? $_GET['elemento'] : '';
$conteudo = isset($_GET['conteudo']) ? $_GET['conteudo'] : '';
$impressao = isset($_GET['impressao']) ? $_GET['impressao'] : '';
$detalhe_impressao = isset($_GET['detalhe_impressao']) ? $_GET['detalhe_impressao'] : '';
$fonte = isset($_GET['fonte']) ? $_GET['fonte'] : '';
$detalhe_fonte = isset($_GET['detalhe_fonte']) ? $_GET['detalhe_fonte'] : '';
$acabamento = isset($_GET['acabamento']) ? $_GET['acabamento'] : '';
$detalhe_acabamento = isset($_GET['detalhe_acabamento']) ? $_GET['detalhe_acabamento'] : '';
$servico = isset($_GET['servico']) ? $_GET['servico'] : '';
$detalhe_servico = isset($_GET['detalhe_servico']) ? $_GET['detalhe_servico'] : '';
$papel = isset($_GET['papel']) ? $_GET['papel'] : '';
$fita = isset($_GET['fita']) ? $_GET['fita'] : '';
$cor = isset($_GET['cor']) ? $_GET['cor'] : '';
$largura = isset($_GET['largura']) ? $_GET['largura'] : '';
$detalhe = isset($_GET['detalhe']) ? $_GET['detalhe'] : '';

function CalculaPreco($convite, $desconto) {
    print '<br>Desconto: ' . $desconto;
    $valor_envelope = $valor_cartao = $valor_conteudo = 0;
    //$quantidade
    $quantidade = $convite['quantidade'];

// valor Corte/Vinco 
    $conexao = new Conexao();
    $query = "SELECT `valor` FROM `servico` WHERE id  = 1";
    $resultado = $conexao->sql_query($query);
    $tabela = mysql_fetch_array($resultado);
    $valor_corteVinco = $tabela[0];
    //var_dump($valor_corteVinco);

    $query = "SELECT `valor` FROM `servico` WHERE id  = 2";
    $resultado = $conexao->sql_query($query);
    $tabela = mysql_fetch_array($resultado);
    $valor_corte = $tabela[0];

    ($quantidade >= 100) ? $valor_corteVinco = $valor_corteVinco / 100 : $valor_corteVinco = $valor_corteVinco / $quantidade;
    print '<br>Corte e Vinco: ' . $valor_corteVinco;

    ($quantidade >= 100) ? $valor_corte = $valor_corte / 100 : $valor_corte = $valor_corte / $quantidade;
    print '<br>Corte: ' . $valor_corte;

    list(,, $folha_unica, $formato_envelope, $formato_cartao, $qtdColagem, $qtdDuplaFace, $qtdDobra, $markup, $empastamentoBorda,$empastamentoBordaEnvelope, $cartao_final_altura, $cartao_final_largura, $envelope_final_altura, $envelope_final_largura) = explode(':', $convite['modelo']);
    
    /*
     * Calucular preco do envelope
     * $quantidade
     * $formato_envelope
     * $val_unit_papel_envl
     * $val_unit_impressao_envl
     * $valor_acabamento_envelope
     * $valor_fita_envelope
     * $valor_servico_envelope
     * $colagem
     * $duplaFace
     * $dobra
     * $markup
     */

    //$val_unit_papel_envl
    list($i, $n, $valor_papel_envelope) = explode(":", $convite['envelope']['papel']);
    if ($quantidade < 100) {
        //Conta o número de papéis para o Empastamento
        $qtdPapelEmpastamento = 1;
        if (!empty($convite['envelope']['servico'])) {
            foreach ($convite['envelope']['servico'] as $key => $value) {
                list($id) = explode(':', $value);
                if ($id == 4) {
                    $qtdPapelEmpastamento++;
                }
            }
        }
        if ($qtdPapelEmpastamento > 1) {
            $fabricantePapelLargura = 960;
            $fabricantePapelAltura = 660;
            $resultado_1 = intval(($fabricantePapelLargura / ($envelope_final_largura + $empastamentoBordaEnvelope))) * intval(($fabricantePapelAltura / ($envelope_final_altura + $empastamentoBordaEnvelope)));
            $resultado_2 = intval(($fabricantePapelLargura / ($envelope_final_altura + $empastamentoBordaEnvelope))) * intval(($fabricantePapelAltura / ($envelope_final_largura + $empastamentoBordaEnvelope)));
            if ($resultado_1 > $resultado_2) {
                $formato_envelope = $resultado_1;
            } else {
                $formato_envelope = $resultado_2;
            }
            $val_unit_papel_envl = ($qtdPapelEmpastamento * (ceil($quantidade / $formato_envelope) * $valor_papel_envelope) / $quantidade) + $valor_corte;
        } else {
            $val_unit_papel_envl = (ceil($quantidade / $formato_envelope) * $valor_papel_envelope) / $quantidade;
        }
    }
    //se a quantidade for maior ou igual a 100, descarto a dizima de números maiores que 100 para não dar erro no calculo da unidade do convite
    else {
        //Conta o número de papéis para o Empastamento
        $qtdPapelEmpastamento = 1;
        if (!empty($convite['envelope']['servico'])) {
            foreach ($convite['envelope']['servico'] as $key => $value) {
                list($id) = explode(':', $value);
                if ($id == 4) {
                    $qtdPapelEmpastamento++;
                }
            }
        }
        if ($qtdPapelEmpastamento > 1) {
            $fabricantePapelLargura = 960;
            $fabricantePapelAltura = 660;
            $resultado_1 = intval(($fabricantePapelLargura / ($envelope_final_largura + $empastamentoBordaEnvelope))) * intval(($fabricantePapelAltura / ($envelope_final_altura + $empastamentoBordaEnvelope)));
            $resultado_2 = intval(($fabricantePapelLargura / ($envelope_final_altura + $empastamentoBordaEnvelope))) * intval(($fabricantePapelAltura / ($envelope_final_largura + $empastamentoBordaEnvelope)));
            if ($resultado_1 > $resultado_2) {
                $formato_envelope = $resultado_1;
            } else {
                $formato_envelope = $resultado_2;
            }
            $val_unit_papel_envl = ($qtdPapelEmpastamento * (ceil(100 / $formato_envelope) * $valor_papel_envelope) / 100) + $valor_corte;
        } else {
            $val_unit_papel_envl = (ceil(100 / $formato_envelope) * $valor_papel_envelope) / 100;
        }
    }
    print "<br>Valor do papel envelope: " . $val_unit_papel_envl;
    //$val_unit_impressao_envl
    foreach ($convite['envelope']['impressao'] as $key => $value) {
        list($id, $n, $valor) = explode(":", $value);

        if ($quantidade >= 100) {
            $val_unit_impressao_envl += $valor / 100;
        } else {
            $val_unit_impressao_envl += $valor / $quantidade;
        }
    }
    print "<br>Valor da impressao envelope: " . $val_unit_impressao_envl;
    //$valor_acabamento_envelope
    $valor_acabamento_envelope = 0;
    foreach ($convite['envelope']['acabamento'] as $key => $value) {
        list($id, $n, $valor) = explode(":", $value);

        $valor_acabamento_envelope += $valor;
    }
    print '<br>Acabamento: ' . $valor_acabamento_envelope;
    //@valor_fita
    list($id, $n, $valor) = explode(':', $convite['envelope']['fita']);
    $valor_fita_envelope = $valor;
    print '<br>Fita: ' . $valor_fita_envelope;

    //$valor_servico_envelope
    $valor_servico_envelope = 0;
    foreach ($convite['envelope']['servico'] as $key => $value) {
        list($id, $nome, $valor) = explode(':', $value);

        ($quantidade >= 100) ? $valor_servico_envelope += $valor / 100 : $valor_servico_envelope += $valor / $quantidade;
    }
    print '<br>Servico: ' . $valor_servico_envelope;
    //valor da mão de obra $maoDeObra
    $conexao = new Conexao();
    $query = "SELECT id ,valor FROM mao_de_obra";
    $resultado = $conexao->sql_query($query);
    $maoDeObra = $valColagem = $valDuplaFace = $valDobra = 0;
    while ($tabela = mysql_fetch_array($resultado)) {
        if ($tabela['id'] == 1) {
            $valColagem = $tabela['valor'];
        }
        if ($tabela['id'] == 2) {
            $valDuplaFace = $tabela['valor'];
        }
        if ($tabela['id'] == 3) {
            $valDobra = $tabela['valor'];
        }
    }
    $maoDeObra = $qtdColagem * $valColagem;
    $maoDeObra += $qtdDuplaFace * $valDuplaFace;
    $maoDeObra += $qtdDobra * $valDobra;

    print '<br>Colagem: ' . $qtdColagem * $valColagem;
    print '<br>Dupla Face: ' . $qtdDuplaFace * $valDuplaFace;
    print '<br>Dobra: ' . $qtdDobra * $valDobra;

    $valor_envelope += $val_unit_papel_envl;
    $valor_envelope += $val_unit_impressao_envl;
    //$valor_envelope += $valor_acabamento_envelope; //(O valor está sendo somado no final para não entrar no Markup)
    //$valor_envelope += $valor_fita_envelope; //(O valor está sendo somado no final para não entrar no Markup)
    $valor_envelope += $valor_corteVinco;
    $valor_envelope += $valor_corte;
    $valor_envelope += $valor_servico_envelope;


//    print "Envelope:<br>papel: ";
//    print $val_unit_papel_envl;
//    print"<br>impressao envelope: ";
//    print $val_unit_impressao_envl;
//    print"<br>acabamento envelope: ";
//    print $valor_acabamento_envelope;
//    print"<br>fita envelope:";
//    print $valor_fita_envelope;
//    print"<br>corte vinco envelope: ";
//    print $valor_corteVinco;
//    print"<br>corte envelope: ";
//    print $valor_corte;
//    print"<br>servico envelope: ";
//    print $valor_servico_envelope;
//    print"<br>Soma total do Envelope: ";
//    print $valor_envelope;
//    print "<br>Markup: ";
//    print $markup;
//    print "<br><br>";


    /*
     * Calucular preco do cartao
     * $quantidade
     * $formato_cartao
     * $valor_corte
     * $val_unit_papel_cartao
     * $val_unit_impressao_cartao
     * $valor_acabamento_cartao
     * $valor_servico_cartao
     */

    if (!$folha_unica) {
        //$val_unit_papel_cartao
        list($i, $n, $valor_papel_cartao) = explode(":", $convite['cartao']['papel']);
        if ($quantidade < 100) {
            $qtdPapelEmpastamento = 1;
            if (!empty($convite['cartao']['servico'])) {
                foreach ($convite['cartao']['servico'] as $key => $value) {
                    list($id) = explode(':', $value);
                    if ($id == 4) {
                        $qtdPapelEmpastamento++;
                    }
                }
            }
            if ($qtdPapelEmpastamento > 1) {
                $fabricantePapelLargura = 960;
                $fabricantePapelAltura = 660;
                $resultado_1 = intval(($fabricantePapelLargura / ($cartao_final_largura + $empastamentoBorda))) * intval(($fabricantePapelAltura / ($cartao_final_altura + $empastamentoBorda)));
                $resultado_2 = intval(($fabricantePapelLargura / ($cartao_final_altura + $empastamentoBorda))) * intval(($fabricantePapelAltura / ($cartao_final_largura + $empastamentoBorda)));
                if ($resultado_1 > $resultado_2) {
                    $formato_cartao = $resultado_1;
                } else {
                    $formato_cartao = $resultado_2;
                }
                $val_unit_papel_cartao = ($qtdPapelEmpastamento * (ceil($quantidade / $formato_cartao) * $valor_papel_cartao) / $quantidade) + $valor_corte;
            } else {
                $val_unit_papel_cartao = (ceil($quantidade / $formato_cartao) * $valor_papel_cartao) / $quantidade;
            }
        } else {
            $qtdPapelEmpastamento = 1;
            if (!empty($convite['cartao']['servico'])) {
                foreach ($convite['cartao']['servico'] as $key => $value) {
                    list($id) = explode(':', $value);
                    if ($id == 4) {
                        $qtdPapelEmpastamento++;
                    }
                }
            }
            if ($qtdPapelEmpastamento > 1) {
                $fabricantePapelLargura = 960;
                $fabricantePapelAltura = 660;
                $resultado_1 = intval(($fabricantePapelLargura / ($cartao_final_largura + $empastamentoBorda))) * intval(($fabricantePapelAltura / ($cartao_final_altura + $empastamentoBorda)));
                $resultado_2 = intval(($fabricantePapelLargura / ($cartao_final_altura + $empastamentoBorda))) * intval(($fabricantePapelAltura / ($cartao_final_largura + $empastamentoBorda)));
                if ($resultado_1 > $resultado_2) {
                    $formato_cartao = $resultado_1;
                } else {
                    $formato_cartao = $resultado_2;
                }
                $val_unit_papel_cartao = ($qtdPapelEmpastamento * (ceil(100 / $formato_cartao) * $valor_papel_cartao) / 100) + $valor_corte;
            } else {
                $val_unit_papel_cartao = (ceil(100 / $formato_cartao) * $valor_papel_cartao) / 100;
            }
        }
    }
    print "<br><br>Valor do papel cartao: " . $val_unit_papel_cartao;
    print '<br>Corte: ' . $valor_corte;
//$val_unit_impressao_cartao;
    foreach ($convite['cartao']['impressao'] as $key => $value) {
        list($id, $n, $valor) = explode(":", $value);

        if ($quantidade >= 100) {
            $val_unit_impressao_cartao += $valor / 100;
        } else {
            $val_unit_impressao_cartao += $valor / $quantidade;
        }
    }
    print "<br>Valor da impressao cartao: " . $val_unit_impressao_cartao;
//$valor_acabamento_cartao
    $valor_acabamento_cartao = 0;
    foreach ($convite['cartao']['acabamento'] as $key => $value) {
        list($id, $n, $valor) = explode(":", $value);

        $valor_acabamento_cartao += $valor;
    }
    print "<br>Valor do acabamento cartao: " . $valor_acabamento_cartao;
// $valor_servico_cartao
    $valor_servico_cartao = 0;
    foreach ($convite['cartao']['servico'] as $key => $value) {
        list($id, $nome, $valor) = explode(':', $value);

        ($quantidade >= 100) ? $valor_servico_cartao += $valor / 100 : $valor_servico_cartao += $valor / $quantidade;
    }
    print "<br>Valor do servico cartao: " . $valor_servico_cartao;

    $valor_cartao += $val_unit_papel_cartao;
    $valor_cartao += $val_unit_impressao_cartao;
    //$valor_cartao += $valor_acabamento_cartao; //(O valor está sendo somado no final para não entrar no Markup)
    $valor_cartao += $valor_servico_cartao;
    $formato_cartao == 0 ? '' : $valor_cartao += $valor_corte;

    $valor_total = $valor_cartao + $valor_envelope + $maoDeObra;

//Verifica se a quantidade é maior que zero e se não é nulo e retorna o valor zero, se nao, retorna o valor calculado 
    if ($quantidade <= 0 || $quantidade == NULL) {
        $valor_total = 0;
        return $valor_total;
    }
//Calcula o valor com o desconto e retorna já com o valor calculado
    if (!empty($desconto) && $desconto > 0) {
        print '<br>Valor do desconto: '.$desconto;
        $valor_total_desconto = $valor_total * $markup;
        print '<br>Total sem desconto: ' . $valor_total_desconto;
        $valor_total_desconto = $valor_total_desconto - (($valor_total_desconto / 100) * $desconto);
        print '<br>Total com desconto: ' . $valor_total_desconto;
//    $valor_total_desconto += $val_unit_impressao_envl;
//    $valor_total_desconto += $val_unit_impressao_cartao;
        $valor_total_desconto += $valor_acabamento_cartao;
        $valor_total_desconto += $valor_acabamento_envelope;
        $valor_total_desconto += $valor_fita_envelope;
        print '<br>Valor Total com desconto de ' . $desconto . '%: ' . $valor_total_desconto . '<br>';
        return $valor_total_desconto;
    } else {
        //se este unset estiver ativo, eu perco o valor dos dados abaixo
        //unset($_SESSION['convite']['descontoPorcentagem']);
        //unset($_SESSION['convite']['desconto']);
    }

    $valor_total = $valor_total * $markup;
//    $valor_total += $val_unit_impressao_envl;
//    $valor_total += $val_unit_impressao_cartao;
    $valor_total += $valor_acabamento_cartao;
    $valor_total += $valor_acabamento_envelope;
    $valor_total += $valor_fita_envelope;
    print '<br>Valor Total: ' . $valor_total;
    return $valor_total;
}

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

//if (!isset($_SESSION['convite']['catalogo_id'])) {
//    $_SESSION['convite']['catalogo_id'] = "";
//}
//$_SESSION['convite']['catalogo_id'] = $catalogo;

//Criar as SESSION´s para nao ficar NULL
function criaSessao() {
    $_SESSION['convite'] = array();
    $_SESSION['convite']['modelo'] = array();
    $_SESSION['convite']['servico'] = array();

    $_SESSION['convite']['cartao']['impressao'] = array();
    $_SESSION['convite']['cartao']['fonte'] = array();
    $_SESSION['convite']['cartao']['acabamento'] = array();
    $_SESSION['convite']['cartao']['papel'] = "";
    $_SESSION['convite']['cartao']['detalhe'] = "";
    $_SESSION['convite']['cartao']['servico'] = array();

    $_SESSION['convite']['envelope']['impressao'] = array();
    $_SESSION['convite']['envelope']['fonte'] = array();
    $_SESSION['convite']['envelope']['acabamento'] = array();
    $_SESSION['convite']['envelope']['papel'] = "";
    $_SESSION['convite']['envelope']['fita'] = "";
    $_SESSION['convite']['envelope']['detalhe'] = "";
    $_SESSION['convite']['envelope']['servico'] = array();
}

//Se nao tiver sessao, entao cria a sessao
if (!isset($_SESSION['convite'])) {
    criaSessao();
}

//Limpa os dados da configuração do convite
if ($acao == "limpar") {
    limpar();
    header("location: orcamento_convite.php");
    die();
}

function limpar() {
    unset($_SESSION['convite']);
}

//Limpa o carrinho de convite, catalogo e configuração
if ($acao == "limpar_todos") {
    foreach ($_SESSION as $key => $value) {
        if (strstr($key, 'convite-')) {
            unset($_SESSION[$key]);
            unset($_SESSION['convite']);
        }
    }
    header("location: orcamento_carrinho.php?action=todos_convites_removed_sucess");
    die();
}

// se nao existir cria
if (!isset($count_convite)) {
    $count_convite = 0;
}
if (!isset($ultimo_convite)) {
    $ultimo_convite = 0;
}

foreach ($_SESSION as $key => $value) {
    if (strpos($key, 'convite-') == 0) {
        list(, $n) = explode('-', $key);
        if ($ultimo_convite < $n) {
            $ultimo_convite = $n;
        }
    }
}

// para salvar o convite numa session unica
if ($_GET['acao'] === 'add_convite_carrinho') {
    $valor_convite = CalculaPreco($_SESSION['convite'], 0);
    if ($_SESSION['convite']['status']['tipo'] == 'update') {
        $posicao = $_SESSION['convite']['status']['posicao'];
        unset($_SESSION[$posicao]);
        $nome_sessao = $_SESSION['convite']['status']['posicao'];
    } else {
        $nome_sessao = 'convite-' . ($ultimo_convite + 1);
    }


    $_SESSION[$nome_sessao] = $_SESSION['convite'];
    $_SESSION[$nome_sessao]['valor'] = $valor_convite;
    unset($_SESSION['convite']);
    header("location: orcamento_carrinho.php");
    die();
}
// para calcular preco automaticamente
if ($_GET['acao'] === 'calcula_convite') {
    calculaPrecoAutomatico();
    header("location: orcamento_convite.php");
    die();
}

function calculaPrecoAutomatico() {
    $_SESSION['convite']['preco_calculado'] = CalculaPreco($_SESSION['convite'], 0);
    if ($_SESSION['convite']['descontoPorcentagem'] >= 0) {
        $_SESSION['convite']['desconto'] = CalculaPreco($_SESSION['convite'], $_SESSION['convite']['descontoPorcentagem']);
    }
}

// para salvar o orçamento no banco de dados
if ($_GET['acao'] == 'salvar_orcamento') {
    foreach ($_SESSION as $key => $value) {
//O If abaixo, procura na sessão a palavra chave convite- e encontra a posição
        if (strstr($key, 'convite-')) {
            $checkResult = salvar_orcamento($_SESSION[$key]);
            //O retorno da função acima irá retornar um objeto, caso ocorra algum erro em alguma query
            if (!is_object($checkResult)) {
                //unset($_SESSION[$key]);
                // a linha acima foi comentado provisoriamente para ao inserir no banco, conseguir utilizar os itens da sessão
                $conviteId[] = $checkResult;
            } else {
                $erro[] = $checkResult;
            }
        }
    }

    foreach ($conviteId as $key => $value) {
        $idInserido = $idInserido . ':' . $value;
    }
    foreach ($erro as $key => $value) {
        $mensagemErro = $mensagemErro . ':' . $value;
    }
    header("location: orcamento_convite_inserido.php?convite_id=$idInserido&erro=$mensagemErro");
//echo "<script>location.href='orcamento_convite_inserido.php?convite_id=$value'</script>";
    die();
}

// Salvar quantidade do modelo
if ($_GET['acao'] == 'salvar_quantidade') {
    $_SESSION['convite']['quantidade'] = $quantidade;
    calculaPrecoAutomatico();
    header("location: orcamento_convite.php");
    die();
    
}

if (!isset($_SESSION['variante'])) {
    $_SESSION['variante'] = 0;
}

$variante = $_SESSION['variante'];


if ($modelo) {
    $arrT = explode("§", $modelo);
    $arrT = implode(":", $arrT);
    $_SESSION['convite']['modelo'] = $arrT;
}

if ($_GET['acao'] == 'adicionar') {
    if ($elemento == 'cartao') {
// adiciona impressao
        if ($impressao !== "") {
            $arr = explode("§", $impressao);

            $_SESSION['convite']['cartao']['impressao'][] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $detalhe_impressao;
        }
// adiciona fonte
        if ($fonte !== "") {
            $arr = explode("§", $fonte);

            $_SESSION['convite']['cartao']['fonte'][] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $detalhe_fonte;
        }
// adiciona acabamento
        if ($acabamento !== "") {
            $arr = explode("§", $acabamento);

            $_SESSION['convite']['cartao']['acabamento'][] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $detalhe_acabamento;
        }
// Verifica se é folha única e limpa o papel do cartão
        list(,, $folhaUnica) = explode(":", $_SESSION['convite']['modelo']);
        if ($folhaUnica == 1) {
            unset($_SESSION['convite']['cartao']['papel']);
        }
// adiciona papel
        if ($papel !== "") {
            $arr = explode("§", $papel);
            $_SESSION['convite']['cartao']['papel'] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $arr['4'];
        }
// adiciona fita
        if ($fita !== "") {
            $arr = explode("§", $fita);
            $arr2 = explode("§", $cor);

            $_SESSION['convite']['cartao']['fita'] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $arr2['0'] . ':' . $arr2['1'] . ':' . $largura;
        }
// adiciona detalhe
        if ($detalhe !== "") {
            $_SESSION['convite']['cartao']['detalhe'] = $detalhe;
        }
// adiciona servico
        if ($servico !== "") {
            $arr = explode("§", $servico);

            $_SESSION['convite']['cartao']['servico'][] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $detalhe_servico;
        }
    }

    if ($elemento == 'envelope') {
// adiciona impressao
        if ($impressao !== "") {
            $arr = explode("§", $impressao);

            $_SESSION['convite']['envelope']['impressao'][] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $detalhe_impressao;
        }
// adiciona fonte
        if ($fonte !== "") {
            $arr = explode("§", $fonte);

            $_SESSION['convite']['envelope']['fonte'][] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $detalhe_fonte;
        }
// adiciona acabamento
        if ($acabamento !== "") {
            $arr = explode("§", $acabamento);

            $_SESSION['convite']['envelope']['acabamento'][] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $detalhe_acabamento;
        }
// adiciona papel
        if ($papel !== "") {
            $arr = explode("§", $papel);

            $_SESSION['convite']['envelope']['papel'] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $arr['4'];
        }
// adiciona fita
        if ($fita !== "") {
            $tipoLaco = explode("§", $fita);
            $corFita = explode("§", $cor);
            $_SESSION['convite']['envelope']['fita'] = (string) $tipoLaco['0'] . ':' . $tipoLaco['1'] . ':' . $tipoLaco['2'] . ':' . $corFita['0'] . ':' . $corFita['1'] . ':' . $largura;
        }
// adiciona detalhe
        if ($detalhe !== "") {
            $_SESSION['convite']['envelope']['detalhe'] = $detalhe;
        }
// adiciona servico
        if ($servico !== "") {
            $arr = explode("§", $servico);

            $_SESSION['convite']['envelope']['servico'][] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $detalhe_servico;
        }
    }
    calculaPrecoAutomatico();
    $_SESSION['variante'] += 1;
    header("location: orcamento_convite.php");
    die();
}
if ($_GET['acao'] == 'alterar') {
    if ($elemento == 'cartao') {
// adiciona impressao
        if ($impressao !== "") {
            $arr = explode("§", $impressao);

            $_SESSION['convite']['cartao']['impressao'][$_GET['posicao']] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $detalhe_impressao;
        }
// adiciona fonte
        if ($fonte !== "") {
            $arr = explode("§", $fonte);

            $_SESSION['convite']['cartao']['fonte'][$_GET['posicao']] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $detalhe_fonte;
        }
// adiciona acabamento
        if ($acabamento !== "") {
            $arr = explode("§", $acabamento);

            $_SESSION['convite']['cartao']['acabamento'][$_GET['posicao']] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $detalhe_acabamento;
        }
// Verifica se é folha única e limpa o papel do cartão
        list(,, $folhaUnica) = explode(":", $_SESSION['convite']['modelo']);
        if ($folhaUnica == 1) {
            unset($_SESSION['convite']['cartao']['papel']);
        }
// adiciona papel
        if ($papel !== "") {
            $arr = explode("§", $papel);
            $_SESSION['convite']['cartao']['papel'] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $arr['4'];
        }
// adiciona fita
        if ($fita !== "") {
            $arr = explode("§", $fita);
            $arr2 = explode("§", $cor);

            $_SESSION['convite']['cartao']['fita'] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $arr2['0'] . ':' . $arr2['1'] . ':' . $largura;
        }
// adiciona detalhe
        if ($detalhe !== "") {
            $_SESSION['convite']['cartao']['detalhe'] = $detalhe;
        }
// adiciona servico
        if ($servico !== "") {
            $arr = explode("§", $servico);

            $_SESSION['convite']['cartao']['servico'][$_GET['posicao']] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $detalhe_servico;
        }
    }

    if ($elemento == 'envelope') {
// adiciona impressao
        if ($impressao !== "") {
            $arr = explode("§", $impressao);

            $_SESSION['convite']['envelope']['impressao'][$_GET['posicao']] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $detalhe_impressao;
        }
// adiciona fonte
        if ($fonte !== "") {
            $arr = explode("§", $fonte);

            $_SESSION['convite']['envelope']['fonte'][$_GET['posicao']] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $detalhe_fonte;
        }
// adiciona acabamento
        if ($acabamento !== "") {
            $arr = explode("§", $acabamento);

            $_SESSION['convite']['envelope']['acabamento'][$_GET['posicao']] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $detalhe_acabamento;
        }
// adiciona papel
        if ($papel !== "") {
            $arr = explode("§", $papel);

            $_SESSION['convite']['envelope']['papel'] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $arr['4'];
        }
// adiciona fita
        if ($fita !== "") {
            $tipoLaco = explode("§", $fita);
            $corFita = explode("§", $cor);
            $_SESSION['convite']['envelope']['fita'] = (string) $tipoLaco['0'] . ':' . $tipoLaco['1'] . ':' . $tipoLaco['2'] . ':' . $corFita['0'] . ':' . $corFita['1'] . ':' . $largura;
        }
// adiciona detalhe
        if ($detalhe !== "") {
            $_SESSION['convite']['envelope']['detalhe'] = $detalhe;
        }
// adiciona servico
        if ($servico !== "") {
            $arr = explode("§", $servico);

            $_SESSION['convite']['envelope']['servico'][$_GET['posicao']] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $detalhe_servico;
        }
    }
    calculaPrecoAutomatico();
    header("location: orcamento_convite.php");
    die();
}

if ($_GET['acao'] == 'excluir') {
    $final = $_GET['final'];
    if ($elemento == "cartao") {
// Exclui impressao
        if ($conteudo == "impressao") {
            unset($_SESSION['convite']['cartao']['impressao'][$final]);
        }
// Exclui fonte
        if ($conteudo == "fonte") {
            unset($_SESSION['convite']['cartao']['fonte'][$final]);
        }
// Exclui acabamento
        if ($conteudo == "acabamento") {
            unset($_SESSION['convite']['cartao']['acabamento'][$final]);
        }
// Exclui papel
        if ($conteudo == "papel") {
            unset($_SESSION['convite']['cartao']['papel']);
        }
// Exclui fita
        if ($conteudo == "fita") {
            unset($_SESSION['convite']['cartao']['fita']);
        }
// Exclui detalhe
        if ($conteudo == "detalhe") {
            unset($_SESSION['convite']['cartao']['detalhe']);
        }
// Exclui detalhe
        if ($conteudo == "servico") {
            unset($_SESSION['convite']['cartao']['servico'][$final]);
        }
    }
    if ($elemento == "envelope") {
// Exclui impressao
        if ($conteudo == "impressao") {
            unset($_SESSION['convite']['envelope']['impressao'][$final]);
        }
// Exclui fonte
        if ($conteudo == "fonte") {
            unset($_SESSION['convite']['envelope']['fonte'][$final]);
        }
// Exclui acam=bamento
        if ($conteudo == "acabamento") {
            unset($_SESSION['convite']['envelope']['acabamento'][$final]);
        }
// Exclui papel
        if ($conteudo == "papel") {
            unset($_SESSION['convite']['envelope']['papel']);
        }
// Exclui fita
        if ($conteudo == "fita") {
            unset($_SESSION['convite']['envelope']['fita']);
        }
// Exclui detalhe
        if ($conteudo == "detalhe") {
            unset($_SESSION['convite']['envelope']['detalhe']);
        }
// Exclui detalhe
        if ($conteudo == "servico") {
            unset($_SESSION['convite']['envelope']['servico'][$final]);
        }
    }
    calculaPrecoAutomatico();
    header("location: orcamento_convite.php");
    die();
}

if ($_GET['acao'] == 'excluir_convite') {
    $convite = $_GET['nome'];
    unset($_SESSION[$convite]);
    header("location: orcamento_carrinho.php");
    die();
}

//Retira do carrinho e coloca para configuar novamente
if ($_GET['acao'] == 'atualizar_carrinho_convite') {
    limpar();
    $conviteUpdate = $_GET['nome'];
    $_SESSION['convite'] = $_SESSION[$conviteUpdate];
    $_SESSION['convite']['status']['tipo'] = 'update';
    $_SESSION['convite']['status']['posicao'] = $conviteUpdate;
    header("location: orcamento_convite.php");
    die();
}

function salvar_orcamento($conviteSessao) {
    $idConvite = null;
    list($idModelo,, $folhaUnica) = explode(':', $conviteSessao['modelo']);
    $detalheCartao = $conviteSessao['cartao']['detalhe'];
    $detalheEnvelope = $conviteSessao['envelope']['detalhe'];

//Aloca as variaveis para o Cartao
    list($idPapelCartao) = explode(':', $conviteSessao['cartao']['papel']);
    foreach ($conviteSessao['cartao']['impressao'] as $key => $value) {
        list($impressaoCartao[$key]['id'],,, $impressaoCartao[$key]['descricao']) = explode(":", $value);
    }
    foreach ($conviteSessao['cartao']['acabamento'] as $key => $value) {
        list($acabamentoCartao[$key]['id'],,, $acabamentoCartao[$key]['descricao']) = explode(':', $value);
    }
    foreach ($conviteSessao['cartao']['fonte'] as $key => $value) {
        list($fonteCartao[$key]['id'],, $fonteCartao[$key]['descricao']) = explode(':', $value);
    }
    foreach ($conviteSessao['cartao']['servico'] as $key => $value) {
        list($servicoCartao[$key]['id'],,, $servicoCartao[$key]['descricao']) = explode(':', $value);
    }


//Aloca as variaveis para o Envelope
    list($idPapelEnvelope) = explode(':', $conviteSessao['envelope']['papel']);
    foreach ($conviteSessao['envelope']['impressao'] as $key => $value) {
        list($impressaoEnvelope[$key]['id'],,, $impressaoEnvelope[$key]['descricao']) = explode(":", $value);
    }
    foreach ($conviteSessao['envelope']['acabamento'] as $key => $value) {
        list($acabamentoEnvelope[$key]['id'],,, $acabamentoEnvelope[$key]['descricao']) = explode(':', $value);
    }
    foreach ($conviteSessao['envelope']['fonte'] as $key => $value) {
        list($fonteEnvelope[$key]['id'],, $fonteEnvelope[$key]['descricao']) = explode(':', $value);
    }
    foreach ($conviteSessao['envelope']['servico'] as $key => $value) {
        list($servicoEnvelope[$key]['id'],,, $servicoEnvelope[$key]['descricao']) = explode(':', $value);
    }
    list($fita['id_laco'],,, $fita['id_fita'],, $fita['largura']) = explode(':', $conviteSessao['envelope']['fita']);

    $convite = new Convite($idConvite, $idModelo, $idPapelEnvelope, $idPapelCartao, $impressaoCartao, $impressaoEnvelope, $acabamentoCartao, $acabamentoEnvelope, $detalheCartao, $detalheEnvelope, $servicoCartao, $servicoEnvelope, $fonteCartao, $fonteEnvelope, $fita);
    $conviteDao = new ConviteDao();
    $connectionFactory = new ConnectionFactory();
    $mysqli = $connectionFactory->get_Mysqli();
    $mysqli->autocommit(FALSE);
    $mysqli->query("START TRANSACTION;");

    $queryError = $conviteDao->insertConvite($convite, $mysqli, $folhaUnica);

    if (!$queryError == NULL) {
        throw new Exception("$queryError");
    }
    if ($queryError == NULL) {
        $mysqli->query("COMMIT;");
        return $conviteDao->getIdConvite();
    } else {
        $mysqli->query("ROLLBACK;");
        return $convite; //retorna o objeto
    }
}

function calculaCentoConvite() {
    $_SESSION['convite']['quantidade'] = 100;
    calculaPrecoAutomatico();
}

//Seleciona página a partir do catalogo
if ($_GET['acao'] == "seleciona_pagina") {
    unset($_SESSION['convite']);
    criaSessao();
    $_SESSION['convite']['catalogo_id'] = $_GET['catalogo'];
    $connectionFactory = new ConnectionFactory();
    $mysqli = $connectionFactory->get_Mysqli();
    $catalogoDao = new CatalogoDao(); 
    $result = $catalogoDao->selectPagina($_SESSION['convite']['catalogo_id'], $mysqli);
    $tabelaCatalogo = $result->fetch_assoc();
    $conviteDao = new ConviteDao();
    $conviteDao->selectConviteSessao($tabelaCatalogo['id_convite'], $mysqli);
    calculaCentoConvite();
    header("location: orcamento_convite.php");
    die();
}
 
//Seleciona o convite do orçamento
if ($_GET['acao'] == "seleciona_convite_orcamento") {
    unset($_SESSION['convite']);
    criaSessao();
    $_SESSION['convite']['orcamento']['id'] = $_GET['convite_orcamento'];
    $connectionFactory = new ConnectionFactory();
    $mysqli = $connectionFactory->get_Mysqli();
    $conviteDao = new ConviteDao();
    $conviteDao->selectConviteSessao($_GET['convite_orcamento'], $mysqli);
    calculaCentoConvite();
    header("location: orcamento_convite.php");
    die();
}
if ($_GET['acao'] == "salvar_desconto_convite" && $_GET['desconto']>=0 && $_GET['desconto']<=20) {   
    $_SESSION['convite']['descontoPorcentagem'] = $_GET['desconto'];
    $_SESSION['convite']['desconto'] = CalculaPreco($_SESSION['convite'], $_SESSION['convite']['descontoPorcentagem']);
    header("location: orcamento_convite.php");
    die();
}
header("location: orcamento_convite.php");
//var_dump($_SESSION);
//die();
?>