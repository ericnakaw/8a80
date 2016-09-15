<?php

ob_start(); // esta função no começo da página auxiliou no redirecionamento. (Colocar ob_end_clean(); antes do header('location: ');)
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
if (!isset($_SESSION)) {
    session_start();
}
include './conexao/Conexao.php';
include './conexao/ConnectionFactory.php';
include './objeto/Convite.php';
include './objeto/Cliente.php';
include './objeto/Pessoa.php';
include './objeto/Pedido.php';
include './objeto/Orcamento.php';
include './objeto/ItensConvite.php';
include './objeto/ItensConviteOrcamento.php';
include './dao/ConviteDao.php';
include './dao/CatalogoDao.php';
include './dao/ClienteDao.php';
include './dao/PessoaDao.php';
include './dao/PedidoDao.php';
include './dao/OrcamentoDao.php';
include './dao/ItensConviteDao.php';
include './dao/ItensConviteOrcamentoDao.php';

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
$papel = isset($_GET['papel']) ? $_GET['papel'] . '§' . $_GET['empastamento'] : '';
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

    list(,, $folha_unica, $formato_envelope, $formato_cartao, $qtdColagem, $qtdDuplaFace, $qtdDobra, $markup, $empastamentoBorda, $empastamentoBordaEnvelope, $cartao_final_altura, $cartao_final_largura, $envelope_final_altura, $envelope_final_largura) = explode(':', $convite['modelo']);

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
    if ($quantidade < 100) {
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

    //neste if está passando tanto o folha única quanto o composto
    if (!$folha_unica || $folha_unica) {
        //$val_unit_papel_cartao
        foreach ($convite['cartao']['papel'] as $key => $value) {
            list($i, $n, $valor,, $empastamento) = explode(":", $value);
            //Conta o número de papéis para o Empastamento
            $qtdPapelEmpastamento = 1;
            if (!empty($convite['cartao']['servico'])) {
                foreach ($convite['cartao']['servico'] as $key => $value) {
                    list($id) = explode(':', $value);
                    if ($id == 4) {
                        $qtdPapelEmpastamento++;
                    }
                }
            }
            if ($quantidade < 100) {
                if ($qtdPapelEmpastamento > 1 && $empastamento == 1) {
                    $fabricantePapelLargura = 960;
                    $fabricantePapelAltura = 660;
                    $resultado_1 = intval(($fabricantePapelLargura / ($cartao_final_largura + $empastamentoBorda))) * intval(($fabricantePapelAltura / ($cartao_final_altura + $empastamentoBorda)));
                    $resultado_2 = intval(($fabricantePapelLargura / ($cartao_final_altura + $empastamentoBorda))) * intval(($fabricantePapelAltura / ($cartao_final_largura + $empastamentoBorda)));
                    if ($resultado_1 > $resultado_2) {
                        $formato_cartao = $resultado_1;
                    } else {
                        $formato_cartao = $resultado_2;
                    }
                    $val_unit_papel_cartao += ($qtdPapelEmpastamento * (ceil($quantidade / $formato_cartao) * $valor) / $quantidade) + $valor_corte;
                } else {
                    $val_unit_papel_cartao += (ceil($quantidade / $formato_cartao) * $valor) / $quantidade;
                }
            } else {
                if ($qtdPapelEmpastamento > 1 && $empastamento == 1) {
                    $fabricantePapelLargura = 960;
                    $fabricantePapelAltura = 660;
                    $resultado_1 = intval(($fabricantePapelLargura / ($cartao_final_largura + $empastamentoBorda))) * intval(($fabricantePapelAltura / ($cartao_final_altura + $empastamentoBorda)));
                    $resultado_2 = intval(($fabricantePapelLargura / ($cartao_final_altura + $empastamentoBorda))) * intval(($fabricantePapelAltura / ($cartao_final_largura + $empastamentoBorda)));
                    if ($resultado_1 > $resultado_2) {
                        $formato_cartao = $resultado_1;
                    } else {
                        $formato_cartao = $resultado_2;
                    }
                    $val_unit_papel_cartao += ($qtdPapelEmpastamento * (ceil(100 / $formato_cartao) * $valor) / 100) + $valor_corte;
                } else {
                    $val_unit_papel_cartao += (ceil(100 / $formato_cartao) * $valor) / 100;
                }
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
        print '<br>Valor do desconto: ' . $desconto;
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
    $_SESSION['convite']['cartao']['papel'] = array();
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
    add_convite_carrinho($ultimo_convite); //preciso enviar este parametro porque dentro da[function add_convite_carrinho($ultimo_convite)] esta variavel deixa de existir
    header("location: orcamento_carrinho.php");
    die();
}

function add_convite_carrinho($ultimo_convite) {//preciso deste parametro porque dentro da[function add_convite_carrinho($ultimo_convite)] esta variavel deixa de existir
    //var_dump($_SESSION['convite']);
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
}

// para calcular preco automaticamente
if ($_GET['acao'] === 'calcula_convite') {
    calculaPrecoAutomatico();
    header("location: orcamento_convite.php");
    die();
}

function calculaPrecoAutomatico($quantidade) {
    $_SESSION['convite']['preco_calculado'] = CalculaPreco($_SESSION['convite'], 0);
    if ($_SESSION['convite']['descontoPorcentagem'] >= 0) {
        $_SESSION['convite']['desconto'] = CalculaPreco($_SESSION['convite'], $_SESSION['convite']['descontoPorcentagem']);
    }
}

// para salvar o pedido no banco de dados
if ($_GET['acao'] == 'salvar_pedido') {
    $localizacaoErro = ""; //variavel que indica onde ocorreu o erro
    $connectionFactory = new ConnectionFactory();
    $mysqli = $connectionFactory->get_Mysqli();
    $mysqli->autocommit(FALSE);
    $mysqli->query("START TRANSACTION;");

    if (empty($_SESSION["cliente"]["id"])) {
        //Inicio: Salvar Cliente
        $checkResultCliente = salvar_cliente($mysqli);
        if (!is_object($checkResultCliente)) {
            $idCliente = $checkResultCliente;
        } else {
            $erro[] = $localizacaoErro = 'cliente insert';
        }
        //Fim: Salvar Cliente
    //
    } else {
        //Inicio: Update Cliente
        $checkResultCliente = update_cliente($mysqli);
        if (!is_object($checkResultCliente)) {
            $idCliente = $checkResultCliente;
        } else {
            $erro[] = $localizacaoErro = 'cliente update';
        }
        //Fim: Update Cliente
    }
    if (empty($_SESSION["cliente"]["id_pessoa"]) && empty($_SESSION["cliente"]["id_pessoa2"])) {
        //Inicio: Salvar Pessoa 1
        $checkResultPessoa1 = salvar_pessoa($idCliente, $_SESSION['cliente']["nome"], $_SESSION['cliente']["sobrenome"], $_SESSION['cliente']["email"], $_SESSION['cliente']["telefone"], $_SESSION['cliente']["celular"], $_SESSION['cliente']["rg"], $_SESSION['cliente']["cpf"], $mysqli);
        if (!is_object($checkResultPessoa1)) {
            $idPessoa1 = $checkResultPessoa1;
        } else {
            $erro[] = $localizacaoErro = 'pessoa1';
        }
        //Fim: Salvar Pessoa 1
        //
    //Inicio: Salvar Pessoa 2
        $checkResultPessoa2 = salvar_pessoa($idCliente, $_SESSION['cliente']["nome2"], $_SESSION['cliente']["sobrenome2"], $_SESSION['cliente']["email2"], $_SESSION['cliente']["telefone2"], $_SESSION['cliente']["celular2"], $_SESSION['cliente']["rg2"], $_SESSION['cliente']["cpf2"], $mysqli);
        if (!is_object($checkResultPessoa2)) {
            $idPessoa2 = $checkResultPessoa2;
        } else {
            $erro[] = $localizacaoErro = 'pessoa2';
        }
        //Fim: Salvar Pessoa 2
    } else {
        //Inicio: Update Pessoa 1
        $checkResultPessoa1 = update_pessoa($_SESSION["cliente"]["id_pessoa"], $idCliente, $_SESSION['cliente']["nome"], $_SESSION['cliente']["sobrenome"], $_SESSION['cliente']["email"], $_SESSION['cliente']["telefone"], $_SESSION['cliente']["celular"], $_SESSION['cliente']["rg"], $_SESSION['cliente']["cpf"], $mysqli);
        if (!is_object($checkResultPessoa1)) {
            $idPessoa1 = $checkResultPessoa1;
        } else {
            $erro[] = $localizacaoErro = 'pessoa1 update';
        }
        //Fim: Update Pessoa 1
        //
    //Inicio: Update Pessoa 2
        $checkResultPessoa2 = update_pessoa($_SESSION["cliente"]["id_pessoa2"], $idCliente, $_SESSION['cliente']["nome2"], $_SESSION['cliente']["sobrenome2"], $_SESSION['cliente']["email2"], $_SESSION['cliente']["telefone2"], $_SESSION['cliente']["celular2"], $_SESSION['cliente']["rg2"], $_SESSION['cliente']["cpf2"], $mysqli);
        if (!is_object($checkResultPessoa2)) {
            $idPessoa2 = $checkResultPessoa2;
        } else {
            $erro[] = $localizacaoErro = 'pessoa2 update';
        }
        //Fim: Update Pessoa 2
    }
    //Inicio: Salvar Pedido
    $checkResultPedido = salvar_pedido($idCliente, $mysqli);
    if (!is_object($checkResultPedido)) {
        $_SESSION['cliente']["id_pedido"] = $idPedido = $checkResultPedido;
    } else {
        $erro[] = $localizacaoErro = 'pedido';
    }
    //Fim: Salvar Pedido
    //Inicio: Salvar Convite
    foreach ($_SESSION as $key => $value) {
//O If abaixo, procura na sessão a palavra chave convite- e encontra a posição
        if (strstr($key, 'convite-')) {
            $checkResultConvite = salvar_convite($_SESSION[$key], $mysqli);
            //O retorno da função acima irá retornar um objeto, caso ocorra algum erro em alguma query
            if (!is_object($checkResultConvite)) {
                $idConvite = $checkResultConvite;
                //Inicio: Salvar Itens Convite
                $checkResultItensConvite = salvar_item_convite($idConvite, $mysqli, $_SESSION['cliente']["id_pedido"], $_SESSION[$key]["quantidade"], $_SESSION[$key]["data_entrega"], number_format($_SESSION[$key]["desconto"], 2), $_SESSION[$key]["descontoPorcentagem"], 0);
                if (!is_object($checkResultItensConvite)) {
                    $itensConvite = $checkResultItensConvite;
                } else {
                    $erro[] = $localizacaoErro = 'item convite';
                }
                $conviteId[] = $checkResultConvite;
            } else {
                $erro[] = $localizacaoErro = 'convite';
            }
        }
    }
    //Fim: Salvar Convite
    ////Verifica se há algum erro e indica onde aconteceu se der um print na variavel: $localizacaoErro
    //Caso não haja erro, Commit as operações, caso ocorra um erro, faz Rollback
    if ($erro == NULL) {
        //preenche um array com os ids dos convites inseridos
        foreach ($conviteId as $key => $value) {
            $idInserido = $idInserido . ':' . $value;
        }

        $mysqli->query("COMMIT;");
        foreach ($_SESSION as $key => $value) {
            if (strstr($key, 'convite-')) {
                unset($_SESSION[$key]);
            }
        }
        unset($_SESSION["convite"]);
        unset($_SESSION["cliente"]);
    } else {
        $mysqli->query("ROLLBACK;");
    }

    foreach ($erro as $key => $value) {
        //preenche um array com erro
        $mensagemErro = $mensagemErro . ':' . $value;
    }
    //header("location: orcamento_realizado.php?pedido_id={$_SESSION['cliente']["id_pedido"]}");
    header("location: pedido_realizado.php?pedido_id={$idPedido}");
    //header("location: orcamento_convite_inserido.php?convite_id=$idInserido&erro=$mensagemErro");
//echo "<script>location.href='orcamento_convite_inserido.php?convite_id=$value'</script>";
    die();
}

// para salvar o orcamento no banco de dados
if ($_GET['acao'] == 'salvar_orcamento') {
    $localizacaoErro = ""; //variavel que indica onde ocorreu o erro
    $connectionFactory = new ConnectionFactory();
    $mysqli = $connectionFactory->get_Mysqli();
    $mysqli->autocommit(FALSE);
    $mysqli->query("START TRANSACTION;");

    //Inicio: Salvar Cliente
    $checkResultCliente = salvar_cliente($mysqli);
    if (!is_object($checkResultCliente)) {
        $idCliente = $checkResultCliente;
    } else {
        $erro[] = $localizacaoErro = 'cliente';
    }
    //Fim: Salvar Cliente
    //
    //Inicio: Salvar Pessoa 1
    $checkResultPessoa1 = salvar_pessoa($idCliente, $_SESSION['cliente']["nome"], $_SESSION['cliente']["sobrenome"], $_SESSION['cliente']["email"], $_SESSION['cliente']["telefone"], $_SESSION['cliente']["celular"], $_SESSION['cliente']["rg"], $_SESSION['cliente']["cpf"], $mysqli);
    if (!is_object($checkResultPessoa1)) {
        $idPessoa1 = $checkResultPessoa1;
    } else {
        $erro[] = $localizacaoErro = 'pessoa1';
    }
    //Fim: Salvar Pessoa 1
    //
    //Inicio: Salvar Pessoa 2
    $checkResultPessoa2 = salvar_pessoa($idCliente, $_SESSION['cliente']["nome2"], $_SESSION['cliente']["sobrenome2"], $_SESSION['cliente']["email2"], $_SESSION['cliente']["telefone2"], $_SESSION['cliente']["celular2"], $_SESSION['cliente']["rg2"], $_SESSION['cliente']["cpf2"], $mysqli);
    if (!is_object($checkResultPessoa2)) {
        $idPessoa2 = $checkResultPessoa2;
    } else {
        $erro[] = $localizacaoErro = 'pessoa2';
    }
    //Fim: Salvar Pessoa 2
    //Inicio: Salvar Pedido
    $checkResultOrcamento = salvar_orcamento($idCliente, $mysqli);
    if (!is_object($checkResultOrcamento)) {
        $_SESSION['cliente']["id_orcamento"] = $idOrcamento = $checkResultOrcamento;
    } else {
        $erro[] = $localizacaoErro = 'orcamento';
    }
    //Fim: Salvar Pedido
    //Inicio: Salvar Convite
    foreach ($_SESSION as $key => $value) {
//O If abaixo, procura na sessão a palavra chave convite- e encontra a posição
        if (strstr($key, 'convite-')) {
            $checkResultConvite = salvar_convite($_SESSION[$key], $mysqli);
            //O retorno da função acima irá retornar um objeto, caso ocorra algum erro em alguma query
            if (!is_object($checkResultConvite)) {
                $idConvite = $checkResultConvite;
                $checkResultItensConvite = salvar_item_convite_orcamento($idConvite, $_SESSION['cliente']["id_orcamento"], $mysqli, $_SESSION[$key]["quantidade"], number_format($_SESSION[$key]["desconto"], 2), $_SESSION[$key]["descontoPorcentagem"]);
                if (!is_object($checkResultItensConvite)) {
                    $itensConvite = $checkResultItensConvite;
                } else {
                    $erro[] = $localizacaoErro = 'item convite_orcamento';
                }
                $conviteId[] = $checkResultConvite;
            } else {
                $erro[] = $localizacaoErro = 'convite';
            }
        }
    }
    //Fim: Salvar Convite
    ////Verifica se há algum erro e indica onde aconteceu se der um print na variavel: $localizacaoErro
    //Caso não haja erro, Commit as operações, caso ocorra um erro, faz Rollback
    if ($erro == NULL) {
        //preenche um array com os ids dos convites inseridos
        foreach ($conviteId as $key => $value) {
            $idInserido = $idInserido . ':' . $value;
        }

        $mysqli->query("COMMIT;");
        foreach ($_SESSION as $key => $value) {
            if (strstr($key, 'convite-')) {
                unset($_SESSION[$key]);
            }
        }
        unset($_SESSION["convite"]);
        unset($_SESSION["cliente"]);
    } else {
        $mysqli->query("ROLLBACK;");
    }

    foreach ($erro as $key => $value) {
        //preenche um array com erro
        $mensagemErro = $mensagemErro . ':' . $value;
    }
    //header("location: orcamento_realizado.php?pedido_id={$_SESSION['cliente']["id_pedido"]}");
    header("location: orcamento_realizado.php?orcamento_id={$idOrcamento}");
    //header("location: orcamento_convite_inserido.php?convite_id=$idInserido&erro=$mensagemErro");
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
            $_SESSION['convite']['cartao']['papel'][] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $arr['4'] . ':' . $arr['5'];
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

            $_SESSION['convite']['envelope']['papel'] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $arr['4'] . ':' . $arr['5'];
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
            $_SESSION['convite']['cartao']['papel'][$_GET['posicao']] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $arr['4'] . ':' . $arr['5'];
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

            $_SESSION['convite']['envelope']['papel'] = (string) $arr['0'] . ':' . $arr['1'] . ':' . $arr['2'] . ':' . $arr['4'] . ':' . $arr['5'];
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
            unset($_SESSION['convite']['cartao']['papel'][$final]);
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

//Funcão para salvar cada convite. OBS: Preciso receber como parametro a conexão para trabalhar com o mesmo link nas funcões de COMMIT e ROLLBACK
function salvar_convite($conviteSessao, $mysqli) {
    $idConvite = null;
    list($idModelo,, $folhaUnica) = explode(':', $conviteSessao['modelo']);
    $detalheCartao = $conviteSessao['cartao']['detalhe'];
    $detalheEnvelope = $conviteSessao['envelope']['detalhe'];
//Aloca as variaveis para o Cartao
    foreach ($conviteSessao['cartao']['papel'] as $key => $value) {
        list($idPapelCartao[$key]['id'],,,, $idPapelCartao[$key]['empastamento']) = explode(':', $value);
    }
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
    $queryError = $conviteDao->insertConvite($convite, $mysqli, $folhaUnica);
    if (!$queryError == NULL) {
        throw new Exception("$queryError");
    }
    if ($queryError == NULL) {
        return $conviteDao->getIdConvite();
    } else {
        return $convite; //retorna o objeto
    }
}

//Funcão para salvar o cliente. OBS: Preciso receber como parametro a conexão para trabalhar com o mesmo link nas funcões de COMMIT e ROLLBACK
function salvar_cliente($mysqli) {
    $clienteDao = new ClienteDao();
    $queryError = $clienteDao->insert(cria_cliente(NULL), $mysqli);
    if (!$queryError == NULL) {
        throw new Exception("$queryError");
    }
    if ($queryError == NULL) {
        return $clienteDao->getIdCliente(); //retorna o id
    } else {
        return $cliente; //retorna o objeto
    }
}

//Funcão para update cliente. OBS: Preciso receber como parametro a conexão para trabalhar com o mesmo link nas funcões de COMMIT e ROLLBACK
function update_cliente($mysqli) {
    $clienteDao = new ClienteDao();
    $queryError = $clienteDao->update(cria_cliente($_SESSION["cliente"]["id"]), $mysqli);
    if (!$queryError == NULL) {
        throw new Exception("$queryError");
    }
    if ($queryError == NULL) {
        return $clienteDao->getIdCliente(); //retorna o id
    } else {
        return $cliente; //retorna o objeto
    }
}

function cria_cliente($idCliente) {
    $cliente = new Cliente(
            $_SESSION['cliente']["data_evento"], $_SESSION['cliente']["evento"], $_SESSION['cliente']["rua"], $_SESSION['cliente']["numero"], $_SESSION['cliente']["complemento"], $_SESSION['cliente']["estado"], $_SESSION['cliente']["bairro"], $_SESSION['cliente']["cidade"], $_SESSION['cliente']["cep"], $_SESSION['cliente']["observacao"], $mysqli);
    $cliente->setIdCliente($idCliente);
    return $cliente;
}

//Funcão para salvar a pessoa. OBS: Preciso receber como parametro a conexão para trabalhar com o mesmo link nas funcões de COMMIT e ROLLBACK
function salvar_pessoa($idCliente, $nome, $sobrenome, $email, $telefone, $celular, $rg, $cpf, $mysqli) {
    $pessoa = new Pessoa($idCliente, $nome, $sobrenome, $email, $telefone, $celular, $rg, $cpf);
    $pessoaDao = new PessoaDao();
    $queryError = $pessoaDao->insert($pessoa, $mysqli);
    if (!$queryError == NULL) {
        throw new Exception("$queryError");
    }
    if ($queryError == NULL) {
        return $pessoaDao->getIdPessoa(); //retorna o id
    } else {
        return $pessoa; //retorna o objeto
    }
}

//Funcão para salvar a pessoa. OBS: Preciso receber como parametro a conexão para trabalhar com o mesmo link nas funcões de COMMIT e ROLLBACK
function update_pessoa($idPessoa, $idCliente, $nome, $sobrenome, $email, $telefone, $celular, $rg, $cpf, $mysqli) {
    $pessoa = new Pessoa($idCliente, $nome, $sobrenome, $email, $telefone, $celular, $rg, $cpf);
    $pessoa->setIdPessoa($idPessoa);
    $pessoaDao = new PessoaDao();
    $queryError = $pessoaDao->update($pessoa, $mysqli);
    if (!$queryError == NULL) {
        throw new Exception("$queryError");
    }
    if ($queryError == NULL) {
        return $pessoaDao->getIdPessoa(); //retorna o id
    } else {
        return $pessoa; //retorna o objeto
    }
}

function salvar_pedido($idCliente, $mysqli) {
    date_default_timezone_set('America/Sao_Paulo');
    $pedido = new Pedido(NULL, $_SESSION["UsuarioID"], $idCliente, $_SESSION['cliente']['local_retirada'], date('Y-m-d H:i:s'), 1, $_SESSION['cliente']['tipo_solicitacao'], $_SESSION['local_venda']);
    $pedidoDao = new PedidoDao($pedido, $mysqli);
    $queryError = $pedidoDao->insert($pedido, $mysqli);
    if (!$queryError == NULL) {
        throw new Exception("$queryError");
    }
    if ($queryError == NULL) {
        return $pedidoDao->getIdPedido(); //retorna o id
    } else {
        return $pedido; //retorna o objeto
    }
}

function salvar_orcamento($idCliente, $mysqli) {
    date_default_timezone_set('America/Sao_Paulo');
    $orcamento = new Orcamento(NULL, $_SESSION["UsuarioID"], $idCliente, date('Y-m-d H:i:s'), 1, $_SESSION['local_venda']);
    $orcamentoDao = new OrcamentoDao($orcamento, $mysqli);
    $queryError = $orcamentoDao->insert($orcamento, $mysqli);
    if (!$queryError == NULL) {
        throw new Exception("$queryError");
    }
    if ($queryError == NULL) {
        return $orcamentoDao->getIdOrcamento(); //retorna o id
    } else {
        return $orcamento; //retorna o objeto
    }
}

//O valor enviado na variavel: $valorUnitario é o valor com o desconto
function salvar_item_convite($idConvite, $mysqli, $idPedido, $quantidade, $dataEntrega, $valorUnitario, $desconto, $idOrcamento) {
    $itensConvite = new ItensConvite($idPedido, $quantidade, $dataEntrega, $idConvite, $valorUnitario, $desconto, $idOrcamento);
    $itensConviteDao = new ItensConviteDao($itensConvite, $mysqli);
    $queryError = $itensConviteDao->insert($itensConvite, $mysqli);
    if (!$queryError == NULL) {
        throw new Exception("$queryError");
    }
    if ($queryError == NULL) {
        return $itensConviteDao->getIdItem(); //retorna o id
    } else {
        return $itensConvite; //retorna o objeto
    }
}

function salvar_item_convite_orcamento($idConvite, $idOrcamento, $mysqli, $quantidade, $valorUnitario, $desconto) {
    $itensConviteOrcamento = new ItensConviteOrcamento(NULL, $idOrcamento, $quantidade, $idConvite, $valorUnitario, $desconto);
    $itensConviteOrcamentoDao = new ItensConviteOrcamentoDao($itensConviteOrcamento, $mysqli);
    $queryError = $itensConviteOrcamentoDao->insert($itensConviteOrcamento, $mysqli);
    if (!$queryError == NULL) {
        throw new Exception("$queryError");
    }
    if ($queryError == NULL) {
        return $itensConviteOrcamentoDao->getIdItem(); //retorna o id
    } else {
        return $itensConviteOrcamento; //retorna o objeto
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

if ($_GET['acao'] == "seleciona_orcamento") {
    foreach ($_SESSION as $key => $value) {
        if (strstr($key, 'convite-')) {
            unset($_SESSION[$key]);
        }
    }
    unset($_SESSION["convite"]);
    unset($_SESSION["cliente"]);
    $connectionFactory = new ConnectionFactory();
    $mysqli = $connectionFactory->get_Mysqli();
    $query = "SELECT id_orcamento, id_funcionario, orc.id_cliente, data_orcamento, status, local_venda, 
                data_evento, evento_tipo, rua, numero, complemento, estado, bairro, cidade, cep, observacao 
                FROM orcamento as orc
                LEFT JOIN cliente AS cli ON orc.id_cliente = cli.id_cliente
                WHERE orc.id_orcamento = {$_GET["id"]}";
    $result1 = $mysqli->query($query);
    $tabela_orcamento = mysqli_fetch_assoc($result1);

    var_dump($tabela_orcamento);
    //die();
    $query = "SELECT * FROM pessoa WHERE id_cliente = {$tabela_orcamento["id_cliente"]}";
    $result2 = $mysqli->query($query);
    $count = 0;
    while ($count < $result2->num_rows) { //aqui ele conta uma passagem !!!!
        $tabela_pessoa[] = mysqli_fetch_assoc($result2);
        $count ++;
    }
    var_dump($tabela_pessoa);
    //die();
//cliente
    $_SESSION['cliente']["id"] = $tabela_orcamento["id_cliente"]; //ID do Cliente
    $_SESSION['local_venda'] = $tabela_orcamento["local_venda"];
    $_SESSION['cliente']["evento"] = $tabela_orcamento["evento_tipo"];
    $_SESSION['cliente']["data_evento"] = date_format(date_create($tabela_orcamento["data_evento"]), "Y-m-d");
    $_SESSION['cliente']["rua"] = $tabela_orcamento["rua"];
    $_SESSION['cliente']["numero"] = $tabela_orcamento["numero"];
    $_SESSION['cliente']["bairro"] = $tabela_orcamento["bairro"];
    $_SESSION['cliente']["complemento"] = $tabela_orcamento["complemento"];
    $_SESSION['cliente']["cep"] = $tabela_orcamento["cep"];
    $_SESSION['cliente']["cidade"] = $tabela_orcamento["cidade"];
    $_SESSION['cliente']["estado"] = $tabela_orcamento["estado"];
    $_SESSION['cliente']["observacao"] = $tabela_orcamento["observacao"];
    $_SESSION['cliente']['tipo_solicitacao'] = "orcamento";

//Pessoa 1
    $_SESSION['cliente']["id_pessoa"] = $tabela_pessoa[0]["id_pessoa"];
    $_SESSION['cliente']["nome"] = $tabela_pessoa[0]["nome"];
    $_SESSION['cliente']["sobrenome"] = $tabela_pessoa[0]["sobrenome"];
    $_SESSION['cliente']["email"] = $tabela_pessoa[0]["email"];
    $_SESSION['cliente']["telefone"] = $tabela_pessoa[0]["telefone"];
    $_SESSION['cliente']["celular"] = $tabela_pessoa[0]["celular"];
    $_SESSION['cliente']["rg"] = $tabela_pessoa[0]["rg"];
    $_SESSION['cliente']["cpf"] = $tabela_pessoa[0]["cpf"];

//Pessoa 2
    $_SESSION['cliente']["id_pessoa2"] = $tabela_pessoa[1]["id_pessoa"];
    $_SESSION['cliente']["nome2"] = $tabela_pessoa[1]["nome"];
    $_SESSION['cliente']["sobrenome2"] = $tabela_pessoa[1]["sobrenome"];
    $_SESSION['cliente']["email2"] = $tabela_pessoa[1]["email"];
    $_SESSION['cliente']["telefone2"] = $tabela_pessoa[1]["telefone"];
    $_SESSION['cliente']["celular2"] = $tabela_pessoa[1]["celular"];
    $_SESSION['cliente']["rg2"] = $tabela_pessoa[1]["rg"];
    $_SESSION['cliente']["cpf2"] = $tabela_pessoa[1]["cpf"];
    print '<pre>';
    //var_dump($tabela_orcamento);
    var_dump($tabela_orcamento);
    print '</pre>';
    //die();
    $query = "SELECT * FROM itens_convite_orcamento WHERE id_orcamento = {$_GET["id"]}";
    $result = $mysqli->query($query);
    while ($tabela_itens_convite_orcamento = mysqli_fetch_assoc($result)) {
        $itens[] = $tabela_itens_convite_orcamento;
    }
    foreach ($itens as $key => $value) {
        seleciona_convite_sessao($value["id_convite"], $mysqli);
        $_SESSION["convite"]["quantidade"] = $value["quantidade"];
        $_SESSION["convite"]["descontoPorcentagem"] = $value["desconto_porcentagem"];
        calculaPrecoAutomatico($value["quantidade"]);
        add_convite_carrinho($key); //O valor enviado é a posição que cada convite ficará na sessão EX: $_SESSION['convite-1'] ($_SESSION['convite-$key'])
    }
    ob_end_clean(); // esta função no começo da página auxiliou no redirecionamento. (Colocar ob_start(); no topo da página.)
    header("location: orcamento_carrinho.php");
    die();
}


//Seleciona o convite do orçamento
if ($_GET['acao'] == "seleciona_convite_orcamento") {
    $connectionFactory = new ConnectionFactory();
    $mysqli = $connectionFactory->get_Mysqli();
    unset($_SESSION['convite']);
    seleciona_convite_sessao($_GET['convite_orcamento'], $mysqli);
    header("location: orcamento_convite.php");
    die();
}

function seleciona_convite_sessao($id, $mysqli) {
    criaSessao();
    $_SESSION['convite']['orcamento']['id'] = $id;
    $conviteDao = new ConviteDao();
    $conviteDao->selectConviteSessao($id, $mysqli);
    if ($_GET['acao'] == "seleciona_convite_orcamento") {
        calculaCentoConvite();
    }
}

if ($_GET['acao'] == "salvar_desconto_convite" && $_GET['desconto'] >= 0 && $_GET['desconto'] <= 20) {
    $_SESSION['convite']['descontoPorcentagem'] = $_GET['desconto'];
    $_SESSION['convite']['desconto'] = CalculaPreco($_SESSION['convite'], $_SESSION['convite']['descontoPorcentagem']);
    header("location: orcamento_convite.php");
    die();
}
header("location: orcamento_convite.php");
?>