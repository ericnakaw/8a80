<?php
$pageName = "Fita Formulário"; //nome da página
include './conexao/Conexao.php';
include './objeto/Fita.php';
include './header.php';
$permissao = Array("gerente", "tecnico", "vendas");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}

$arr = $_REQUEST;

if (empty($arr["id"])) {
    $cor = "";
    $codigo = "";
    $fabricante = "";
    $imagemFita = "";
    $botao = "Inserir";
    $pageName = "Nova Fita";
    $acao = "fita_inserir.php";
} else {
    $conexao = new Conexao();
    $fita = new Fita($conexao);
    $resultado = $fita->selectFita($arr["id"]);
    $tabela = mysql_fetch_array($resultado);
    $id = $tabela["id"];
    $cor = $tabela["cor"];
    $codigo = $tabela["codigo"];
    $fabricante = $tabela["fabricante"];
    $imagemFita = $tabela["imagem"];
    $botao = "Alterar";
    $pageName = "Alterar Fita";
    $acao = "fita_alterar.php?id=" . $id;
}
?>
<script>
    // Validador do Formulario
    function valida() {
        if ($("#corFita").val() === "") {
            alert('preencha a cor');
            $("#corFita").focus();
            return false;
        }
        if ($("#codigoFita").val() === "") {
            alert('preencha o código');
            $("#codigoFita").focus();
            return false;
        }
        if ($("#fabricanteFita").val() === "") {
            alert('Preencha o fabricante');
            $("#fabricanteFita").focus();
            return false;
        }
    }
</script>
<body>
    <div class="container">
        <!--primeira linha da row-->
        <div class="row">
            <div class="col-md-6">
                <h2><?= $pageName; ?></h2>

                <!--inserir ou alterar na acao-->
                <form action="<?php echo $acao ?>" method="POST" role="form" enctype="multipart/form-data" onsubmit="return valida()">

                    <div class="form-group">
                        <label for="corFita">Cor Fita:
                        </label>
                        <input type="text" class="form-control" value= "<?= $cor; ?>" name="corFita" id="corFita" placeholder="Entre com a cor" >
                    </div>
                    <div class="form-group">
                        <label for="codigoFita">Código Fita:
                        </label>
                        <input type="text" class="form-control" value= "<?= $codigo; ?>" name="codigoFita" id="codigoFita" placeholder="Entre com o código" >
                    </div>
                    <div class="form-group">
                        <label for="fabricanteFita">Fabricante:
                        </label>
                        <input type="text" class="form-control" value= "<?= $fabricante; ?>" name="fabricanteFita" id="fabricanteFita" placeholder="Entre com o fabricante" >
                    </div>
                    <div class="form-group">
                        <label for="imagemFita">Imagem:
                        </label>
                        <input type="file" class="form-control" value= "<?= $imagemFita; ?>"  name="imagemFita" id="imagemFita" placeholder="Escolha uma imagem" >
                    </div>
                    <button type="submit" class="btn btn-success"><?= $botao; ?>
                    </button>
                    <a class="btn btn-default" href="fita.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>