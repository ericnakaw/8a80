<?php
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Fita Categoria Formulário"; //nome da página
$permissao = Array("gerente", "tecnico", "vendas");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}

include './conexao/Conexao.php';
include './objeto/FitaCategoria.php';
include './header.php';
$arr = $_REQUEST;

if (empty($arr["id"])) {
    $nome = "";
    $valor = "";
    $botao = "Inserir";
    $pageName = "Nova Categoria Fita";
    $acao = "fita_categoria_inserir.php";
} else {
    $conexao = new Conexao();
    $fitaCategoria = new FitaCategoria($conexao);
    $resultado = $fitaCategoria->selectFitaCategoria($arr["id"]);
    $tabela = mysql_fetch_array($resultado);
    $id = $tabela["id"];
    $nome = $tabela["nome"];
    $valor = $tabela["valor"];
    $botao = "Alterar";
    $pageName = "Alterar Categoria Fita";
    $acao = "fita_categoria_alterar.php?id=" . $id;
}
?>
<script>
    // Validador do Formulario
    function valida() {
        if ($("#nomeCategoriaFita").val() === "") {
            alert('preencha o nome da categoria');
            $("#nomeCategoriaFita").focus();
            return false;
        }
        if ($("#valorCategoriaFita").val() === "") {
            alert('preencha o valor da categoria');
            $("#valorCategoriaFita").focus();
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
                        <label for="nomeCategoriaFita">Nome Categoria:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $nome; ?>" name="nomeCategoriaFita" id="nomeCategoriaFita" placeholder="Entre com a categoria" >
                    </div>
                    <div class="form-group">
                        <label for="valorCategoriaFita">Valor:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $valor; ?>" name="valorCategoriaFita" id="valorCategoriaFita" placeholder="Entre com o valor" >
                    </div>

                    <button type="submit" class="btn btn-success"><?php print $botao; ?>
                    </button>
                    <a class="btn btn-default" href="fita_categoria.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>