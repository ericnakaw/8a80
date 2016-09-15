<?php
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
if (!isset($_SESSION)) {
    session_start();
}
$pageName = "Pedido";
$confDelete = 'pedido_deletar.php';
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}
include './header.php';
include './conexao/Conexao.php';
?>
<script type="text/javascript" src="js/orcamento_novo.js"></script>
<style>
    #conteudo div{
        padding: 0;
        padding-left: 0;
        padding-right: 0;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $(".alert-success").fadeOut(5000);
        $(".alert-warning").fadeOut(5000);
        $("legend").css("text-align", "center");

        $("#tabela_produto select").change(function () {
            var index = $(this).parent().index();
            var nth = "#tabela_produto td:nth-child(" + (index + 1).toString() + ")";
            var valor = $(this).val().toUpperCase();
            $("#tabela_produto tbody tr").show();
            $(nth).each(function () {
                if ($(this).text().toUpperCase().indexOf(valor) < 0) {
                    $(this).parent().hide();
                }
            });
        });
        $("#buscaProduto").keyup(function () {
            var index = $(this).parent().index();
            var nth = "#tabela_produto td:nth-child(" + (index + 1).toString() + ")";
            var valor = $(this).val().toUpperCase();
            $("#tabela_produto tbody tr").show();
            $(nth).each(function () {
                if ($(this).text().toUpperCase().indexOf(valor) < 0) {
                    $(this).parent().hide();
                }
            });
        });

        $("#tabela_produto select").blur(function () {
            $(this).val("");
        });


    });
    function modelo(modelo, unica) {
        $("#legend_modelo").text("Modelo " + modelo);
        if (unica) {
            $('#legend_cartao').text("Conteudo");
            $('#cartao_papel').parent().css('display', 'none');
            $('#cartao_papel').val("");
            $('#cartao_fita').parent().css('display', 'none');
            $('#cartao_fita').val("");
        } else {
            $('#legend_cartao').text("Cartão");
            $('#cartao_papel').parent().css('display', 'block');
            $('#cartao_fita').parent().css('display', 'block');
        }
    }
</script>
<body>
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <div id="conteudo" class="col-md-12">

                    <h2><?php print $pageName; ?></h2> 
                    <!--Botao de nova categoria-->
                    <form action="pedido_formulario.php" method="POST" role="form">
<!--                        <a href="pedido_formulario.php">
                            <button class="btn btn-primary" id="<?= $tabela['id'] ?>" >
                                <span class="glyphicon glyphicon-plus"></span> Pedidos
                            </button>
                        </a>-->
                        <a class="btn btn-default" href="index.php">VOLTAR
                        </a>

                        <p>
                        <table class="table table-bordered" id="tabela_produto">
                            <colgroup>
                                <col width="5%">
                                <col width="10%">
                                <col width="10%">
                                <col width="5%">
                                <col width="5%">
                                <col width="5%">
                                <col width="5%">
                                <col width="5%">
                                <col width="5%">
                                <col width="5%">
                                <col width="5%">
                                <col width="5%">
                                <col width="5%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>Número do Pedido</th>
                                    <th>Data do Pedido</th>
                                    <th>Funcionario Nome</th>
                                    <th>Funcionario Sobrenome</th>
                                    <th>Cliente ID</th>
                                    <th>Cliente Nome</th>
                                    <th>Cliente Sobrenome</th>
                                    <th>Cliente CPF</th>
                                    <th>Cliente2 Nome</th>
                                    <th>Cliente2 Sobrenome</th>
                                    <th>Cliente2 CPF</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query(
                                        "SELECT `pedido`.`id` as pedido_id,
                                `pedido`.`local_retirada`, 
                                `pedido`.`data_pedido`, 
                                `funcionario`.`id` as func_id, 
                                `funcionario`.`nome` as func_nome, 
                                `funcionario`.`sobrenome` as func_sobrenome, 
                                `cliente`.`id` as cliente_id, 
                                `pessoa`.`nome` as cliente1_nome, 
                                `pessoa`.`sobrenome` as cliente1_sobrenome, 
                                `pessoa`.`rg` as cliente1_rg, 
                                `pessoa`.`cpf` as cliente1_cpf, 
                                `pessoa`.`email` as cliente1_email,
                                `pessoa`.`celular` as cliente1_cel,
                                `p`.`nome` as cliente2_nome, 
                                `p`.`sobrenome`as cliente2_sobrenome, 
                                `p`.`rg`as cliente2_rg, 
                                `p`.`cpf`as cliente2_cpf, 
                                `p`.`email`as cliente2_email,
                                `p`.`celular`as cliente2_cel
                                FROM `pedido`
                                 LEFT JOIN `u758661542_tcc`.`cliente` ON `pedido`.`cliente_id` = `cliente`.`id` 
                                 LEFT JOIN `u758661542_tcc`.`funcionario` ON `pedido`.`funcionario_id` = `funcionario`.`id` 
                                 LEFT JOIN `u758661542_tcc`.`pessoa` ON `cliente`.`pessoa_id` = `pessoa`.`id` 
                                 LEFT JOIN `u758661542_tcc`.`pessoa` p ON `cliente`.`pessoa_id2` = `p`.`id`
                                        ");
                                while ($tabela = mysql_fetch_array($resultado)) {
                                    print '<tr>';
                                    print '<td>' . $tabela['pedido_id'] . '</td>';
                                    print '<td>' . $tabela['data_pedido'] . '</td>';
                                    print '<td>' . $tabela['func_nome'] . '</td>';
                                    print '<td>' . $tabela['func_sobrenome'] . '</td>';
                                    print '<td>' . $tabela['cliente_id'] . '</td>';
                                    print '<td>' . $tabela['cliente1_nome'] . '</td>';
                                    print '<td>' . $tabela['cliente1_sobrenome'] . '</td>';
                                    print '<td>' . $tabela['cliente1_cpf'] . '</td>';
                                    print '<td>' . $tabela['cliente2_nome'] . '</td>';
                                    print '<td>' . $tabela['cliente2_sobrenome'] . '</td>';
                                    print '<td>' . $tabela['cliente2_cpf'] . '</td>';
                                    ?>
                                    <!--Botao de editar-->
<!--                                <td>
                                    <a href ="fita_formulario.php?id=<?php echo $tabela['id'] ?>" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-pencil"></span> Editar
                                    </a>
                                </td>
                                Botao de deletar
                                <td>
                                    <a data-toggle="modal" data-target="#myModal" data-whatever="@mdo" onclick="confDeletar(<?= $tabela['id'] ?>, '<?= $tabela['cor'] ?>')" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-trash"></span> Apagar
                                    </a>
                                </td>-->
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </form>
                    <?php include './cancelar_acao.php'; ?>

                </div>
            </div>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>