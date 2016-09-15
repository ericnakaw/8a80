<?php
$pageName = "Papel Categoria Formulário"; //nome da página
include './conexao/Conexao.php';
include './objeto/CategoriaPapel.php';
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
    $pageName = "Nova Categoria Papel";
    $acao = "papel_categoria_inserir.php";
} else {
    $conexao = new Conexao();
    $categoriaPapel = new CategoriaPapel($conexao);
    $resultado = $categoriaPapel->selectCategoriaPapel($arr["id"]);
    $tabela = mysql_fetch_array($resultado);
    $id = $tabela["id"];
    $nome = $tabela["nome"];
    $valor = $tabela["valor"];
    $botao = "Alterar";
    $pageName = "Alterar Categoria Papel";
    $acao = "papel_categoria_alterar.php?id=" . $id;
}
?>
<script>
    // Validador do Formulario
    function valida() {
        if ($("#nomeCategoria").val() === "") {
            alert('preencha o nome da categoria');
            $("#nomeCategoria").focus();
            return false;
        }
        if ($("#valorCategoria").val() === "") {
            alert('preencha o valor da categoria');
            $("#valorCategoria").focus();
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
                        <label for="nomeCategoria">Nome Categoria:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $nome; ?>" name="nomeCategoriaPapel" id="nomeCategoria" placeholder="Entre com a categoria" >
                    </div>
                    <div class="form-group">
                        <label for="valorCategoria">Valor:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $valor; ?>" name="valorCategoriaPapel" id="valorCategoria" placeholder="Entre com o valor" >
                    </div>

                    <button type="submit" class="btn btn-success"><?php print $botao; ?>
                    </button>
                    <a class="btn btn-default" href="papel_categoria.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>