<?php
$pageName = "Produto Formulário"; //nome da página
include './conexao/Conexao.php';
include './objeto/Produto.php';
include './header.php';
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}

$arr = $_REQUEST;

if (empty($arr["id"])) {
    $produtoCategoriaId = "";
    $nome = "";
    $valor = "";
    $botao = "Inserir";
    $pageName = "Novo Produto";
    $acao = "produto_inserir.php";
} else {
    $conexao = new Conexao();
    $produto = new Produto($conexao);
    $resultado = $produto->selectProduto($arr["id"]);
    $tabela = mysql_fetch_array($resultado);
    $id = $tabela["id"];
    $produtoCategoriaId = $tabela["produto_categoria_id"];
    $nome = $tabela["nome"];
    $valor = $tabela["valor"];
    $descricao = $tabela["descricao"];
    $botao = "Alterar";
    $pageName = "Alterar Produto";
    $acao = "produto_alterar.php?id=" . $id;
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
                        <label for="nomeProduto">Nome Produto:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $nome; ?>" name="nomeProduto" id="nomeProduto" placeholder="Entre com o Produto" >
                    </div>
                    <div class="form-group">
                        <label for="produtoCategoriaId">Categoria:</label>
                        <select class="form-control" name="produtoCategoriaId" >
                            <?php
                            $conexao = new Conexao();
                            $resultado = $conexao->sql_query("SELECT * FROM produto_categoria");
                            print "<option value =''>Selecione uma categoria</option>";
                            while ($tabela = mysql_fetch_array($resultado)) {
                                print "<option value=' " . $tabela["id"] . "'";
                                if ($produtoCategoriaId == $tabela["id"]) {
                                    print "selected";
                                }
                                print ">" . $tabela["nome"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="valorProduto">Valor:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $valor; ?>" name="valorProduto" id="valorProduto" placeholder="Entre com o valor" >
                    </div>
                    <div class="form-group">
                        <label for="descricaoProduto">Descrição:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $descricao; ?>" name="descricaoProduto" id="descricaoProduto" placeholder="Entre a descrição do produto" >
                    </div>

                    <button type="submit" class="btn btn-success"><?php print $botao; ?>
                    </button>
                    <a class="btn btn-default" href="produto.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>