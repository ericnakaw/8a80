<?php
$pageName = "Papel";
$confDelete = 'papel_deletar.php';
include './header.php';
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
}
include './conexao/Conexao.php';
?>
<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#example tfoot th').each(function() {
            var title = $('#example thead th').eq($(this).index()).text();
            $(this).html('<input type="text" placeholder="Pesquisar ' + title + '" />');
        });

        // DataTable
        var table = $('#example').DataTable();

        // Apply the search
        table.columns().every(function() {
            var that = this;

            $('input', this.footer()).on('keyup change', function() {
                alert("teste");
                that.search(this.value).draw();
            });
        });
    });
</script>

<body>
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <div id="conteudo" class="col-md-12">

                    <h2><?php print $pageName; ?></h2> 
                    <!--Botao de nova categoria-->
                    <form action="papel_formulario.php" method="POST" role="form">
                        <a href="papel_formulario.php">
                            <button class="btn btn-primary" id="<?= $tabela['id'] ?>" >
                                <span class="glyphicon glyphicon-plus"></span> Novo Papel
                            </button>
                        </a>
                        <a href="papel_categoria.php" class="btn btn-primary">
                            <span class="glyphicon glyphicon-th-list"></span> Categoria Lista
                        </a>
                        <a class="btn btn-default" href="index.php">VOLTAR
                        </a>

                        <p>
                        <table class="table table-bordered display" id="example">
                            <colgroup>
                                <col width="10%">
                                <col width="20%">
                                <col width="30%">
                                <col width="20%">
                                <col width="10%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Categoria</th>
                                    <th>Papel</th>
                                    <th>Gramatura</th>
                                    <th>Valor</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query("SELECT `papel`.`id`, `papel`.`nome`, `papel`.`gramatura`, `categoria_papel`.`nome` as categoria_nome, `categoria_papel`.`valor` FROM `papel` LEFT JOIN `u758661542_tcc`.`categoria_papel` ON `papel`.`categoria_papel_id` = `categoria_papel`.`id` ORDER BY nome asc ");

                                while ($tabela = mysql_fetch_array($resultado)) {
                                    print '<tr>';
                                    print '<td>' . $tabela['id'] . '</td>';
                                    print '<td>' . $tabela['categoria_nome'] . '</td>';
                                    print '<td>' . $tabela['nome'] . '</td>';
                                    print '<td>' . $tabela['gramatura'] . '</td>';
                                    print '<td>R$ ' . number_format($tabela['valor'], 2, ",", ".") . '</td>';
                                    ?>
                                    <!--Botao de editar-->
                                <td>
                                    <a href ="papel_formulario.php?id=<?php echo $tabela['id'] ?>" class="btn btn-primary">
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
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1"><input type="text" placeholder="Search Name"></th>
                                    <th rowspan="1" colspan="1"><input type="text" placeholder="Search Position"></th>
                                    <th rowspan="1" colspan="1"><input type="text" placeholder="Search Office"></th>
                                    <th rowspan="1" colspan="1"><input type="text" placeholder="Search Age"></th>
                                    <th rowspan="1" colspan="1"><input type="text" placeholder="Search Start date">
                                    </th>
                                </tr>
                            </tfoot>
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