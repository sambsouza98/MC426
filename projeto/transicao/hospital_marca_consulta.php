<?php
session_start();
if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] != 1){
    unset($_SESSION['tipoUsuario']);
    header("Location: ../index.php");
}
require('../transicao/connection.php');

$crm = $_POST['crm'];
$dataConsulta = date('y-m-d', strtotime($_POST['dataConsulta']));
$horaConsulta = date('H:i:s', strtotime($_POST['horaConsulta']));
$idAgendamento = $_POST['idAgendamento'];

echo $crm;
$sql = "UPDATE Agendamento SET crm='$crm', dataConsulta='$dataConsulta', horarioConsulta='$horaConsulta', processado=1 WHERE idAgendamento='$idAgendamento'";
mysqli_query($conn, $sql);

header("Location: ../exibicao/hospital_index.php");
