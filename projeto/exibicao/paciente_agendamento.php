<?php
session_start();
if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] != 3){
    unset($_SESSION['tipoUsuario']);
    header("Location: ../index.php");
}
require('../transicao/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Agendamento</title>
    <link rel="stylesheet" type="text/css" href="../css/userinfo.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div style="width: 100%; background-color: lightseagreen; text-align: right">
    <form action="paciente_index.php" style=" display:inline-block;">
        <button type="submit" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Index
        </button>
    </form>
    <form action="paciente_agendamento.php" style=" display:inline-block;">
        <button type="submit" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Agendar consulta
        </button>
    </form>
    <form action="paciente_cadastro.php" style=" display:inline-block;">
        <button type="submit" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Cadastro
        </button>
    </form>
    <form action="../index.php" style=" display:inline-block;">
        <button type="submit" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Log out
        </button>
    </form>
    <br>
</div>
<div class="container">
    <?php
    $sql = "SELECT * FROM Hospital";
    $hospitais = mysqli_query($conn, $sql);

    ?>
    <form id="contact" method="post" action="../transicao/paciente_processa_agendamento.php">
        <h3>Agendar consulta</h3>
        <label for="hospital">Hospital: </label>
        <select id="hospital" name="hospital">
            <?php
            foreach($hospitais as $hospital) {
                echo "<option value=".$hospital['cnpj'].">".$hospital['nome']."</option>";
            }
            ?>
        </select>
        <br>
        <button type="submit" class="btn btn-primary btn-lg">Agendar</button>
    </form>
</div>
</body>
</html>