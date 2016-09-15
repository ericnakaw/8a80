<!DOCTYPE html>
<!-- Aqui começa o conteudo -->
<div class="wrapper" role="main">
    <div class="container">
        <div class="row">
            <div id="conteudo" class="col-md-12">
                <form action="orcamento_cliente_salvar.php" method="POST">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-user"></span> <b>Dados do Cliente</b>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label" for="evento"><span class="glyphicon glyphicon-pushpin"></span> Evento:</label>
                                        <div class="form-group">
                                            <select name="evento" id="evento" class="form-control">
                                                <option>Selecione um evento</option>
                                                <option value="casamento" <?php
                                                if ($evento === "casamento") {
                                                    print 'selected';
                                                }
                                                ?>>Casamento</option>
                                                <option value="debutante" <?php
                                                if ($evento === "debutante") {
                                                    print 'selected';
                                                }
                                                ?>>Debutante</option>
                                                <option value="aniversario" <?php
                                                if ($evento === "aniversario") {
                                                    print 'selected';
                                                }
                                                ?>>Aniversário</option>
                                                <option value="corporativo" <?php
                                                if ($evento === "corporativo") {
                                                    print 'selected';
                                                }
                                                ?>>Corporativo</option>
                                                <option value="Outros" <?php
                                                if ($evento === "outros") {
                                                    print 'selected';
                                                }
                                                ?>>Outros</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--date imput data do evento-->
                                    <div class="col-md-4">
                                        <label for="data_evento"><span class="glyphicon glyphicon-calendar"></span> Data Evento:</label>
                                        <div class="form-group">
                                            <input type="date" name="data_evento" placeholder="Ex: 20-12-2015" id="data_evento" class="form-control" value="<?= $data_evento ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label for="nome"><span class="glyphicon glyphicon-user"></span> Nome:</label>
                                            <input type="text" name="nome" id="nome" placeholder="Nome: Noiva / Responsável" class="form-control input-sm" value="<?= $nome ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="sobrenome">Sobrenome:</label>
                                            <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" class="form-control input-sm" value="<?= $sobrenome ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="emailResponsavel"><span class="glyphicon glyphicon-envelope"></span> Email:</label>
                                            <input type="email" name="email" id="email" placeholder="E-mail" class="form-control input-sm" value="<?= $email ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <label for="celular"><span class="glyphicon glyphicon-phone"></span> Celular:</label>
                                            <input type="number" name="celular" id="celular" maxlength="10" placeholder="Celular" class="form-control input-sm" value="<?= $celular ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="telefone"><span class="glyphicon glyphicon-phone-alt"></span> Telefone:</label>
                                            <input type="number" name="telefone" id="telefone" maxlength="9" placeholder="Residencial" class="form-control input-sm" value="<?= $telefone ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="rg">RG:</label>
                                            <input type="text" name="rg" id="rg" placeholder="RG" class="form-control input-sm" value="<?= $rg ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="cpf">CPF:</label>                                        
                                            <input type="text" name="cpf" id="cpf" placeholder="CPF" class="form-control input-sm" value="<?= $cpf ?>">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label for="nome2"><span class="glyphicon glyphicon-user"></span> Nome:</label>
                                            <input type="text" name="nome2" id="nome2" placeholder="Nome: Noivo / Aniversáriante" class="form-control input-sm" value="<?= $nome2 ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="sobrenome2">Sobrenome:</label>
                                            <input type="text" name="sobrenome2" id="sobrenome2" placeholder="Sobrenome" class="form-control input-sm" value="<?= $sobrenome2 ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email2"><span class="glyphicon glyphicon-envelope"></span> Email:</label>
                                            <input type="email" name="email2" id="email2" placeholder="E-mail" class="form-control input-sm" value="<?= $email2 ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <label for="celular2"><span class="glyphicon glyphicon-phone"></span> Celular:</label>
                                            <input type="number" name="celular2" id="celular2" maxlength="10" placeholder="Celular" class="form-control input-sm" value="<?= $celular2 ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="telefone2"><span class="glyphicon glyphicon-phone-alt"></span> Telefone:</label>
                                            <input type="number" name="telefone2" id="telefone2" placeholder="Residencial" class="form-control input-sm" value="<?= $telefone2 ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="rg2">RG:</label>
                                            <input type="text" name="rg2" id="rg2" placeholder="RG" class="form-control input-sm" value="<?= $rg2 ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="cpf2">CPF:</label>                                        
                                            <input type="text" name="cpf2" id="cpf2" placeholder="CPF" class="form-control input-sm" value="<?= $cpf2 ?>">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label for="rua"><span class="glyphicon glyphicon-road"></span> Rua:</label>
                                            <input type="text" name="rua" id="rua" placeholder="Ex: Avenida Brasil" class="form-control" value="<?= $rua ?>">
                                        </div>

                                        <div class="col-md-2">
                                            <label for="numero">Número:</label>
                                            <input type="number" name="numero" id="numero" placeholder="Número" class="form-control" value="<?= $numero ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="complemento">Complemento:</label>
                                            <input type="text" name="complemento" id="complemento" placeholder="Ex: Ap. 47, Casa 3" class="form-control" value="<?= $complemento ?>">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="bairro">Bairro:</label>
                                            <input type="text" name="bairro" id="bairro" placeholder="Ex: Liberdade, Republica,Tatuapé" class="form-control" value="<?= $bairro ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label for="cep">CEP:</label>
                                            <input type="text" name="cep" id="cep" maxlength="8" placeholder="Ex: 04208050 *Sem o Traço*" class="form-control" value="<?= $cep ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="cidade">Cidade:</label>
                                            <input type="text" name="cidade" id="cidade" placeholder="Ex: São paulo, Guarulhos,..." class="form-control" value="<?= $cidade ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="estado">Estado:</label>
                                            <input type="text" name="estado" id="estado" placeholder="Ex: SP" class="form-control" value="<?= $estado ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="observacao">Observacões:</label>
                                            <textarea type="text" name="observacao" id="observacao" placeholder="Ex: Ponto de referencia,..." class="form-control"><?= $observacao ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-5"></div>
                                <div class="col-md-3">
                                        <?php
                                        //Verifica se na URL contém a string "orcamento_cliente.php" para direcionar os botões de ações.
                                        if (strpos($_SERVER['SCRIPT_NAME'], 'orcamento_cliente.php') == TRUE) {
                                            ?>
                                            <a href="orcamento_cliente_salvar.php?acao=limpar" class="btn btn-danger">Limpar</a>
                                            <button type="submit" class="btn btn-success">Avançar</button>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="cliente_formulario.php" class="btn btn-danger">Limpar</a>
                                            <button type="submit" class="btn btn-warning">Alterar</button>
                                            <?php
                                        }
                                        ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--                    <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <span class="glyphicon glyphicon-globe"></span> <b>Dados Complementares</b>
                                            </div>
                                            <div class="panel-body">
                                                Dados gerais do cliente
                                            </div>
                                        </div>-->
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $("#cep").blur(carregaCep);
    });

    function carregaCep() {
        var cep = $("#cep").val();
        var url_valor = "http://correiosapi.apphb.com/cep/" + cep;

        $.ajax({
            url: url_valor,
            dataType: 'jsonp',
            crossDomain: true,
            contentType: "application/json",
            statusCode: {
                200: function (data) {
                    $("#rua").val(data.logradouro);
                    $("#bairro").val(data.bairro);
                    $("#cidade").val(data.cidade);
                    $("#estado").val(data.estado);
                } // Ok
                , 400: function (msg) {
                    alert(msg);
                } // Bad Request
                , 404: function () {
                    alert("CEP não encontrado!!");
                } // Not Found
            }
        });

    }

</script>