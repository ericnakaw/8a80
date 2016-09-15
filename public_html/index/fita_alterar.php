<?php
include './conexao/Conexao.php';
include './objeto/Fita.php';

$arr = $_REQUEST;
$id = $arr["id"];
$cor = strtoupper($arr["corFita"]);
$codigo = $arr["codigoFita"];
$fabricante = strtoupper($arr["fabricanteFita"]);
$target_dir = "./img/fita/";//diretório
print $imagemFita = $target_dir.$_FILES["imagemFita"]["name"];//diretório/nome_do_arquivo
$conexao = new Conexao();
$fita = new Fita($conexao);
$fita->updateFita($id, $cor, $codigo, $fabricante, $imagemFita,$target_dir);

$target_file = $target_dir . basename($_FILES["imagemFita"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imagemFita"]["tmp_name"]);
    if($check !== false) {
        echo "O arquivo é uma imagem - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "O arquivo não é uma imagem.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Desculpe, a imagem já existe.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Desculpe, a imagem ultrapassa 500Kb.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Desculpe, somente arquivos JPG, JPEG, PNG e GIF são permitidos.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Desculpe, não foi possivel fazer o upload do arquivo.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["imagemFita"]["tmp_name"], $target_file)) {
        echo "O upload do arquivo: ". basename( $_FILES["imagemFita"]["name"]). " foi realizado com sucesso.";
    } else {
        echo "Desculpe, houve um erro na tentativa de upload do arquivo.";
    }
}
header("location: fita.php");

