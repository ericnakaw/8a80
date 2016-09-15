<?php
error_reporting(NULL);
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Login";
include_once './header.php';
include_once './conexao/Conexao.php';
?>  
<script>
    // Validador do Formulario
    function valida() {
        if ($("#usuario").val() === "") {
            alert('Entre com o usuario do Funcionário');
            $("#usuario").focus();
            return false;
        }
        if ($("#senha").val() === "") {
            alert('Entre com a senha do Funcionário');
            $("#senha").focus();
            return false;
        }
    }
</script>
<body>
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="col-lg-4">
                </div>
                <div id="conteudo" class="col-md-4" >
                    <h2 class="text-center">Bem Vindo</h2>
                    <div class=" well center login-box" >
                        <h2 class="text-center"><?= $pageName ?></h2> 
                        <!--Botao de nova categoria-->
                        <form action="logar.php" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" name="usuario" id="usuario" placeholder="Usuario" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" name="senha" id="senha" placeholder="Senha de usuario" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-success" value="Login">
                            </div>
                        </form>
                        <?php
                        if (isset($_GET["err"]) && $_GET["err"] == 0) {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert">X</button>
                                <h4 class="alert-heading glyphicon glyphicon-exclamation-sign"> Erro: Senha ou Usuário</h4>
                                <p>Usuário ou Senha incorretos</p>
                            </div>
                            <?php
                        }
                        if (isset($_GET["msg"]) && $_GET["msg"] == "Sem_permisao") {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert">X</button>
                                <h4 class="alert-heading glyphicon glyphicon-exclamation-sign"> Erro: Permissão</h4>
                                <p>Usuário sem permissão de acesso</p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
<?php
include './footer.php';
?>

