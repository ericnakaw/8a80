<?php
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
$pageName = "Produto Categoria";
$confDelete = 'produto_categoria_deletar.php';
include './header.php';
include './conexao/Conexao.php';
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
header("location: login.php?msg=Sem_permisao");
die();
}
?>
<body>
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <div id="conteudo" class="col-md-6">
                    <h2><?php print $pageName; ?></h2> 
                    <!--Botao de novo produto-->
                    <form action="produto_categoria_formulario.php" method="POST" role="form">
                        <a href="produto_categoria_formulario.php">
                            <button class="btn btn-primary" id="<?php echo $tabela['id'] ?>" >
                                <span class="glyphicon glyphicon-plus"></span> Nova Categoria
                            </button>
                        </a>
                        <a class="btn btn-default" href="produto.php">VOLTAR
                        </a>
                        <p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-condensed table-striped table-hover">
                                <colgroup>
                                    <col width="40%">
                                    <col width="20%">
                                    <col width="20%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Categoria</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $conexao = new Conexao();
                                    $resultado = $conexao->sql_query("SELECT * FROM produto_categoria ORDER BY nome ASC");

                                    while ($tabela = mysql_fetch_array($resultado)) {
                                    ?>
                                    <tr> 
                                        <td><?= $tabela['nome'] ?></td>
                                        <!--Botao de editar-->
                                        <td>
                                            <a href ="produto_categoria_formulario.php?id=<?php echo $tabela['id'] ?>" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-pencil"></span> Editar
                                            </a>
                                        </td>
                                        <!--Botao de deletar-->
                                        <td>
                                            <a data-toggle="modal" data-target="#myModal" data-whatever="@mdo" onclick="confDeletar(<?= $tabela['id'] ?>, '<?= $tabela['nome'] ?>')" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash"></span> Apagar
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                    </form>
                    <?php include './cancelar_acao.php'; ?>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>