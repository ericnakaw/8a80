<?php
$pageName = "Impressão Formulário"; //nome da página
include './conexao/Conexao.php';
include './objeto/Impressao.php';
include './header.php';
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}

$arr = $_REQUEST;

if (empty($arr["id"])) {
    $nome = "";
    $valor = "";
    $botao = "Inserir";
    $pageName = "Nova Impressão";
    $acao = "impressao_inserir.php";
} else {
    $conexao = new Conexao();
    $impressao = new Impressao($conexao);
    $resultado = $impressao->selectImpressao($arr["id"]);
    $tabela = mysql_fetch_array($resultado);
    $id = $tabela["id"];
    $nome = $tabela["nome"];
    $valor = $tabela["valor"];
    $botao = "Alterar";
    $pageName = "Alterar Impressão";
    $acao = "impressao_alterar.php?id=" . $id;
}
?>

<body>
    <div class="container">
        <!--primeira linha da row-->
        <div class="row">
            <div class="col-md-6">
                <h2><?php print $pageName; ?></h2>

                <!--inserir ou alterar na acao-->
                <form action="<?php echo $acao ?>" method="POST" role="form">

                    <div class="form-group">
                        <label for="nomeImpressao">Nome Impressão:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $nome; ?>" name="nomeImpressao" id="nomeImpressao" placeholder="Entre com a Impressão" >
                    </div>
                    <div class="form-group">
                        <label for="valorImpressao">Valor:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $valor; ?>" name="valorImpressao" id="valorImpressao" placeholder="Entre com o valor" >
                    </div>

                    <button type="submit" class="btn btn-success"><?php print $botao; ?>
                    </button>
                    <a class="btn btn-default" href="impressao.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>