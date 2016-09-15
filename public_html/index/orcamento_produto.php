<?php
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Produto";
$permissao = Array("gerente", "tecnico", "vendas");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}
// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : "1";
$name = isset($_GET['name']) ? $_GET['name'] : "";

include './header.php';
include './conexao/Conexao.php';
?>
<script type="text/javascript" src="js/tabela_buscar.js"></script>
<body>
    <?php include './header2.php'; ?>
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <div id="conteudo" class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-search"></span> Pesquisar</span>
                                <input type="text" class="form-control" id="input-search" alt="lista-clientes" placeholder="Buscar nesta lista...os acentos são considerados...." />
                            </div>
                        </div> 
                    </div>
                    <?php
                    if ($action == 'added') {
                        ?>
                        <div class='alert alert-success'>
                            <strong><?= $name ?></strong> foi adicionado ao carrinho!
                        </div>
                        <?php
                    }
                    if ($action == 'exists') {
                        ?>
                        <div class='alert alert-warning'>
                            <strong><?= $name ?></strong> já existe no carrinho!
                        </div>
                        <?php
                    }
                    ?>

                    <p>
                        <?php
                        $conexao = new Conexao();
                        $query = "SELECT p.id, p.nome, p.valor, p.descricao, p.produto_categoria_id, pc.nome as categoria_nome FROM `produto` as p left join `produto_categoria` as pc on p.produto_categoria_id = pc.id order by categoria_nome,nome,descricao asc";
                        $query2 = "SELECT * FROM produto_categoria";
                        $resultado = $conexao->sql_query($query);
                        $resultado2 = $conexao->sql_query($query2);
                        if (mysql_num_rows($resultado) > 0) {
                            ?>
                        <div class="table-responsive">
                            <table class='lista-clientes table table-hover table-striped table-bordered table-condensed' id="tabela">
                                <colgroup>
                                    <col style="width:20%"> <!--categoria-->
                                    <col style="width:10%"> <!--produto-->
                                    <col style="width:35%"> <!--descricao-->
                                    <col style="width:10%"> <!--valor-->
                                    <!--<col style="width:10%"> valor-->
                                    <col style="width:15%"> <!--quantidade-->
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Categoria</th>
                                        <th>Produto</th>
                                        <th>Descrição</th>
                                        <th>Valor R$</th>
                                        <!--<th>Feira R$</th>-->
                                        <th>Quantidade</th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <!--Em teste....-->
<!--                                            <select class="form-control" onchange="alteraInputCategoria()" id="selectCategoria">
                                                <option value=""></option>
                                                <?php
                                                while ($rowCategoria = mysql_fetch_array($resultado2)) {
                                                ?>
                                                <option value="<?=$rowCategoria['nome'] ?>"><?=$rowCategoria['nome'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>-->
                                            <input type="text" class="form-control" id="input-search-categoria1" placeholder="Buscar Categoria" />
                                        </th>
                                        <th><input type="text" class="form-control" id="input-search-categoria2" placeholder="Buscar Produto" /></th>
                                        <th><input type="text" class="form-control" id="input-search-categoria3" placeholder="Buscar por descrição" /></th>
                                        <th></th>
                                        <!--<th></th>-->
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($tabela = mysql_fetch_array($resultado)) {
                                        ?>
                                        <tr>
                                            <td><?= $tabela['categoria_nome'] ?></td>
                                            <td><?= $tabela['nome'] ?></td>
                                            <td class="text-left text-uppercase"><?= $tabela['descricao'] ?></td> 
                                            <td>R$ <?= number_format($tabela['valor'], 2, ',', '.') ?></td> <!--valor sem desconto-->
                                            <!--<td>R$ <?= number_format($tabela['valor'] * (0.9), 2, ',', '.') ?></td>valor com 10% desconto-->
                                            <td>
                                                <form class="add-to-cart-form" method="POST" action="orcamento_produto_adicionar_carrinho.php">
                                                    <div class="input-group">
                                                        <input type="hidden" name="id" value="<?= $tabela['id'] ?>" class="form-control">
                                                        <input type="hidden" name="name" value="<?= $tabela['nome'] ?>" class="form-control">
                                                        <input type="number" name="quantity" value="1" min="1" class="form-control" placeholder="Type quantity here...">
                                                        <span class="input-group-btn">
                                                            <button type="submit" class="btn btn-primary add-to-cart" >
                                                                <span class="glyphicon glyphicon-shopping-cart"></span>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                <div class='alert alert-info'>
                                    <strong>$name</strong> Nenhum produto foi encontrado
                                </div>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php include './cancelar_acao.php'; ?>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>