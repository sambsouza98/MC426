<?php
    require('../transicao/session.php');
    require('../transicao/connection.php');
    if($_SESSION['tipoUsuario'] != 3){
        unset($_SESSION['tipoUsuario']);
    header("Location: ../index.php");
}

$email = $_POST['email'];
$telefone = empty($_POST['telefone']) ? null : $_POST['telefone'];
$dataDeNascimento = empty($_POST['dataDeNascimento']) ? null : $_POST['dataDeNascimento'];
$tipoSanguineo = empty($_POST['tipoSanguineo']) ? null : $_POST['tipoSanguineo'];
$sexo = empty($_POST['sexo']) ? null : $_POST['sexo'];
$alergias = empty($_POST['alergias']) ? null : $_POST['alergias'];
$convenio = empty($_POST['convenio']) ? null : $_POST['convenio'];
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
    $sql = "UPDATE Paciente SET email='$email', telefone='$telefone', tipoSanguineo='$tipoSanguineo', sexo='$sexo', alergias='$alergias', convenio='$convenio' WHERE idUsuario='$idUsuario'";
    mysqli_query($conn, $sql);
}
header("Location: ../exibicao/paciente_cadastro.php");