<?php
    error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
if (!isset($_SESSION)) {
    session_start();
}
$permissao = Array("gerente", "tecnico", "vendas");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("Location: login.php?msg=Sem_permisao");
    die();
}
include_once './header.php';
?>
<body>
    <!-- Aqui começa o conteudo -->
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <div id="conteudo" class="col-md-12">
                    <h2></h2>
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">Cadastro de Cliente</div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <label for="localVenda">Local de Venda:</label>
                                    <select name="localVenda" class="form-control input-sm">
                                        <option value="">Selecione</option>
                                        <option value="tatuape" <?php
                                        if ($_SESSION['local_venda'] == "tatuape") {
                                            print 'selected';
                                        }
                                        ?>>Loja Tatuapé</option>
                                        <option value="guarulhos" <?php
                                        if ($_SESSION['local_venda'] == "guarulhos") {
                                            print 'selected';
                                        }
                                        ?>>Loja Guarulhos</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!-- Fim do conteudo -->
</body>