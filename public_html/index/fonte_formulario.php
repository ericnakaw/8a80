<?php
$pageName = "Fonte Formulário"; //nome da página
include './conexao/Conexao.php';
include './objeto/Fonte.php';
include './header.php';
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}

$arr = $_REQUEST;

if (empty($arr["id"])) {
    $nome = "";
    $botao = "Inserir";
    $pageName = "Nova Fonte";
    $acao = "fonte_inserir.php";
} else {
    $conexao = new Conexao();
    $fonte = new Fonte($conexao);
    $resultado = $fonte->selectFonte($arr["id"]);
    $tabela = mysql_fetch_array($resultado);
    $id = $tabela["id"];
    $nome = $tabela["nome"];
    $botao = "Alterar";
    $pageName = "Alterar Fonte";
    $acao = "fonte_alterar.php?id=" . $id;
}
?>
<script>
    // Validador do Formulario
    function valida() {
        if ($("#nomeFonte").val() === "") {
            alert('preencha o nome da fonte');
            $("#nomeFonte").focus();
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
                        <label for="nomeCategoria">Nome Fonte:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $nome; ?>" name="nomeFonte" id="nomeFonte" placeholder="Entre com a fonte" >
                    </div>
                    <button type="submit" class="btn btn-success"><?php print $botao; ?>
                    </button>
                    <a class="btn btn-default" href="fonte.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>