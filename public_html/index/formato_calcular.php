<?php
include './objeto/Formato.php';
if($_POST["inverter"]==1){  
    $inverter = 1;
}  else {
    $inverter = 0;
}
list($largura,$comprimento) = explode("x",$_POST["papel_tamanho"]);
$formtato = new Formato($_POST["formato_largura"], $_POST["formato_comprimento"], 0, $largura, $comprimento,$_POST["quantidade_pedido"]);
$resultado = $formtato->calculaFormato($inverter);
$a = $resultado["a"];
$b = $resultado["b"];
$c = $resultado["formato"];
$folha_inteira = $resultado["folha_inteira"];
$sobra_a = $resultado["sobra_a"];
$sobra_b = $resultado["sobra_b"];
header("location: formato.php?a=$a&b=$b&c=$c&formato_largura={$_POST["formato_largura"]}&formato_comprimento={$_POST["formato_comprimento"]}&papel={$_POST["papel_tamanho"]}&quantidade_pedido={$_POST["quantidade_pedido"]}&folha_inteira={$folha_inteira}&sobra_a={$sobra_a}&sobra_b={$sobra_b}&inverter={$_POST["inverter"]}"); 
die();