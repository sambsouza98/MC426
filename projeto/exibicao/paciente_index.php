<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Página inicial</title>
    <?php
    session_start();
    if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] != 3){
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
        <form action="paciente_index.php" style=" display:inline-block;">
            <button type="submit" class="btn btn-light font-weight-bold" style="color:white; background-color: lightseagreen; padding: 5px">
                <span class="glyphicon glyphicon-log-out"></span> Página Inicial
            </button>
        </form>
        <form action="paciente_agendamento.php" style=" display:inline-block;">
            <button type="submit" class="btn btn-light font-weight-bold" style="color:white; background-color: lightseagreen; padding: 5px">
                <span class="glyphicon glyphicon-log-out"></span> Agendar consulta
            </button>
        </form>
        <form action="paciente_cadastro.php" style=" display:inline-block;">
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
        $cpf = $_SESSION['cpf'];
        $sql = "SELECT A.dataSolicitacao, H.nome, H.email  FROM Agendamento AS A INNER JOIN Hospital AS H ON (A.cnpj = H.cnpj) AND A.cpf = '$cpf' AND A.processado = 0";
        $solicitacoes = mysqli_query($conn, $sql);
        if(mysqli_num_rows($solicitacoes) > 0)
        {
            echo "<h3 class='p-t-20'>Solicitações de agendamento pendentes</h3>
    <table class=\"table\">
        <thead class='thead-dark'>
        <tr>
            <th>Hospital</th>
            <th>Email</th>
            <th>Data de Solicitação</th>
            <th></th>
        </tr>
        </thead>
        <tbody>";

        foreach($solicitacoes as $solicitacao){
            $html = "<form>";
            $html .= "<tr>";
            $html .= "<td>".$solicitacao['nome']."</td>";
            $html .= "<td>".$solicitacao['email']."</td>";
            $html .= "<td>".date('d/m/y', strtotime($solicitacao['dataSolicitacao']))."</td>";
            $html .= "</tr>";
            $html .= "</form>";
            echo $html;
        }
        echo "</tbody>
    </table>";
        }
        $sql = "SELECT A.dataConsulta, A.horarioConsulta, H.nome, M.nome AS nomeMedico  FROM Agendamento AS A INNER JOIN Hospital AS H ON (A.cnpj = H.cnpj) INNER JOIN Medico AS M ON A.crm = M.crm AND A.cpf = '$cpf' AND A.processado = 1";
        $consultas = mysqli_query($conn, $sql);
        if(mysqli_num_rows($consultas) > 0){
            echo "<h3>Consultas marcadas</h3>
    <table class=\"table\">
        <thead class='thead-dark'>
        <tr>
            <th>Hospital</th>
            <th>Médico</th>
            <th>Data de Consulta</th>
            <th>Horário de Consulta</th>
        </tr>
        </thead>
        <tbody>";

            foreach($consultas as $consulta){
                $html = "<form>";
                $html .= "<tr>";
                $html .= "<td>".$consulta['nome']."</td>";
                $html .= "<td>".$consulta['nomeMedico']."</td>";
                $html .= "<td>".date('d/m/y', strtotime($consulta['dataConsulta']))."</td>";
                $html .= "<td>".date('H:i:s', strtotime($consulta['horarioConsulta']))."</td>";
                $html .= "</tr>";
                $html .= "</form>";
                echo $html;
            }
            echo "</tbody>
    </table>";
        }
        ?>

</div>

</body>
</html>

