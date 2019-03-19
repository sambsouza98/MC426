<!DOCTYPE html>
<html>
<head>
    <?php
    session_start();
    if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] != 1){
        unset($_SESSION['tipoUsuario']);
        header("Location: ../index.php");
    }
    require('../transicao/connection.php');
    ?>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div style="width: 100%; background-color: lightseagreen; text-align: right">
    <form action="hospital_index.php" style=" display:inline-block;">
        <button type="submit" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Index
        </button>
    </form>
    <form action="hospital_medicos.php" style=" display:inline-block">
        <button type="submit" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Médicos
        </button>
    </form>
    <form action="hospital_cadastro.php" style=" display:inline-block;">
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
    $idAgendamento = $_POST['idAgendamento'];
    $nome = $_POST['nome'];
    $cnpj = $_SESSION['cnpj'];
    ?>
    <h3>Agendamento para: <?php echo $nome;?></h3>
    <table class="table">
        <thead>
        <tr>
            <th>Horário</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $start_date = date('y-m-d');
        $end_date = '2019-12-31';
        echo "<select id='data' name='data'>";
        while (strtotime($start_date) <= strtotime($end_date)) {
            echo "<option value=".$start_date.">$start_date</option>";
            $start_date = date ("y-m-d", strtotime("+1 day", strtotime($start_date)));
        }
        echo "</select>";
        $start_time = date('H:i:s', strtotime('06:00:00'));
        $end_time = '20:00:00';

        $sql = "SELECT * FROM Medico WHERE crm  IN (SELECT crm FROM medicohospital WHERE cnpj = '$cnpj')";
        $medicos = mysqli_query($conn, $sql);
        while (strtotime($start_time) <= strtotime($end_time)) {
            echo "<form action='../transicao/hospital_marca_consulta.php' method='post'>
                    <tr>
                    <td>$start_time</td>
                    <td></td>
                    <td></td>
                    <td>
                    <select name='crm'>";
                    foreach($medicos as $medico){
                        echo "<option value=".$medico['crm'].">".$medico['nome']."</option>";
                    };
            echo "</select>
                    </td>
                    <input type='hidden' name='horaConsulta' value=".$start_time.">
                    <input type='hidden' name='idAgendamento' value=".$idAgendamento.">
                    <input type='hidden' name='dataConsulta' id='dataConsulta'>
                    <td><button type=\"submit\" class=\"btn btn-success\">Marcar</button></td>
                </tr>
                </form>";
            $start_time = date ("H:i:s", strtotime("+1 hour", strtotime($start_time)));
        }
        ?>
        </tbody>
    </table>

</div>
</body>
<script type="text/javascript">
    document.getElementById('data').onchange = function() {
        let e = document.getElementById("data");
        document.getElementById("dataConsulta").value=e.options[e.selectedIndex].text;
    };
</script>
</html>

