<?php
include './conexao/Conexao.php';
$pageName = "Fita";
$confDelete = 'fita_deletar.php';
include './header.php';
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
}

// page is the current page, if there's nothing set, default is page 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// set records or rows of data per page
$recordsPerPage = 5;

// calculate for the query LIMIT clause
$fromRecordNum = ($recordsPerPage * $page) - $recordsPerPage;

$conexao = new Conexao();
$resultado = $conexao->sql_query("SELECT * from fita order by cor asc LIMIT {$fromRecordNum},{$recordsPerPage}");
?>
<body>
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <div id="conteudo" class="col-md-12">

                    <h2><?php print $pageName; ?></h2>
                    <!--this is how to get number of rows returned-->
                    <?php
                    $num = mysql_num_rows($resultado);
                    //check if more than 0 record found
                    if ($num > 0) {
                        ?>
                        <!--Botao de nova categoria-->
                        <form action = "fita_formulario.php" method = "POST" role = "form">
                            <a href = "fita_formulario.php">
                                <button class = "btn btn-primary" id = "<?= $tabela['id'] ?>" >
                                    <span class = "glyphicon glyphicon-plus"></span> Nova Fita
                                </button>
                            </a>
                            <a class = "btn btn-primary" href = "fita_categoria.php">
                                <span class = "glyphicon glyphicon-th-list"></span> Categoria Lista
                            </a>
                            <a class = "btn btn-default" href = "index.php">VOLTAR
                            </a>

                            <p>
                            <table class = "table table-hover table-responsive">
                                <colgroup>
                                    <col width = "5%">
                                    <col width = "15%">
                                    <col width = "20%">
                                    <col width = "10%">
                                    <col width = "20%">
                                    <col width = "10%">
                                    <col width = "10%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>#</th>
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
                                    while ($tabela = mysql_fetch_array($resultado)) {
                                        ?>
                                        <tr>
                                            <td style="vertical-align:middle"> <?= $tabela['id'] ?></td>
                                            <td style="vertical-align:middle"> <img src="<?= $tabela['imagem'] ?>" class="img-rounded img-responsive" height="100" width="130"> </td>
                                            <td style="vertical-align:middle"> <?= $tabela['cor'] ?></td>
                                            <td style="vertical-align:middle"> <?= $tabela['codigo'] ?></td>
                                            <td style="vertical-align:middle"> <?= $tabela['fabricante'] ?> </td>
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
                            <!--end table-->
                            <?php
                            // *************** <PAGING_SECTION> ***************
                            ?>
                            <div id='paging'>

                                <!--***** for 'first' and 'previous' pages-->
                                <?php
                                if ($page > 1) {
                                    // ********** show the first page
                                    ?>
                                    <a href="<?= $_SERVER['PHP_SELF'] ?>" title='Ir para primeira página.' class='btn btn-default'>
                                        <span style='margin:0.5'> << </span>
                                    </a>

                                    <!--********** show the previous page-->
                                    <?php
                                    $prev_page = $page - 1;
                                    ?>
                                    <a href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $prev_page ?>" title="Página anterior é <?= $prev_page ?>" class='btn btn-default'>
                                        <span style='margin:0.5'> < </span>
                                    </a>
                                    <?php
                                }


                                // ********** show the number paging
                                // find out total pages

                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query("SELECT COUNT(*) as total_rows FROM fita");

                                $row = mysql_fetch_array($resultado);
                                $total_rows = $row['total_rows'];

                                $total_pages = ceil($total_rows / $recordsPerPage);

                                // range of num links to show
                                $range = 2;

                                // display links to 'range of pages' around 'current page'
                                $initial_num = $page - $range;
                                $condition_limit_num = ($page + $range) + 1;

                                for ($x = $initial_num; $x < $condition_limit_num; $x++) {

                                    // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
                                    if (($x > 0) && ($x <= $total_pages)) {

                                        // current page
                                        if ($x == $page) {
                                            ?>
                                            <span class='btn btn-primary'><?=$x?></span>
                                            <?php
                                        }

                                        // not current page
                                        else {
                                            ?>
                                            <a href='<?= $_SERVER['PHP_SELF'] ?>?page=<?= $x ?>' class='btn btn-default'><?=$x?></a>
                                            <?php
                                        }
                                    }
                                }

                                // ***** for 'next' and 'last' pages
                                if ($page < $total_pages) {
                                    // ********** show the next page
                                    $next_page = $page + 1;
                                    ?>
                                    <a href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $next_page ?>" title='A próxima página é <?= $next_page ?>.' class='btn btn-default'>
                                        <span style='margin:0.5;'> > </span>
                                    </a>

                                    <!--********** show the last page-->
                                    <a href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $total_pages ?>" title='A última página é <?= $total_pages ?>.' class='btn btn-default'>
                                        <span style='margin:0.5'> >> </span>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>

                            <!--***** allow user to enter page number-->
                            <form action="<?= $_SERVER['PHP_SELF'] ?>" method='GET'>
                                Ir para página:
                                <input type='text' name='page' size='1' />
                                <input type='submit' value='Ir' class='btn btn-primary' />
                            </form>

                            <!--*************** </PAGING_SECTION> ***************-->
                            <?php
                        }

                        // tell the user if no records were found
                        else {
                            ?>
                            <div class='noneFound'>No records found.</div>
                            <?php
                        }
                        ?>
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