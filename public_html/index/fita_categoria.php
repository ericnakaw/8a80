<?php
$pageName = "Fita Categoria";
$confDelete = 'fita_categoria_deletar.php';
include './header.php';
$permissao = Array("gerente", "tecnico", "vendas");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}
include './conexao/Conexao.php';
?>

<body>
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <div id="conteudo" class="col-md-12">
                    <h2><?php print $pageName; ?></h2> 
                    <!--Botao de nova categoria-->
                    <form action="fita_categoria_formulario.php" method="POST" role="form">
                        <a href="fita_categoria_formulario.php">
                            <button class="btn btn-primary" id="<?php echo $tabela['id'] ?>">
                                <span class="glyphicon glyphicon-plus"></span>Nova Categoria
                            </button>
                        </a>
                        <a class="btn btn-default" href="fita.php">VOLTAR
                        </a>
                        <p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-condensed">
                                <colgroup>
                                    <col width="10%">
                                    <col width="40%">
                                    <col width="30%">
                                    <col width="10%">
                                    <col width="10%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>Valor R$</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $conexao = new Conexao();
                                    $resultado = $conexao->sql_query("SELECT * FROM fita_categoria ORDER BY id ASC");

                                    while ($tabela = mysql_fetch_array($resultado)) {
                                        ?>
                                        <tr>
                                            <td><?= $tabela['id'] ?></td>
                                            <td class="text-uppercase"><?= $tabela['nome'] ?></td>
                                            <td>R$ <?= number_format($tabela['valor'], 2, ",", ".") ?></td>

                                            <!--Botao de editar-->
                                            <td>
                                                <a href ="fita_categoria_formulario.php?id=<?php echo $tabela['id'] ?>" class="btn btn-primary">
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
                        </div>
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
