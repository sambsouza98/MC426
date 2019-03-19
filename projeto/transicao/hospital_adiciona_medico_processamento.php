<?php
session_start();
if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] != 1){
    unset($_SESSION['tipoUsuario']);
    header("Location: ../index.php");
}
require('../transicao/connection.php');

$crm = $_POST['crm'];
$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$cnpj = $_SESSION['cnpj'];
$dataDeInclusao = date('y.m.d');

$sql = "INSERT INTO Usuario (email, senha, tipoUsuario, dataDeInclusao) VALUES ('$email', '$senha', 2, '$dataDeInclusao');
        INSERT INTO Medico (crm, cpf, nome, email, idUsuario) VALUES ('$crm', '$cpf', '$nome', '$email', (SELECT idUsuario FROM Usuario WHERE email = '$email'));
        INSERT INTO MedicoHospital (crm, cnpj) VALUES ('$crm', '$cnpj')";
if (mysqli_multi_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
header("Location: ../exibicao/hospital_medicos.php");

