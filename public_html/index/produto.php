<?php
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Produto";
$confDelete = 'produto_deletar.php';
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}
include './header.php';
include './conexao/Conexao.php';
?>
<script type="text/javascript" src="js/tabela_buscar.js"></script>
<body>
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <div id="conteudo" class="col-md-12">
                    <h2><?php print $pageName; ?></h2>
                    <!--Botao de novo produto-->
                    <form action="produto_formulario.php" method="POST" role="form">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="produto_formulario.php">
                                    <button class="btn btn-primary" id="<?php echo $tabela['id'] ?>" >
                                        <span class="glyphicon glyphicon-plus"></span> Novo Produto
                                    </button>
                                </a>
                                <a href="produto_categoria.php" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-th-list"></span> Categoria Lista
                                </a>
                                <a class="btn btn-default" href="index.php">VOLTAR
                                </a>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-search"></span> Pesquisar</span>
                                    <input type="text" class="form-control" id="input-search" alt="lista-clientes" placeholder="Buscar nesta lista...os acentos são considerados...." />
                                </div>
                            </div>  
                        </div>
                        <p>
                        <table class="lista-clientes table table-hover table-bordered table table-striped table-condensed" id="tabela">
                            <thead>
                                <tr>
                                    <th width="15%">Categoria</th>
                                    <th width="15%">Produto</th>
                                    <th width="40%">Descrição</th>
                                    <th width="10%">Valor R$</th>
                                    <th width="10%">Feira</th>
                                    <th width="5%"></th>
                                    <th width="5%"></th>
                                </tr>
                                <tr>
                                    <th><input type="text" class="form-control" id="input-search-categoria1" placeholder="Buscar Categoria" /></th>
                                    <th><input type="text" class="form-control" id="input-search-categoria2" placeholder="Buscar Produto" /></th>
                                    <th><input type="text" class="form-control" id="input-search-categoria3" placeholder="Buscar por descrição" /></th>
                                    <th>Valor R$</th>
                                    <th>Feira</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conexao = new Conexao();
                                $query = "SELECT p.id, p.nome, p.valor, p.descricao, p.produto_categoria_id, pc.nome as categoria_nome FROM `produto` as p left join `produto_categoria` as pc on p.produto_categoria_id = pc.id order by categoria_nome,nome,descricao asc";
                                $resultado = $conexao->sql_query($query);

                                while ($tabela = mysql_fetch_array($resultado)) {
                                    ?>
                                    <tr>
                                        <td><?= $tabela['categoria_nome'] ?></td>
                                        <td><?= $tabela['nome'] ?></td>
                                        <td class="text-left text-uppercase"><?= $tabela['descricao'] ?></td>
                                        <td>R$ <?= number_format($tabela['valor'], 2, ',', '.') ?></td><!--valor sem desconto-->
                                        <td>R$ <?= number_format($tabela['valor'] * (0.9), 2, ',', '.') ?></td><!--valor com 10% desconto-->
                                        <td>
                                            <a href ="produto_formulario.php?id=<?php echo $tabela['id'] ?>" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                        </td>
                                        <!--Botao de deletar-->
                                        <td>
                                            <a data-toggle="modal" data-target="#myModal" data-whatever="@mdo" onclick="confDeletar(<?= $tabela['id'] ?>, '<?= $tabela['nome'] ?>')" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash"></span>
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