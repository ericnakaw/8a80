<?php
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Acabamento";
$confDelete = 'servico_deletar.php';
$action = isset($_GET['action']) ? $_GET['action'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}
include './header.php';
include './conexao/Conexao.php';
?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".alert").fadeOut(5000);
    });
</script>
<body>
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <div id="conteudo" class="col-md-12">

                    <h2><?php print $pageName; ?></h2>
                    <!--Confirma se o produto foi deletado com sucesso-->
                    <?php
                    if ($action == 'removed') {
                        ?>
                        <div class='alert alert-info'>
                            <strong><?= $name ?></strong> foi removido do banco de dados com sucesso!
                        </div>
                        <?php
                    }
                    if ($action == 'added') {
                        ?>
                        <div class='alert alert-success'>
                            <strong><?= $name ?></strong> foi adicionado ao banco de dados com sucesso!
                        </div>
                        <?php
                    }
                    ?>
                    <!--Botao de nova categoria-->
                    <form action="servico_formulario.php" method="POST" role="form">
                        <a href="servico_formulario.php">
                            <button class="btn btn-primary" id="<?= $tabela['id'] ?>" >
                                <span class="glyphicon glyphicon-plus"></span> Novo Acabamento
                            </button>
                        </a>
                        <a class="btn btn-default" href="index.php">VOLTAR
                        </a>
                        <p>
                        <table class="table table-bordered table-hover">
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
                                $resultado = $conexao->sql_query("SELECT * FROM servico ORDER BY id ASC");

                                while ($tabela = mysql_fetch_array($resultado)) {
                                    print '<tr>';
                                    print '<td>' . $tabela['id'] . '</td>';
                                    print '<td>' . $tabela['nome'] . '</td>';
                                    print '<td>R$ ' . number_format($tabela['valor'], 2, ",", ".") . '</td>';
                                    ?>
                                    <!--Botao de editar-->
                                <td>
                                    <a href ="servico_formulario.php?id=<?php echo $tabela['id'] ?>" class="btn btn-primary">
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