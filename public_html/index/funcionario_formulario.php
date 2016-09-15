<?php
error_reporting(null);
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Funcionário Formulário"; //nome da página
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}

include './conexao/Conexao.php';
include './objeto/Funcionario.php';
include './header.php';
$arr = $_REQUEST;

if (empty($arr["id"])) {
    $nome = "";
    $sobrenome = "";
    $cargo = "";
    $botao = "Inserir";
    $pageName = "Novo Funcionário";
    $acao = "funcionario_inserir.php";
} else {
    $conexao = new Conexao();
    $funcionario = new Funcionario($conexao);
    $resultado = $funcionario->selectFuncionario($arr["id"]);
    $tabela = mysql_fetch_array($resultado);
    $id = $tabela["id"];
    $nome = $tabela["nome"];
    $sobrenome = $tabela["sobrenome"];
    $cargo = $tabela["cargo"];
    $usuario = $tabela["usuario"];
    $botao = "Alterar";
    $pageName = "Alterar Funcionário";
    $acao = "funcionario_alterar.php?id=" . $id;
    $ativo = $tabela["ativo"];
    $nivel = $tabela["nivel"];
}
?>
<script>
    // Validador do Formulario
    function valida() {
        if ($("#nomeFuncionario").val() === "") {
            alert('preencha o nome do funcionario');
            $("#nomeFuncionario").focus();
            return false;
        }
        if ($("#sobrenomeFuncionario").val() === "") {
            alert('preencha o sobrenome do funcionario');
            $("#sobrenomeFuncionario").focus();
            return false;
        }
        if ($("#cargoFuncionario").val() === "") {
            alert('Preencha o cargo do funcionario');
            $("#cargoFuncionario").focus();
            return false;
        }
        if ($("#usuario").val() === "") {
            alert('Preencha o cargo do funcionario');
            $("#usuario").focus();
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
                <form action="<?php echo $acao ?>" method="POST" role="form">

                    <div class="form-group">
                        <label for="nomeFuncionario">Nome:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $nome; ?>" name="nomeFuncionario" id="nomeFuncionario" placeholder="Entre com o Nome do Funcionário">
                    </div>
                    <div class="form-group">
                        <label for="sobrenomeFuncionario">Sobrenome:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $sobrenome; ?>" name="sobrenomeFuncionario" id="sobrenomeFuncionario" placeholder="Entre com o Sobrenome" >
                    </div>
                    <div class="form-group">
                        <label for="cargoFuncionario">Cargo:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $cargo; ?>" name="cargoFuncionario" id="cargoFuncionario" placeholder="Entre com o Cargo" >
                    </div>
                    <div class="form-group">
                        <label for="usuario">Usuario:
                        </label>
                        <input type="text" class="form-control" value= "<?php print $usuario; ?>" name="usuario" id="usuario" placeholder="Entre com o Usuario" >
                    </div>
                    <div class="form-group">
                        <label for="nivelFuncionario">Nivel:
                        </label>
                        <select name="nivelFuncionario" class="form-control" >
                            <option></option>
                            <option value="vendas"
                            <?php
                            if ($nivel === "vendas") {
                                print "selected";
                            }
                            ?>
                                    >Vendas</option>
                            <option value="tecnico"
                            <?php
                            if ($nivel === "tecnico") {
                                print "selected";
                            }
                            ?>
                                    >Tecnico</option>
                            <option value="gerente"
                            <?php
                            if ($nivel === "gerente") {
                                print "selected";
                            }
                            ?>
                                    >Gerente</option>
                            <option value="producao"
                            <?php
                            if ($nivel === "producao") {
                                print "selected";
                            }
                            ?>
                                    >Produção</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ativoFuncionario">Ativo:
                        </label>
                        <select name="ativoFuncionario" class="form-control">
                            <?php
                            if (empty($arr["id"])) {
                                print '<option value="0">Inativo</option>';
                            } else {
                                ?>
                                <option value="0">Inativo</option>
                                <option value="1" <?php
                                if ($ativo == 1) {
                                    print 'selected';
                                }
                                ?> >Ativo</option>
                                        <?php
                                    }
                                    ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success"><?php print $botao; ?>
                    </button>
                    <a class="btn btn-default" href="funcionario.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>