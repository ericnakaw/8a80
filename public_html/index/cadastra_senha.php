<?php
$pageName = "Cadastro de senha"; //nome da página
include './conexao/Conexao.php';
include './header.php';

$arr = $_REQUEST;
?>
<script>

    // Validador do Formulario
    function valida() {
        if ($("#nova_senha").val() === "") {
            alert('Digite uma senha');
            $("#nova_senha").focus();
            return false;
        }
        if ($("#confirma_nova_senha").val() === "") {
            alert('Confirme a senha');
            $("#confirma_nova_senha").focus();
            return false;
        }
        if ($("#nova_senha").val() !== $("#confirma_nova_senha").val()) {
            alert('Senhas não conferem');
            $("#confirma_nova_senha").focus();
            return false;
        }
    }

</script>
<body>
    <div class="container">
        <!--primeira linha da row-->
        <div class="row">
            <div class="col-md-6">
                <h2>Cadastro de Senha</h2>

                <!--inserir ou alterar na acao-->
                <form action="cadastra_senha_alterar.php" method="POST" role="form" onsubmit="return valida()">
                    <input type="hidden" name="usuario" value="<?= $arr["usuario"] ?>">
                    <div class="form-group">
                        <label for="nova_senha">Senha:
                        </label>
                        <input type="password" class="form-control" name="nova_senha" id="nova_senha" placeholder="Nova Senha" >
                    </div>
                    <div class="form-group">
                        <label for="confirma_nova_senha">Confirmar Senha:
                        </label>
                        <input type="password" class="form-control" name="confirma_nova_senha" id="confirma_nova_senha" placeholder="Confirme a senha" >
                    </div>
                    <input type="submit" name="submit" class="btn btn-success" value="Cadastrar">
                    <a class="btn btn-default" href="login.php">VOLTAR
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>
