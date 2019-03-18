<?php
require('connection.php');

$nome = strtoupper($_POST['nome']);
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$tipo = $_POST['tipo'];
$dataDeCriacao = date('y.m.d', strtotime($_POST['dataDeCriacao']));
$dataDeInclusao = date('y.m.d');

if($tipo == 'hospital'){
    $sql = "INSERT INTO Usuario (email, senha, tipoUsuario, dataDeInclusao) VALUES ('$email', '$senha', 1, '$dataDeInclusao');
            INSERT INTO Hospital (nome, email, cnpj, idUsuario, autenticado, dataDeAbertura) VALUES ('$nome', '$email', '$cpf', (SELECT idUsuario FROM Usuario WHERE email = '$email'), 0, '$dataDeCriacao')";
}
else{
    $sql = "INSERT INTO Usuario (email, senha, tipoUsuario, dataDeInclusao) VALUES ('$email', '$senha', 3, '$dataDeInclusao');
            INSERT INTO Paciente (nome, email, cpf, idUsuario, dataDeNascimento) VALUES ('$nome', '$email', '$cpf', (SELECT idUsuario FROM Usuario WHERE email = '$email'), '$dataDeCriacao')";
}
mysqli_multi_query($conn, $sql);
mysqli_close($conn);
header("Location: ../index.php");
