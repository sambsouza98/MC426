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
    <h3>Solicitações de agendamento pendentes</h3>
    <table class="table">
        <thead>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Data de Solicitação</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $cnpj = $_SESSION['cnpj'];
        $sql = "SELECT A.cpf, A.dataSolicitacao, A.idAgendamento, P.nome, P.email  FROM Agendamento AS A INNER JOIN PACIENTE AS P ON (A.cpf = P.cpf) AND A.cnpj = '$cnpj' AND A.processado = 0";
        $solicitacoes = mysqli_query($conn, $sql);

        foreach($solicitacoes as $solicitacao){
            $html = "<form action='hospital_consulta.php' method='post'>";
            $html .= "<tr>";
            $html .= "<td>".$solicitacao['nome']."</td>";
            $html .= "<td>".$solicitacao['cpf']."</td>";
            $html .= "<td>".$solicitacao['email']."</td>";
            $html .= "<td>".date('d/m/y', strtotime($solicitacao['dataSolicitacao']))."</td>";
            $html .= "<input type='hidden' name='nome' value=".$solicitacao['nome'].">";
            $html .= "<input type='hidden' name='idAgendamento' value=".$solicitacao['idAgendamento'].">";
            $html .= "<td><button>Analisar</button></td>";
            $html .= "</tr>";
            $html .= "</form>";
            echo $html;
        } ?>
        </tbody>
    </table>

</div>
</body>
</html>

