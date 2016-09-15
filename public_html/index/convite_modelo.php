<?php
if (!isset($_SESSION)) {
    session_start();
}
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}
$pageName = "Convite Modelos";
$confDelete = 'convite_modelo_deletar.php';

include './header.php';
include './conexao/Conexao.php';
?>
<script type="text/javascript" src="js/tabela_buscar.js"></script>
<body>
    <div class="wrapper" role="main">
        <div class="container">
            <div class="row">
                <div id="conteudo" class="col-md-12">
                    <h2><?php print $pageName; ?></h2> 
                    <!--Botao de nova categoria-->
                    <form action="convite_modelo_formulario.php" method="POST" role="form">
                        <a href="convite_modelo_formulario.php">
                            <button class="btn btn-primary" id="<?php echo $tabela['id'] ?>" >
                                <span class="glyphicon glyphicon-plus"></span> Novo Modelo
                            </button>
                        </a>
                        <a class="btn btn-default" href="index.php">VOLTAR
                        </a>
                        <p>
                        <table class="lista-clientes table-bordered table-responsive table-hover" id="tabela">
                            <thead>
                            <tr>
                                <th>Cod 8a80</th>
                                <th>Nome</th>
                                <th>Composição</th>
                                <th>Alt(cm)</th>
                                <th>Larg(cm)</th>
                                <th>Aprov. Cartão</th>
                                <th>Formato Cartão Alt (mm)</th>
                                <th>Formato Cartão Larg (mm)</th>
                                <th>Empast. Borda Cartão (mm)</th>
                                <th>Aprov. Env</th>
                                <th>Formato Env Altura (mm)</th>
                                <th>Formato Env Largura (mm)</th>
                                <th>Empast. Borda Env (mm)</th>
                                <th>Qtd Colagem</th>
                                <th>Qtd Dupla Face</th>
                                <th>Qtd Dobras</th>
                                <th>Markup</th>
                                <th>Obs</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                            <tr>
                                <th><input type="text" class="form-control" id="input-search-categoria1" placeholder="Cod" /></th>
                                <th><input type="text" class="form-control" id="input-search-categoria2" placeholder="Buscar Apelido" /></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conexao = new Conexao();
                                $resultado = $conexao->sql_query("SELECT * FROM convite_modelo ORDER BY cod ASC");

                                while ($tabela = mysql_fetch_array($resultado)) {
                                    ?>
                                    <tr>
                                        <td class="col-md-2"> <?= $tabela['cod'] ?> </td>
                                        <td class="text-center text-uppercase"> <?= $tabela['nome'] ?> </td>
                                        <?php
                                        if ($tabela['folha_unica'] == 0) {
                                            print '<td class="text-center">Conv/Envel</td>';
                                        } else {
                                            print '<td class="text-center">Folha Única</td>';
                                        }
                                        ?>
                                        <td class="text-center"> <?= $tabela['altura'] ?></td>
                                        <td class="text-center"> <?= $tabela['largura'] ?></td>
                                        <td class="text-center"> <?= $tabela['formato_cartao'] ?> </td>
                                        <td class="text-center"> <?= $tabela['formato_cartao_altura'] ?> </td>
                                        <td class="text-center"> <?= $tabela['formato_cartao_largura'] ?> </td>
                                        <td class="text-center"> <?= $tabela['empastamento_borda'] ?></td>
                                        <td class="text-center"> <?= $tabela['formato_envelope'] ?> </td>
                                        <td class="text-center"> <?= $tabela['formato_envelope_altura'] ?> </td>
                                        <td class="text-center"> <?= $tabela['formato_envelope_largura'] ?> </td>
                                        <td class="text-center"> <?= $tabela['empastamento_borda_envelope'] ?></td>
                                        <td class="text-center"> <?= $tabela['colagem_pva'] ?> </td>
                                        <td class="text-center"> <?= $tabela['dupla_face'] ?> </td>
                                        <td class="text-center"> <?= $tabela['dobra'] ?> </td>
                                        <td class="text-center"> <?= $tabela['markup'] ?> </td>
                                        <td class="text-center"> <?= $tabela['observacao'] ?> </td>
                                        <!--Botao de editar-->
                                        <td>
                                            <a href ="convite_modelo_formulario.php?id=<?php echo $tabela['id'] ?>" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-pencil"></span> Editar
                                            </a>
                                        </td>
                                        <!--Botao de deletar-->
                                        <td>
                                            <a data-toggle="modal" data-target="#myModal" data-whatever="@mdo" onclick="confDeletar(<?= $tabela['id'] ?>, '<?= $tabela['nome'] ?>')" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash"></span> Apagar
                                            </a>
                                        </td>
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
