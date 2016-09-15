<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Carrinho";
$permissao = Array("gerente", "tecnico", "vendas");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}
$action = isset($_GET['action']) ? $_GET['action'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : "";
include './header.php';
include './conexao/Conexao.php';
?>
<body>
    <?php include './header2.php';?>
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <form action="orcamento_carrinho_complemento_salvar.php" method="POST">
                    <?php
                    include './orcamento_carrinho_complemento.php';

                    //verifica a quantidade de convites na sessão
                    foreach ($_SESSION as $key => $value) {
                        if (strpos($key, 'convite-') === 0) {
                            $convite_count = $convite_count + 1;
                        }
                    }
                    if ($convite_count > 0 || count($_SESSION['cart_items']) > 0) {
                        if ($convite_count > 0) {
                            include './orcamento_carrinho_convite_resumo.php';
                        }
                        if (count($_SESSION['cart_items']) > 0) {
                            include './orcamento_carrinho_produto_resumo.php';
                            include './cancelar_acao.php';
                        }
                    } else {
                        include './orcamento_carrinho_vazio.php';
                    }
                    ?>
                </form>
            </div>
            <?php
            $action = isset($_GET['action']) ? $_GET['action'] : "";
            if ($action == 'all_removed_sucess') {
                ?>
                <div class='alert alert-success fade in'>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Todos os Produtos </strong> foram excluidos com sucesso!  
                </div>
                <?php
            }
            if ($action == 'todos_convites_removed_sucess') {
                ?>
                <div class='alert alert-success fade in'>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Todos os Convites </strong> foram excluidos com sucesso!  
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>
<script type="text/javascript" src="js/orcamento_carrinho.js"></script>
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script> 