<?php
$pageName = "Papel Formulário"; //nome da página
include './conexao/Conexao.php';
include './objeto/Papel.php';
include './header.php';
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}

$arr = $_REQUEST;

if (empty($arr["id"])) {
    $nome = "";
    $categoria = "";
    $papel = "";
    $gramatura = "";
    $botao = "Inserir";
    $pageName = "Novo Papel";
    $acao = "papel_inserir.php";
} else {
    $conexao = new Conexao();
    $papel = new Papel($conexao);
    $resultado = $papel->selectPapel($arr["id"]);
    $tabela = mysql_fetch_array($resultado);
    $id = $tabela["id"];
    $categoriaPapelId = $tabela["categoria_papel_id"];
    $nomePapel = $tabela["nome"];
    $gramatura = $tabela["gramatura"];
    $botao = "Alterar";
    $pageName = "Alterar Papel";
    $acao = "papel_alterar.php?id=" . $id;
}
?>

<script>
    // Validador do Formulario
    function valida() {
        if ($("#nomePapel").val() === "") {
            alert('preencha o nome do papel');
            $("#nomePapel").focus();
            return false;
        }
        if ($("#categoriaPapelId").val() === "") {
            alert('Selecione uma categoria');
            $("#categoriaPapelId").focus();
            return false;
        }
        if ($("#gramaturaPapel").val() === "") {
            alert('Preencha a gramatura do papel');
            $("#gramaturaPapel").focus();
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
                        <label for="nomeCategoria">Nome Papel:
                        </label>
                        <input type="text" class="form-control" value= "<?= $nomePapel ?>" name="nomePapel" id="nomePapel" placeholder="Entre com o papel" >
                    </div>
                    <div class="form-group">
                        <label for="categoriaPapel">Categoria Papel:
                        </label>
                        <select class="form-control" name="categoriaPapelId" id="categoriaPapelId" >
                            <?php
                            $conexao = new Conexao();
                            $resultado = $conexao->sql_query("SELECT * FROM categoria_papel order by nome asc");
                            ?>
                            <option value="">Selecione uma categoria</option>
                            <?php
                            while ($tabela = mysql_fetch_array($resultado)) {
                                ?>
                                <option value="<?= $tabela["id"] ?>"
                                <?php
                                if ($categoriaPapelId == $tabela["id"]) {
                                    print "selected";
                                }
                                ?>
                                        ><?= $tabela["nome"] ?></option>
                                        <?php
                                    }
                                    ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gramaturaPapel">Gramatura Papel:
                        </label>
                        <input type="text" class="form-control" value= "<?= $gramatura ?>" name="gramaturaPapel" id="gramaturaPapel" placeholder="Entre com a gramatura" >
                    </div>


                    <button type="submit" class="btn btn-success"><?php print $botao; ?>
                    </button>
                    <a class="btn btn-default" href="papel.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>