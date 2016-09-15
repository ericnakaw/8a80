<?php
$pageName = "Cor Impressão Formulário"; //nome da página
include './conexao/Conexao.php';
include './objeto/CorImpressao.php';
include './header.php';
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}

$arr = $_REQUEST;

if (empty($arr["id"])) {
    $nome = "";
    $valor = "";
    $botao = "Inserir";
    $pageName = "Nova Cor de Impressão";
    $acao = "cor_impressao_inserir.php";
} else {
    $conexao = new Conexao();
    $corImpressao = new CorImpressao($conexao);
    $resultado = $corImpressao->selectCorImpressao($arr["id"]);
    $tabela = mysql_fetch_array($resultado);
    $id = $tabela["id"];
    $nome = $tabela["nome"];
    $valor = $tabela["detalhe"];
    $botao = "Alterar";
    $pageName = "Alterar Cor Impressão";
    $acao = "cor_impressao_alterar.php?id=" . $id;
}
?>
<script>
    // Validador do Formulario
    function valida() {
        if ($("#nomeCorImpressao").val() === "") {
            alert('preencha o nome da cor da impressão');
            $("#nomeCorImpressao").focus();
            return false;
        }
        if ($("#detalheCorImpressao").val() === "") {
            alert('Preencha com a descrição');
            $("#detalheCorImpressao").focus();
            return false;
        }
    }
</script>
<body>
    <div class="container">
        <!--primeira linha da row-->
        <div class="row">
            <div class="col-md-6">
                <h2><?php print $pageName; ?></h2>

                <!--inserir ou alterar na acao-->
                <form action="<?php echo $acao ?>" method="POST" role="form" onsubmit="return valida()">

                    <div class="form-group">
                        <label for="corImpressao">Nome Cor Impressão:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $nome; ?>" name="nomeCorImpressao" id="nomeCorImpressao" placeholder="Entre com a Cor da Impressão" >
                    </div>
                    <div class="form-group">
                        <label for="detalheCorImpressao">Detalhe:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $valor; ?>" name="detalheCorImpressao" id="detalheCorImpressao" placeholder="Entre com o detalhe da cor" >
                    </div>

                    <button type="submit" class="btn btn-success"><?php print $botao; ?>
                    </button>
                    <a class="btn btn-default" href="cor_impressao.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>