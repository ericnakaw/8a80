<?php
$pageName = "Mão de Obra Formulário"; //nome da página
include './conexao/Conexao.php';
include './objeto/MaoDeObra.php';
include './header.php';
$permissao = Array("gerente", "tecnico", "vendas");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}

$arr = $_REQUEST;

if (empty($arr["id"])) {
    $nome = "";
    $valor = "";
    $botao = "Inserir";
    $pageName = "Nova Mão de Obra";
    $acao = "mao_de_obra_inserir.php";
} else {
    $conexao = new Conexao();
    $maoDeObra = new MaoDeObra($conexao);
    $resultado = $maoDeObra->selectMaoDeObra($arr["id"]);
    $tabela = mysql_fetch_array($resultado);
    $id = $tabela["id"];
    $nome = $tabela["nome"];
    $valor = $tabela["valor"];
    $botao = "Alterar";
    $pageName = "Alterar Mão de Obra";
    $acao = "mao_de_obra_alterar.php?id=" . $id;
}
?>
<script>
    // Validador do Formulario
    function valida() {
        if ($("#nomeMaoDeObra").val() === "") {
            alert('preencha o nome da mão de obra');
            $("#nomeMaoDeObra").focus();
            return false;
        }
        if ($("#valorMaoDeObra").val() === "") {
            alert('preencha o valor da mão de obra');
            $("#valorMaoDeObra").focus();
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
                <form action="<?php echo $acao ?>" method="POST" role="form" onsubmit="return valida()">

                    <div class="form-group">
                        <label for="nomeMaoDeObra">Nome Mao de Obra:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $nome; ?>" name="nomeMaoDeObra" id="nomeMaoDeObra" placeholder="Entre com a Mão de Obra" >
                    </div>
                    <div class="form-group">
                        <label for="valorMaoDeObra">Valor:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $valor; ?>" name="valorMaoDeObra" id="valorMaoDeObra" placeholder="Entre com o valor" >
                    </div>

                    <button type="submit" class="btn btn-success"><?php print $botao; ?>
                    </button>
                    <a class="btn btn-default" href="mao_de_obra.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>