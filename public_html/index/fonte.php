<?php
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Fonte";
$confDelete = 'fonte_deletar.php';
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
                <div id="conteudo" class="col-md-6">
                    <h2><?php print $pageName; ?></h2> 
                    <form action="fonte_formulario.php" method="POST" role="form">
                        <a href="fonte_formulario.php">
                            <button class="btn btn-primary" id="<?=$tabela['id'] ?>" >
                                    <span class="glyphicon glyphicon-plus"></span> Nova Fonte
                            </button>
                        </a>
                            <a class="btn btn-default" href="index.php">VOLTAR
                            </a>
                        <p>
                        <table class="table table-bordered table-hover">
                            <colgroup>
                                <!--<col width="10%">-->
                                <col width="70%">
                                <col width="10%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <!--<th>#</th>-->
                                    <th>Fonte</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query("SELECT * FROM fonte ORDER BY nome ASC");

                                while ($tabela = mysql_fetch_array($resultado)) {
                                    print '<tr>';
//                                    print '<td>' . $tabela['id'] . '</td>';
                                    print '<td>' . $tabela['nome'] . '</td>';
                                    ?>
                                    <!--Botao de editar-->
                                <td>
                                    <a href ="fonte_formulario.php?id=<?php echo $tabela['id'] ?>" class="btn btn-primary">
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