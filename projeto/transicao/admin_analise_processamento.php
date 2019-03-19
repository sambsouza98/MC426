<?php
session_start();
if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] != 0){
    unset($_SESSION['tipoUsuario']);
    header("Location: ../index.php");
}
require('../transicao/connection.php');

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
header("Location: ../exibicao/admin_index.php");