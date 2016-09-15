<?php
$pageName = "Fita Categoria";
$confDelete = 'acabamento_deletar.php';
include './header.php';
$permissao = Array("gerente", "tecnico");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
}
include './conexao/Conexao.php';
?>
<script type="text/javascript" language="javascript">
    $(document).ready(function () {

        $('#enviar').click(function () {
            var nomeCategoria = $("#nomeCategoria").val();
            var valorCategoria = $("#valorCategoria").val();
            alert(nomeCategoria + "\n" + valorCategoria);
            if (nomeCategoria !== "" && valorCategoria !== "") {
                $.post(
                        "categoria_fita_inserir.php",
                        {
                            acao: "editar",
                            nomeCategoria: nomeCategoria,
                            valorCategoria: valorCategoria
                        },
                function (result) {
                    alert(result + "\n tipo" + $.type(result));
                    if (result === "1") {
                        $(".modal-body").append("<div class='alert alert-success' role='alert'>Dados enviados</div>");
                        $(".alert").fadeOut(4000);

                        $("#nomeCategoria").val("");
                        $("#valorCategoria").val("");
                    } else {
                        $(".modal-body").append("<div class='alert alert-danger' role='alert'>Erro ao gravar dados</div>");
                        $(".alert").fadeOut(4000);
                    }

                }
                );
            } else {
                $(".modal-body").append("<div class='alert alert-danger' role='alert'>Preencha os campos</div>");
            }
        });
    });
    function editar(id) {
        alert(id);
    }
    function deletar(id) {
        alert(id);
    }
</script>
<body>
    <?php
//ira verificar se ha valor 
    $arr = $_REQUEST;
    $id = $arr["id"];

    if ($id == NULL) {
        $nome = "";
        $valor = "";
        $botao = "Inserir";
        $pageName = "Nova Categoria";
    } else {
        var_dump($id);
        $con = new Conexao();
        $resultado = $con->sql_query("SELECT * FROM categoria_fita WHERE id ="); //tem algum erro aqui neste select....setei como número 1 para teste e deu certo, so preciso pegar a variavel id
        $tabela = mysql_fetch_array($resultado);
        $nome = $tabela["nome"];
        $valor = $tabela["valor"];
        $botao = "Alterar";
        $pageName = "Alterar Categoria";
    }
    ?>
    <div class="modal fade" id="formularioCategoriaFita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel"><?php print $pageName; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="form">
                            <div class="form-group">
                                <label class="control-label col-md-2" for="nomeCategoria">Nome:</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="nomeCategoria" id="nomeCategoria" placeholder="Entre com a categoria" value=<?php print $nome; ?>>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="valorCategoria">Valor:</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="valorCategoria" id="valorCategoria" placeholder="Entre com o valor" value=<?php print $valor; ?>>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="enviar"><?php echo $botao; ?></button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h2>Categoria Fita</h2>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formularioCategoriaFita" data-whatever="@mdo">Criar Categoria</button>                
        </div>
        <div class="row">
            <table class="table table-bordered">
                <colgroup>
                    <col width="10%">
                    <col width="40%">
                    <col width="30%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Valor</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conexao = new Conexao();
                    $resultado = $conexao->sql_query("select * from categoria_fita ORDER BY id  DESC");

                    while ($tabela = mysql_fetch_array($resultado)) {
                        print '<tr>';
                        print '<td>' . $tabela['id'] . '</td>';
                        print'<td>' . $tabela['nome'] . '</td>';
                        print'<td>' . $tabela['valor'] . '</td>';
                        ?>
                    <td><button class="btn btn-primary" data-toggle="modal" data-target="#formularioCategoriaFita" data-whatever="@mdo"  id="<?php echo $tabela['id'] ?>"  onclick="editar(this.id)"><span class="glyphicon glyphicon-pencil"></span> Editar</button></td>
                    <td><button class="btn btn-danger" data-toggle="modal" data-target="#formularioCategoriaFita" data-whatever="@mdo" id="<?php echo $tabela['id'] ?>"  onclick="deletar(this.id)"><span class="glyphicon glyphicon-trash"></span> Deletar</button></td>

                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<?php
include './footer.php';
?>
