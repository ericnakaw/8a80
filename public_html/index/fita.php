<?php
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Fita";
$confDelete = 'fita_deletar.php';
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}
include './header.php';
include './conexao/Conexao.php';
?>
<body>
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <div id="conteudo" class="col-md-12">

                    <h2><?php print $pageName; ?></h2> 
                    <!--Botao de nova categoria-->
                    <form action="fita_formulario.php" method="POST" role="form">
                        <a href="fita_formulario.php">
                            <button class="btn btn-primary" id="<?= $tabela['id'] ?>" >
                                <span class="glyphicon glyphicon-plus"></span> Nova Fita
                            </button>
                        </a>
                        <a class="btn btn-primary " href="fita_categoria.php">
                            <span class="glyphicon glyphicon-th-list"></span> Categoria Lista
                        </a>
                        <a class="btn btn-default" href="index.php">VOLTAR
                        </a>

                        <p>
                        <table class="table table-hover table-responsive">
                            <colgroup>
                                <col width="5%">
                                <col width="15%">
                                <col width="5%">
                                <col width="5%">
                                <col width="5%">
                                <col width="5%">
                                <!--<col width="10%">-->
                            </colgroup>
                            <thead>
                                <tr>
                                    <!--<th>#</th>-->
                                    <th>Imagem</th>
                                    <th>Cor</th>
                                    <th>Código do Fabricante</th>
                                    <th>Fabricante</th>
                                    <th>Editar</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query("SELECT * from fita order by cor asc");
                                while ($tabela = mysql_fetch_array($resultado)) {
                                    ?>
                                    <tr>
                                        <!--<td style="vertical-align:middle"> <?= $tabela['id'] ?></td>-->
                                        <td style="vertical-align:middle"> <img src="<?= $tabela['imagem'] ?>" class="img-rounded img-responsive" height="100" width="130"> </td>
                                        <td class="text-uppercase" style="vertical-align:middle"> <?= $tabela['cor'] ?></td>
                                        <td style="vertical-align:middle"> <?= $tabela['codigo'] ?></td>
                                        <td class="text-uppercase" style="vertical-align:middle"> <?= $tabela['fabricante'] ?> </td>
                                        <!--Botao de editar-->
                                        <td style="vertical-align:middle">
                                            <a href ="fita_formulario.php?id=<?php echo $tabela['id'] ?>" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-pencil"></span> Editar
                                            </a>
                                        </td>
                                        <!--Botao de deletar-->
                                        <td style="vertical-align:middle">
                                            <a data-toggle="modal" data-target="#myModal" data-whatever="@mdo" onclick="confDeletar(<?= $tabela['id'] ?>, '<?= $tabela['cor'] ?>')" class="btn btn-danger">
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