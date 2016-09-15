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
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<style>
    th
    {
        border-bottom: 1px solid #d6d6d6;
    }
    tr:nth-child(even)
    {
        background:#e9e9e9;
    }
</style>
<body>
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <div id="conteudo" class="col-md-12">

                    <h2><?php print $pageName; ?></h2> 
                    <!--Botao de nova categoria-->
                    <!--<div data-role="page" id="pageone">-->
<!--                    <div data-role="header">
                        <h1>Filterable Tables</h1>
                    </div>-->

                    <!--<div data-role="main" class="ui-content">-->
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

                        <input id="filterTable-input" data-type="search" placeholder="Search For Customers...">                        

                        <p>
                        <table class="table table-bordered" data-role="table" data-mode="columntoggle" class="ui-responsive ui-shadow" id="myTable" data-filter="true" data-input="#filterTable-input">
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
                                    <th data-priority="5">ID</th>
                                    <th data-priority="3">Categoria</th>
                                    <th data-priority="1">Papel</th>
                                    <th data-priority="4">Gramatura</th>
                                    <th data-priority="2">Valor</th>
                                    <th data-priority="6"></th>
                                    <th data-priority="7"></th>
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
                                    print '<td id="txtHint">' . $tabela['nome'] . '</td>';
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
                        </table>
                    </form>
                    <?php include './cancelar_acao.php'; ?>
                    <!--                        </div>
                                        </div>-->
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>