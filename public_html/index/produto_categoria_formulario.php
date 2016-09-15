<?php
$pageName = "Produto Categoria Formulário"; //nome da página
include './conexao/Conexao.php';
include './objeto/ProdutoCategoria.php';
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
    $pageName = "Nova Categoria";
    $acao = "produto_categoria_inserir.php";
} else {
    $conexao = new Conexao();
    $categoria = new ProdutoCategoria($conexao);
    $resultado = $categoria->selectProdutoCategoria($arr["id"]);
    $tabela = mysql_fetch_array($resultado);
    $id = $tabela["id"];
    $nome = $tabela["nome"];
    $botao = "Alterar";
    $pageName = "Alterar Categoria";
    $acao = "produto_categoria_alterar.php?id=" . $id;
}
?>

<body>
    <div class="container">
        <!--primeira linha da row-->
        <div class="row">
            <div class="col-md-6">
                <h2><?php print $pageName; ?></h2>

                <!--inserir ou alterar na acao-->
                <form action="<?php echo $acao ?>" method="POST" role="form">
                    <div class="form-group">
                        <label for="nome">Nome Categoria:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $nome; ?>" name="nome" id="nome" placeholder="Entre com a categoria" >
                    </div>
                    <button type="submit" class="btn btn-success"><?php print $botao; ?>
                    </button>
                    <a class="btn btn-default" href="produto_categoria.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>