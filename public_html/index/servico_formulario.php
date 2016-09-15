<?php
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
$pageName = "Acabamento Formulário"; //nome da página
include './conexao/Conexao.php';
include './objeto/Servico.php';
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
    $pageName = "Novo Acabamento";
    $acao = "servico_inserir.php";
} else {
    $conexao = new Conexao();
    $servico = new Servico($conexao);
    $resultado = $servico->selectServico($arr["id"]);
    $tabela = mysql_fetch_array($resultado);
    $id = $tabela["id"];
    $nome = $tabela["nome"];
    $valor = $tabela["valor"];
    $botao = "Alterar";
    $pageName = "Alterar Acabamento";
    $acao = "servico_alterar.php?id=" . $id;
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
                        <label for="nomeServico">Nome Acabamento:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $nome; ?>" name="nomeServico" id="nomeServico" placeholder="Entre com o acabamento" >
                    </div>
                    <div class="form-group">
                        <label for="valorServico">Valor:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $valor; ?>" name="valorServico" id="valorServico" placeholder="Entre com o valor" >
                    </div>

                    <button type="submit" class="btn btn-default"><?php print $botao; ?>
                    </button>
                    <a class="btn btn-default" href="servico.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>