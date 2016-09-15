<?php
if (!isset($_SESSION)) {
    session_start(); 
}
$pageName = "Acabamento Formulário"; //nome da página
include './conexao/Conexao.php';
include './objeto/Acabamento.php';
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
    $pageName = "Novo Acabamento";
    $acao = "acabamento_inserir.php";
} else {
    $conexao = new Conexao();
    $acabamento = new Acabamento($conexao);
    $resultado = $acabamento->selectAcabamento($arr["id"]);
    $tabela = mysql_fetch_array($resultado);
    $id = $tabela["id"];
    $nome = $tabela["nome"];
    $valor = $tabela["valor"];
    $botao = "Alterar";
    $pageName = "Alterar Acabamento";
    $acao = "acabamento_alterar.php?id=" . $id;
}
?>
<script>
    // Validador do Formulario
    function valida() {
        if ($("#nomeAcabamento").val() === "") {
            alert('preencha o nome do acabamento');
            $("#nomeAcabamento").focus();
            return false;
        }
        if ($("#valorAcabamento").val() === "") {
            alert('preencha o valor do acabamento');
            $("#valorAcabamento").focus();
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
                        <label for="nomeAcabamento">Nome Acabamento:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $nome; ?>" name="nomeAcabamento" id="nomeAcabamento" placeholder="Entre com o Acabamento" >
                    </div>
                    <div class="form-group">
                        <label for="valorAcabamento">Valor:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $valor; ?>" name="valorAcabamento" id="valorAcabamento" placeholder="Entre com o valor" >
                    </div>

                    <button type="submit" class="btn btn-success"><?php print $botao; ?>
                    </button>
                    <a class="btn btn-default" href="acabamento.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>