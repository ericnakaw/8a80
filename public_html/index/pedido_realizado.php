<html>
    <head>
        <meta charset="UTF-8">
        <title>Solicitação realizada com Sucesso</title>
        <script>
            function imprimir() {
                window.print();
            }
        </script>
        <style>
            table {
                font-size: 75%;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
        <div class="wrapper" role="main">
            <div class="container">
                <div class="row">
                    <div id="conteudo" class="col-md-04">
                        <?php
                        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
                        include './header.php';
                        include './conexao/ConnectionFactory.php';
                        include './dao/ConviteDao.php';
                        include './dao/PedidoDao.php';
                        include './dao/FuncionarioDao.php';
                        include './dao/ClienteDao.php';
                        include './dao/PessoaDao.php';
                        include './dao/ItensConviteDao.php';
                        include './objeto/Convite.php';
                        include './objeto/Pedido.php';
                        include './objeto/Funcionario.php';
                        include './objeto/Cliente.php';
                        include './objeto/Pessoa.php';
                        include './objeto/ItensConvite.php';

                        include './orcamento_formulario_formatado_tabela.php';
                        //include './orcamento_formulario_formatado.php';
                        die();
                        ?>    
                        <?php
                        if (!empty($_GET['erro'])) {
                            $mensagemErro = $_GET['erro'];
                            ?>
                            <p class="alert alert-danger">Convite de numero<?= $mensagemErro ?> não foi inserido <br>
                                <?php
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
