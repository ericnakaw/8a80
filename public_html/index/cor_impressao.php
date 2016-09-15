<?php
$pageName = "Cor Impressão";
$confDelete = 'cor_impressao_deletar.php';
include './header.php';
$permissao = Array("gerente", "tecnico");
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
                    <form action="cor_impressao_formulario.php" method="POST" role="form">
                        <a href="cor_impressao_formulario.php">
                            <button class="btn btn-primary" id="<?php echo $tabela['id'] ?>" >
                                    <span class="glyphicon glyphicon-plus"></span> Nova Cor de Impressão
                            </button>
                        </a>
                            <a class="btn btn-default" href="impressao.php">VOLTAR
                            </a>
                        <p>
                        <table class="table table-bordered">
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
                                    <th>Detalhe</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query("SELECT * FROM impressao_cor ORDER BY id ASC");

                                while ($tabela = mysql_fetch_array($resultado)) {
                                    print '<tr>';
                                    print '<td>' . $tabela['id'] . '</td>';
                                    print '<td>' . $tabela['nome'] . '</td>';
                                    print '<td>' . $tabela['detalhe'] . '</td>';
                                    ?>
                                    <!--Botao de editar-->
                                <td>
                                    <a href ="cor_impressao_formulario.php?id=<?php echo $tabela['id'] ?>" class="btn btn-primary">
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
