<?php
require('../transicao/session.php');
require('../transicao/connection.php');
if($_SESSION['tipoUsuario'] != 2){
    unset($_SESSION['tipoUsuario']);
    header("Location: ../index.php");
}

$email = $_POST['email'];
$telefone = empty($_POST['telefone']) ? null : $_POST['telefone'];
$especializacao = empty($_POST['especializacao']) ? null : $_POST['especializacao'];
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
    $sql = "UPDATE Medico SET email='$email', telefone='$telefone', especializacao='$especializacao' WHERE idUsuario='$idUsuario'";
    mysqli_query($conn, $sql);
}
header("Location: ../exibicao/medico_cadastro.php");