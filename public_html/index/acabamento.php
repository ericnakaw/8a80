<?php
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Acessórios";
$confDelete = 'acabamento_deletar.php';
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
                    <form action="acabamento_formulario.php" method="POST" role="form">
                        <a href="acabamento_formulario.php">
                            <button class="btn btn-primary" id="<?php echo $tabela['id'] ?>"><span class="glyphicon glyphicon-plus"></span> Novo <?=$pageName?>
                            </button>
                        </a>
                        <a class="btn btn-default" href="index.php">VOLTAR
                        </a>
                        <p>
                        <table class="table table-bordered table-hover">
                            <colgroup>
                                <!--<col width="10%">-->
                                <col width="40%">
                                <col width="30%">
                                <col width="10%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <!--<th>#</th>-->
                                    <th>Acessório</th>
                                    <th>Valor</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query("SELECT * FROM acabamento ORDER BY nome ASC");

                                while ($tabela = mysql_fetch_array($resultado)) {
                                    print '<tr>';
//                                    print '<td>' . $tabela['id'] . '</td>';
                                    print '<td>' . $tabela['nome'] . '</td>';
                                    print '<td>R$ ' . number_format($tabela['valor'], 2, ",", ".") . '</td>';
                                    ?>
                                    <!--Botao de editar-->
                                <td>
                                    <a href ="acabamento_formulario.php?id=<?php echo $tabela['id'] ?>" class="btn btn-primary">
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
                    <!-- Modal -->
                    <?php include './cancelar_acao.php'; ?>
                    <!--Fim do Modal-->

                </div>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>
