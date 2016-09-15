<?php
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Impressão";
$confDelete = 'impressao_deletar.php';
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
                    <form action="impressao_formulario.php" method="POST" role="form">
                        <a href="impressao_formulario.php.php">
                            <button class="btn btn-primary" id="<?php echo $tabela['id'] ?>" >
                                <span class="glyphicon glyphicon-plus"></span> Nova Impressão
                            </button>
                        </a>
                        <a class="btn btn-info" href="cor_impressao.php">Impressão Cores
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
                                    <th>Nome</th>
                                    <th>Valor R$</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query("SELECT * FROM impressao ORDER BY nome ASC");

                                while ($tabela = mysql_fetch_array($resultado)) {
                                    ?>
                                    <tr>
                                        <td class="text-uppercase"><?= $tabela['nome']?></td>
                                        <td>R$ <?=number_format($tabela['valor'], 2, ",", ".")?></td>
                                        <td>
                                            <a href ="impressao_formulario.php?id=<?php echo $tabela['id'] ?>" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-pencil"></span> Editar
                                            </a>
                                        </td>
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