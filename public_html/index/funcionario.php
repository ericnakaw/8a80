<?php
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Funcionário";
$confDelete = 'funcionario_deletar.php';
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
                    <form action="funcionario_formulario.php" method="POST" role="form">
                        <a href="funcionario_formulario.php">
                            <button class="btn btn-primary" id="<?php echo $tabela['id'] ?>" >
                                <span class="glyphicon glyphicon-plus"></span> Novo Funcionário
                            </button>
                        </a>
                        <a class="btn btn-default" href="index.php">VOLTAR
                        </a>
                        <p>
                        <table class="table table-bordered table-hover">
                            <colgroup>
                                <col width="10%">
                                <col width="10%">
                                <col width="20%">
                                <col width="10%">
                                <col width="30%">
                                <col width="10%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Nome</th>
                                    <th class="text-center">Sobrenome</th>
                                    <th class="text-center">Cargo</th>
                                    <th class="text-center">Ativo</th>
                                    <th class="text-center">Nivel</th>
                                    <th class="text-center">Usuario</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query("SELECT * FROM funcionario ORDER BY nome ASC");

                                while ($tabela = mysql_fetch_array($resultado)) {
                                    ?>
                                    <tr>
                                        <td><?= $tabela['id'] ?></td>
                                        <td class="text-uppercase"><?= $tabela['nome'] ?></td>
                                        <td class="text-uppercase"><?= $tabela['sobrenome'] ?></td>
                                        <td class="text-uppercase"><?= $tabela['cargo'] ?></td>
                                        <?php
                                        if ($tabela['ativo'] == 1) {
                                            ?>
                                            <td class="success text-uppercase text-center">
                                                <span class="text-success"><span class="glyphicon glyphicon-ok-circle"></span> ativo</span>
                                            </td>
                                            <?php
                                        } else {
                                            ?>
                                            <td class="danger text-uppercase text-center">
                                                <span class="text-danger"><span class="glyphicon glyphicon-ban-circle"></span> inativo</span> 
                                            </td>
                                            <?php
                                        } $tabela['ativo']
                                        ?>
                                        <td class="text-uppercase"><?= $tabela['nivel'] ?></td>
                                        <td class="text-uppercase"><?= $tabela['usuario'] ?></td>
                                        <!--Botao de editar-->
                                        <td>
                                            <a href ="funcionario_formulario.php?id=<?= $tabela['id'] ?>" class="btn btn-primary">
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

