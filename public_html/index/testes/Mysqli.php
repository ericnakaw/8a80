<?php

$con = mysqli_connect("127.0.0.1", "root", "", "u758661542_tcc");
$id;
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Set autocommit to off
mysqli_autocommit($con, FALSE);

// Insert some values

try {
    mysqli_query($con, "INSERT INTO `convite`(`id_modelo`, `descricao_cartao`, `descricao_envelope`) "
            . "VALUES (10,'Teste SQLi','Teste SQLi')");
    printf("New Record has id %d.\n", mysqli_insert_id($con));
    $id = mysql_insert_id();
    
    print('Iniciando query cartao_papel:');
    mysqli_query($con, "INSERT INTO `cartao_papel`(`id_convite`, `id_papel`, `gramatura`) "
            . "VALUES (<?=$id?>,1,240)");
} catch (Exception $ex) {
    print('Ocorreu um erro: ' . $ex . '<br>');
    print('Fazendo rollback: <br>');
    mysqli_rollback($con);
}


// Commit transaction
mysqli_commit($con);

// Rollback transaction
//mysqli_rollback($con);
// Close connection
mysqli_close($con);
?> 