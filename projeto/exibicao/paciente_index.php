<!DOCTYPE html>
<html>
<head>
    <?php
    session_start();
    if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] != 3){
        unset($_SESSION['tipoUsuario']);
        header("Location: ../index.php");
    }
    require('../transicao/connection.php');
    ?>
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
        $cpf = $_SESSION['cpf'];
        $sql = "SELECT A.dataSolicitacao, H.nome, H.email  FROM Agendamento AS A INNER JOIN Hospital AS H ON (A.cnpj = H.cnpj) AND A.cpf = '$cpf' AND A.processado = 0";
        $solicitacoes = mysqli_query($conn, $sql);
        if(mysqli_num_rows($solicitacoes) > 0)
        {
            echo "<h3>Solicitações de agendamento pendentes</h3>
    <table class=\"table\">
        <thead>
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
        <thead>
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

