<?php
//error_reporting(null);
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Catalogo Formulário"; //nome da página
$permissao = Array("gerente", "tecnico");

if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}

include './conexao/ConnectionFactory.php';
include './header.php'; 
include './dao/CatalogoDao.php';

$arr = $_REQUEST; 
if (empty($arr["id"])) {
    $id_catalogo = "";
    $pagina = "";
    $item = "";
    $botao = "Inserir";
    $pageName = "Nova Página";
    $acao = "catalogo_inserir.php";
} else {
    $connectionFactory = new ConnectionFactory();
    $mysqli = $connectionFactory->get_Mysqli();
    $catalogoDao = new CatalogoDao();
    $result = $catalogoDao->select($arr["id"], $mysqli);
    $tabela = $result->fetch_assoc();
    
    $id_catalogo = $tabela["id_catalogo"];
    $pagina = $tabela["pagina"];
    $id_convite = $tabela["id_convite"];
    $item = $tabela["item"];
    $botao = "Alterar";
    $pageName = "Alterar Catalogo";
    $acao = "catalogo_alterar.php?id=" . $id;
}
?>
<script>
    // Validador do Formulario
    function valida() {
        if ($("#pagina").val() === "") {
            alert('preencha o número da página');
            $("#pagina").focus();
            return false;
        }
        if ($("#idConvite").val() === "") {
            alert('preencha o número do convite');
            $("#idConvite").focus();
            return false;
        }
    }
</script>
<body>
    <div class="container">
        <!--primeira linha da row-->
        <div class="row">
            <div class="col-md-6">
                <h2><?php print $pageName; ?></h2>

                <!--inserir ou alterar na acao-->
                <form action="<?= $acao ?>" method="POST" role="form" onsubmit="return valida()">

                    <div class="form-group">
                        <label for="pagina">Número da página:
                        </label>
                        <input type="text" class="form-control" value= "<?= $pagina ?>" name="pagina" id="pagina" placeholder="Entre com o número da página" >
                    </div>
                    <div class="form-group">
                        <label for="idConvite">Id Convite:
                        </label>
                        <input type="number" class="form-control" value= "<?= $id_convite ?>" name="idConvite" id="idConvite" placeholder="Entre com id do convite" >
                    </div>
                    <div class="form-group">
                        <label for="item">Item:
                        </label>
                        <input type="text" class="form-control" value= "<?= $item?>" name="item" id="item" placeholder="Entre com o Item Ex: A,B ou C..." >
                    </div>

                    <button type="submit" class="btn btn-success"><?= $botao ?>
                    </button>
                    <a class="btn btn-default" href="catalogo.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>