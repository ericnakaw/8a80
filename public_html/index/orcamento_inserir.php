<meta charset="UTF-8">
<pre>
    <?php
    include './objeto/Pessoa.php';
    include './objeto/Cliente.php';
    include './conexao/Conexao.php';
    $conexao = new Conexao();
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];
    $cpf = $_POST['RG'];
    $rg = $_POST['CPF'];
    $pessoa1 = new Pessoa($conexao);
    $pessoa1->insertPessoa($nome, $sobrenome, $email, $telefone, $celular, $cpf, $rg);

    $id_pessoa1 = mysql_fetch_array($conexao->sql_query("SELECT max(id) as id FROM pessoa"));
    print $id_pessoa1['id'];

    $nome2 = $_POST['nome2'];
    $sobrenome2 = $_POST['sobrenome2'];
    $email2 = $_POST['email2'];
    $telefone2 = $_POST['telefone2'];
    $celular2 = $_POST['celular2'];

    if (!empty($nome2) || !empty($sobrenome2) || !empty($email2) || !empty($telefone2) || !empty($celular2)) {
        $pessoa1 = new Pessoa($conexao);
        $pessoa1->insertPessoa($nome2, $sobrenome2, $email2, $telefone2, $celular2);

        $id_pessoa2 = mysql_fetch_array($conexao->sql_query("SELECT max(id) as id FROM pessoa"));
        print $id_pessoa2['id'];
    }
    ?>
</pre> 