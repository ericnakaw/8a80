<?php
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    
    include './conexao/Conexao.php';
    $conexao = new conexao();
    
    $sql1 = "SELECT id,nome,senha,usuario FROM `funcionario` WHERE (`usuario` = '". $usuario ."') AND (`ativo` = 0)";
    $inativo= $conexao->sql_query($sql1);
    
    if (mysql_num_rows($inativo) == 1){
        $resultado = mysql_fetch_array($inativo);
        header("Location: cadastra_senha.php?usuario=".$usuario."&nome=".$resultado["nome"]);
        exit();
    }
    
    $sql = "SELECT `id`, `nome`,`nivel` FROM `funcionario` WHERE (`usuario` = '". $usuario ."') AND (`senha` = '". sha1($senha) ."') AND (`ativo` = 1) LIMIT 1";
    //$verifica = $conexao->sql_query("SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'") or die("erro ao selecionar");
    $verifica = $conexao->sql_query($sql) or die("erro ao consultar banco de dados");
    
    if (mysql_num_rows($verifica)<=0){
        //echo"<script language='javascript' type='text/javascript'>window.location.href='login.php';</script>";
        session_destroy();
        // 0 Erro de logim ou senha
        header("Location: login.php?err=0");
    }else{
        // Salva os dados encontados na variável $resultado
        $resultado = mysql_fetch_assoc($verifica);

        // Se a sessão não existir, inicia uma
        if (!isset($_SESSION)) session_start();

        // Salva os dados encontrados na sessão
        $_SESSION['UsuarioID'] = $resultado['id'];
        $_SESSION['UsuarioNome'] = $resultado['nome'];
        $_SESSION['UsuarioNivel'] = $resultado['nivel'];

        // Redireciona o visitante
        header("Location: index.php?msg=logado");
        exit;
    }
?>