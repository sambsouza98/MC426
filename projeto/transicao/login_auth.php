<?php
session_start();
$email = $_POST['email'];
$senha = $_POST['senha'];

require("connection.php");
$sql = "SELECT tipoUsuario, idUsuario FROM Usuario WHERE email = '$email' AND senha = '$senha'";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
    $res = mysqli_fetch_assoc($res);
    $idUsuario = $res['idUsuario'];
    $_SESSION['idUsuario'] = $res['idUsuario'];
    $_SESSION['tipoUsuario'] = $res['tipoUsuario'];

    switch($res['tipoUsuario']){
        case 0:
            $header = '../exibicao/admin_index.php';
            break;
        case 1:
            $sql = "SELECT * FROM Hospital WHERE idUsuario = '$idUsuario' AND autenticado = 1";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0){
                $header = '../exibicao/hospital_index.php';
                $sql = "SELECT cnpj FROM Hospital WHERE idUsuario=".$idUsuario;
                $_SESSION['cnpj'] = mysqli_fetch_assoc(mysqli_query($conn, $sql))['cnpj'];
            }
            else
                $header = '../index.php';
            break;
        case 2:
            $header = '../exibicao/medico_index.php';
            $sql = "SELECT crm FROM Medico WHERE idUsuario=".$idUsuario;
            $_SESSION['crm'] = mysqli_fetch_assoc(mysqli_query($conn, $sql))['crm'];
            break;
        case 3:
            $header = '../exibicao/paciente_index.php';
            $sql = "SELECT cpf FROM Paciente WHERE idUsuario=".$idUsuario;
            $_SESSION['cpf'] = mysqli_fetch_assoc(mysqli_query($conn, $sql))['cpf'];
            break;
        default:
            $header = '../index.php';
            break;
    }
}
else
    $header = '../index.php';

mysqli_close($conn);
header("Location: $header");