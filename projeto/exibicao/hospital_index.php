<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Página inicial</title>
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
        $cnpj = $_SESSION['cnpj'];
        $sql = "SELECT A.cpf, A.dataSolicitacao, A.idAgendamento, P.nome, P.email  FROM Agendamento AS A INNER JOIN PACIENTE AS P ON (A.cpf = P.cpf) AND A.cnpj = '$cnpj' AND A.processado = 0";
        $solicitacoes = mysqli_query($conn, $sql);
        if(mysqli_num_rows($solicitacoes) > 0) {
            echo "<h3 class='p-t-20'>Solicitações de agendamento pendentes</h3>
            <table class=\"table\">
            <thead class=\"thead-dark\">
            <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Data de Solicitação</th>
            <th></th>
            </tr>
            </thead>
            <tbody>";
            foreach ($solicitacoes as $solicitacao) {
                $html = "<form action='hospital_consulta.php' method='post'>";
                $html .= "<tr>";
                $html .= "<td>" . $solicitacao['nome'] . "</td>";
                $html .= "<td>" . $solicitacao['cpf'] . "</td>";
                $html .= "<td>" . $solicitacao['email'] . "</td>";
                $html .= "<td>" . date('d/m/y', strtotime($solicitacao['dataSolicitacao'])) . "</td>";
                $html .= "<input type='hidden' name='nome' value=" . $solicitacao['nome'] . ">";
                $html .= "<input type='hidden' name='idAgendamento' value=" . $solicitacao['idAgendamento'] . ">";
                $html .= "<td><button class='btn btn-dark'>Analisar</button></td>";
                $html .= "</tr>";
                $html .= "</form>";
                echo $html;
            }
            echo "</tbody>
    </table>";
        }?>


</div>
</body>
</html>

