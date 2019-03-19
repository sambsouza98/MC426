<?php
session_start();
if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] != 0){
    unset($_SESSION['tipoUsuario']);
    header("Location: ../index.php");
}
require('../transicao/connection.php');

$email = $_POST['email'];
$senha = $_POST['senha'];
$novaSenha = empty($_POST['novaSenha']) ? null : $_POST['novaSenha'];
$idUsuario = $_SESSION['idUsuario'];

$sql = "SELECT * FROM Usuario WHERE idUsuario = '$idUsuario' AND senha = '$senha'";
$res = mysqli_query($conn, $sql);
if(mysqli_num_rows($res) > 0){
    if(!empty($novaSenha)){
        $sql = "UPDATE Usuario SET senha='$novaSenha' WHERE idUsuario='$idUsuario'";
        mysqli_query($conn, $sql);
    }
    $sql = "UPDATE Usuario SET email='$email' WHERE idUsuario='$idUsuario'";
    mysqli_query($conn, $sql);
}
header("Location: ../exibicao/admin_cadastro.php");