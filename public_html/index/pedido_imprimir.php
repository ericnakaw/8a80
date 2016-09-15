<?php
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
include './header.php';
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}
?>
<body>

    <!-- Aqui começa o conteudo -->
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <!-- Bloco 1 -->
                <div id="conteudo" class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">.col-md-2
                        </div>
                        <div class="col-md-8" style="border-style: solid;">
                            <div class="row">
                                <div class="col-md-2">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">.col-md-2
                        </div>
                    </div>
                </div>
                <!-- Fim bloco 1 -->
            </div>
        </div>
    </div> 
    <!-- Fim do conteudo -->

</body>
<?php include './footer.php';
?>
