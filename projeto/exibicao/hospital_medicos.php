<!DOCTYPE html>
<html>
<head>
    <?php
    require('../transicao/session.php');
    require('../transicao/connection.php');
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
</head>
<body>
<div style="width: 100%; background-color: lightseagreen; text-align: right">
    <form action="hospital_medicos.php" style=" display:inline-block">
        <button type="submit" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Médicos
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
    $cnpj = $_SESSION['cnpj'];
    $sql = "SELECT * FROM Medico WHERE crm IN (SELECT crm FROM MedicoHospital WHERE cnpj = '$cnpj')";
    $medicos = mysqli_query($conn, $sql);
    ?>
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
        <?php foreach($medicos as $medico){
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

