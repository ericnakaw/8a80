<!DOCTYPE HTML>
<html>
    <head>
        <title>PHP Paging Tutorial Demo</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>

        <?php
// include database connection
        include './conexao/Conexao.php';

// page is the current page, if there's nothing set, default is page 1
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

// set records or rows of data per page
        $recordsPerPage = 10;

// calculate for the query LIMIT clause
        $fromRecordNum = ($recordsPerPage * $page) - $recordsPerPage;

// select all data
        /*
          page and its LIMIT clause looks like:
          1 = 0, 5
          2 = 5,10
          3 = 10,15
          4 = 15, 20
          5 = 20, 25
         */
        $conexao = new Conexao();
        $resultado = $conexao->sql_query("SELECT * from fita order by cor asc LIMIT {$fromRecordNum},{$recordsPerPage}");
//this is how to get number of rows returned
        $num = mysql_num_rows ($resultado );
//check if more than 0 record found
        if ($num > 0) {
            ?>
            <!--start table-->
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
            echo "<div id='paging'>";

            // ***** for 'first' and 'previous' pages
            if ($page > 1) {
                // ********** show the first page
                echo "<a href='" . $_SERVER['PHP_SELF'] . "' title='Go to the first page.' class='customBtn'>";
                echo "<span style='margin:0 .5em;'> << </span>";
                echo "</a>";

                // ********** show the previous page
                $prev_page = $page - 1;
                echo "<a href='" . $_SERVER['PHP_SELF']
                . "?page={$prev_page}' title='Previous page is {$prev_page}.' class='customBtn'>";
                echo "<span style='margin:0 .5em;'> < </span>";
                echo "</a>";
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
                        echo "<span class='customBtn' style='background:red;'>$x</span>";
                    }

                    // not current page
                    else {
                        echo " <a href='{$_SERVER['PHP_SELF']}?page=$x' class='customBtn'>$x</a> ";
                    }
                }
            }


            // ***** for 'next' and 'last' pages
            if ($page < $total_pages) {
                // ********** show the next page
                $next_page = $page + 1;
                echo "<a href='" . $_SERVER['PHP_SELF'] . "?page={$next_page}' title='Next page is {$next_page}.' class='customBtn'>";
                echo "<span style='margin:0 .5em;'> > </span>";
                echo "</a>";

                // ********** show the last page
                echo "<a href='" . $_SERVER['PHP_SELF'] . "?page={$total_pages}' title='Last page is {$total_pages}.' class='customBtn'>";
                echo "<span style='margin:0 .5em;'> >> </span>";
                echo "</a>";
            }

            echo "</div>";

            // ***** allow user to enter page number
            echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='GET'>";
            echo "Go to page: ";
            echo "<input type='text' name='page' size='1' />";
            echo "<input type='submit' value='Go' class='customBtn' />";
            echo "</form>";

            // *************** </PAGING_SECTION> ***************
        }

        // tell the user if no records were found
        else {
            echo "<div class='noneFound'>No records found.</div>";
        }
        ?>

    </body>
</html>