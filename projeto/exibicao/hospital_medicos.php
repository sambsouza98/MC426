<!DOCTYPE html>
<html>
<head>
    <?php
    require('../transicao/session.php');
    require('../transicao/connection.php');
    if($_SESSION['tipoUsuario'] != 1){
        unset($_SESSION['tipoUsuario']);
        header("Location: ../index.php");
    }
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
    <h3>Médicos</h3>
    <form action="hospital_adiciona_medico.php">
        <button type="submit" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Adicionar Médico
        </button>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Especialização</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $cnpj = $_SESSION['cnpj'];
        $sql = "SELECT * FROM Medico WHERE crm IN (SELECT crm FROM MedicoHospital WHERE cnpj = '$cnpj')";
        $medicos = mysqli_query($conn, $sql);

        foreach($medicos as $medico){
                $html = "<tr>";
                    $html .= "<td>".$medico['nome']."</td>";
                    $html .= "<td>".(is_null($medico['especializacao']) ? "N/A" : $medico['especializacao'])."</td>";
                $html .= "</tr>";
            echo $html;
        }?>
        </tbody>
    </table>

</div>
</body>
</html>

