<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Agendamento de consulta</title>
    <?php
    session_start();
    if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] != 1){
        unset($_SESSION['tipoUsuario']);
        header("Location: ../index.php");
    }
    require('../transicao/connection.php');
    ?>
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: lightseagreen">
    <h4 class="font-weight-bold text-light">SSN</h4>
    <div style="width: 100%; text-align: right">
        <form action="hospital_index.php" style=" display:inline-block;">
            <button type="submit" class="btn btn-light font-weight-bold" style="color:white; background-color: lightseagreen; padding: 5px">
                <span class="glyphicon glyphicon-log-out"></span> Página Inicial
            </button>
        </form>
        <form action="hospital_medicos.php" style=" display:inline-block;">
            <button type="submit" class="btn btn-light font-weight-bold" style="color:white; background-color: lightseagreen; padding: 5px">
                <span class="glyphicon glyphicon-log-out"></span> Médicos
            </button>
        </form>
        <form action="hospital_cadastro.php" style=" display:inline-block;">
            <button type="submit" class="btn btn-light font-weight-bold" style="color:white; background-color: lightseagreen; padding: 5px">
                <span class="glyphicon glyphicon-log-out"></span> Usuário
            </button>
        </form>
        <form action="../index.php" style=" display:inline-block;">
            <button type="submit" class="btn btn-light font-weight-bold" style="color:white; background-color: lightseagreen; padding: 5px">
                <span class="glyphicon glyphicon-log-out"></span> Logout
            </button>
        </form>
    </div>
</nav>
<div class="container">
    <?php
    $idAgendamento = $_POST['idAgendamento'];
    $nome = $_POST['nome'];
    $cnpj = $_SESSION['cnpj'];
    ?>
    <h3>Agendamento para: <?php echo $nome;?></h3>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>Horário</th>
            <th></th>
            <th>Data</th>
            <th>Médico</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $start_time = date('H:i:s', strtotime('06:00:00'));
        $end_time = '20:00:00';

        $sql = "SELECT * FROM Medico WHERE crm  IN (SELECT crm FROM medicohospital WHERE cnpj = '$cnpj')";
        $medicos = mysqli_query($conn, $sql);
        while (strtotime($start_time) <= strtotime($end_time)) {
            $start_date = date('y-m-d');
            $end_date = '2019-12-31';
            echo "<form action='../transicao/hospital_marca_consulta.php' method='post'>
                    <tr>
                    <td>
                    $start_time</td>
                    <td></td>
                    <td><select class='form-control' id='dataConsulta' name='dataConsulta'>";
            while (strtotime($start_date) <= strtotime($end_date)) {
                echo '<option value='.$start_date.'>'.date('d/m/y', strtotime($start_date)).'</option>';
                $start_date = date ('y-m-d', strtotime('+1 day', strtotime($start_date)));
            }    echo "</select></td>
                    <td>
                    <select name='crm' class='form-control'>";
            foreach($medicos as $medico){
                echo "<option value=".$medico['crm'].">".$medico['nome']."</option>";
            };
            echo "</select>
                    </td>
                    <input type='hidden' name='horaConsulta' value=".$start_time.">
                    <input type='hidden' name='idAgendamento' value=".$idAgendamento.">
                    <td><button type=\"submit\" class=\"btn btn-success btn-sm btn-block\">Marcar</button></td>
                </tr>
                </form>";
            $start_time = date ("H:i:s", strtotime("+1 hour", strtotime($start_time)));
        }
        ?>
        </tbody>
    </table>

</div>
</body>
</html>

