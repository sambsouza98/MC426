<?php
require('session.php');
require('connection.php');

$res = $_POST['res'];
$cnpj = $_POST['cnpj'];
if($res == 1){
    $sql = "UPDATE Hospital SET autenticado = 1 WHERE cnpj = '$cnpj'";
    mysqli_query($conn, $sql);
}
/*else{
    $sql = "DELETE FROM Hospital WHERE cnpj = '$cnpj'";
    mysqli_query($conn, $sql);
}*/
mysqli_close($conn);

mysqli_close($conn);
header("Location: ../exibicao/admin_index.php", true, 301);
exit();
