<?php
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Catalogo";
$confDelete = 'catalogo_deletar.php';
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
                    <form action="catalogo_formulario.php" method="POST" role="form">
                        <a href="catalogo_formulario.php">
                            <button class="btn btn-primary" id="<?php echo $tabela['id'] ?>"><span class="glyphicon glyphicon-plus"></span> Nova Página
                            </button>
                        </a>
                        <a class="btn btn-default" href="index.php">VOLTAR
                        </a>
                        <p>
                        <table class="table table-bordered table-hover">
                            <colgroup>
                                <col width="10%">
                                <col width="10%">
                                <col width="10%">
                                <col width="10%">
                                <col width="10%">
                                <col width="10%">
                                <col width="10%">
                                <col width="10%">
                                <col width="10%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th># Página</th>
                                    <th># Convite</th>
                                    <th>Item</th>
                                    <th># Cod</th>
                                    <th>Modelo</th>
                                    <th>Altura</th>
                                    <th>Largura</th>
                                    <th>Obs</th> 
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conexao = new Conexao();
                                //$resultado = $conexao->sql_query("SELECT * FROM catalogo ORDER BY pagina ASC");
                                $resultado = $conexao->sql_query("select id_catalogo, pagina, id_convite, item, cm.nome as modelo, cm.cod, cm.altura, cm.largura, cm.observacao
                                                                    from catalogo as ct
                                                                    join convite as c
                                                                    on ct.id_convite = c.id
                                                                    join convite_modelo as cm
                                                                    on c.id_modelo = cm.id ORDER BY pagina asc");

                                while ($tabela = mysql_fetch_array($resultado)) {
                                    print '<tr>';
                                    print '<td>' . $tabela['pagina'] . '</td>';
                                    print '<td>' . $tabela['id_convite'] . '</td>';
                                    print '<td>' . $tabela['item'] . '</td>';
                                    print '<td>' . $tabela['cod'] . '</td>';
                                    print '<td>' . $tabela['modelo'] . '</td>';
                                    print '<td>' . $tabela['altura'] . '</td>';
                                    print '<td>' . $tabela['largura'] . '</td>';
                                    print '<td>' . $tabela['observacao'] . '</td>';
                                    ?>
                                    <!--Botao de editar-->
                                <td>
                                    <a href ="catalogo_formulario.php?id=<?php echo $tabela['id_catalogo'] ?>" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-pencil"></span> Editar
                                    </a>
                                </td>
                                <!--Botao de deletar-->
                                <td>
                                    <a data-toggle="modal" data-target="#myModal" data-whatever="@mdo" onclick="confDeletar(<?= $tabela['id_catalogo'] ?>, '<?= $tabela['id_catalogo'] ?>')" class="btn btn-danger">
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
