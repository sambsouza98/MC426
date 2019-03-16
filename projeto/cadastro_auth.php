<?php
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$tipo = $_POST['tipo'];

require("connection.php");
if($tipo == 'hospital')
    $id = 1;
else
    $id = 0;

$sql = "INSERT INTO Usuario (email, cpf, senha, id) VALUES ('$email', '$cpf', '$senha', '$id')";
mysqli_query($conn, $sql);

mysqli_close($conn);
header("Location: index.php", true, 301);
exit();
