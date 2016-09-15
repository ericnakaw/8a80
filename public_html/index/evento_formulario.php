<?php
if (!isset($_SESSION)) {
    session_start(); 
}
$pageName = "Evento Formulário"; //nome da página
include './conexao/Conexao.php';
include './objeto/Evento.php';
include './header.php';
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}

$arr = $_REQUEST;

if (empty($arr["id"])) {
    $nome = "";
    $botao = "Inserir";
    $pageName = "Novo Evento";
    $acao = "evento_inserir.php";
} else {
    $conexao = new Conexao();
    $evento = new Evento($conexao);
    $resultado = $evento->selectEvento($arr["id"]);
    $tabela = mysql_fetch_array($resultado);
    $id = $tabela["id"];
    $nome = $tabela["nome"];
    $botao = "Alterar";
    $pageName = "Alterar Evento";
    $acao = "evento_alterar.php?id=" . $id;
}
?>
<script>
    // Validador do Formulario
    function valida() {
        if ($("#nomeEvento").val() === "") {
            alert('preencha o nome do evento');
            $("#nomeEvento").focus();
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
                        <label for="nomeEvento">Nome Evento:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $nome; ?>" name="nomeEvento" id="nomeEvento" placeholder="Entre com o Evento" >
                    </div>
                    <button type="submit" class="btn btn-success"><?php print $botao; ?>
                    </button>
                    <a class="btn btn-default" href="evento.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>