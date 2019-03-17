<?php
session_start();
$email = $_POST['email'];
$senha = $_POST['senha'];

require("connection.php");
$sql = "SELECT tipoUsuario, idUsuario FROM Usuario WHERE email = '$email' AND senha = '$senha'";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
    $res = mysqli_fetch_assoc($res);
    switch($res['tipoUsuario']){
        case 0:
            $header = '../exibicao/admin_index.php';
            break;
        case 1:
            $header = '../exibicao/hospital_index.php';
            $sql = "SELECT cnpj FROM Hospital WHERE idUsuario=".$res['idUsuario'];
            $_SESSION['cnpj'] = mysqli_fetch_assoc(mysqli_query($conn, $sql))['cnpj'];
            break;
        default:
            $header = '../exibicao/admin.index.php';
            break;
    }
    $_SESSION['idUsuario'] = $res['idUsuario'];
    $_SESSION['login'] = true;
}
else
    $header = '../index.php';

mysqli_close($conn);
header("Location: $header", true, 301);
exit();