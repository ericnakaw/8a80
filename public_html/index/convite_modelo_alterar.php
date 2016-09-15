<?php
include './conexao/Conexao.php';
include './objeto/ConviteModelo.php';

$arr = $_REQUEST;
$id = $arr["id"];
$cod = $arr["codModelo"];
$nomeModelo = strtoupper($arr["nomeModelo"]);
$alturaModelo = $arr["alturaModelo"];
$larguraModelo = $arr["larguraModelo"];
$aproveitamentoCartao = $arr["aproveitamentoCartao"];
$aproveitamentoEnvelope = $arr["aproveitamentoEnvelope"];
$formatoCartaoAltura = $arr["formatoCartaoAltura"];
$formatoCartaoLargura = $arr["formatoCartaoLargura"];
$formatoEnvelopeAltura = $arr["formatoEnvelopeAltura"];
$formatoEnvelopeLargura = $arr["formatoEnvelopeLargura"];
$composicao = $arr["composicao"];
$dobra = $arr["dobra"];
$duplaFace = $arr["duplaFace"];
$colagem = $arr["colagem"];
$empastamentoBorda = $arr["empastamentoBorda"];
$empastamentoBordaEnv = $arr["empastamentoBordaEnvelope"];
$markup = str_replace(",", ".",$arr["markup"]);
$observacao = $arr["observacao"];
$conexao = new Conexao();
$conviteModelo = new ConviteModelo($conexao);
$conviteModelo->updateConviteModelo($id, $cod, $nomeModelo, $alturaModelo, $larguraModelo, $aproveitamentoCartao, $aproveitamentoEnvelope, $formatoCartaoAltura, $formatoCartaoLargura, $formatoEnvelopeAltura, $formatoEnvelopeLargura, $composicao, $dobra, $duplaFace, $colagem,$markup,$observacao,$empastamentoBorda,$empastamentoBordaEnv);
header("location: convite_modelo.php");

