<?php
session_start();
if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] != 1){
    unset($_SESSION['tipoUsuario']);
    header("Location: ../index.php");
}
require('../transicao/connection.php');

$email = $_POST['email'];
$endereco = empty($_POST['endereco']) ? null : $_POST['endereco'];
$telefone = empty($_POST['telefone']) ? null : $_POST['telefone'];
$dataDeAbertura = empty($_POST['dataDeAbertura']) ? null : date('y-m-d', strtotime($_POST['dataDeAbertura']));
$conveniosAceitos = empty($_POST['conveniosAceitos']) ? null : $_POST['conveniosAceitos'];
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
    $sql = "UPDATE Hospital SET email='$email', endereco='$endereco', telefone='$telefone', conveniosAceitos='$conveniosAceitos', dataDeAbertura='$dataDeAbertura' WHERE idUsuario='$idUsuario'";
    mysqli_query($conn, $sql);
}
header("Location: ../exibicao/hospital_cadastro.php");