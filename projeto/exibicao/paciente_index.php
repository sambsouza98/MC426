<!DOCTYPE html>
<html>
<head>
    <?php
    require('../transicao/session.php');
    require('../transicao/connection.php');
    if($_SESSION['tipoUsuario'] != 3){
        unset($_SESSION['tipoUsuario']);
        header("Location: ../index.php");
    }
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
    <h3>Solicitações de agendamento pendentes</h3>
    <table class="table">
        <thead>
        <tr>
            <th>Hospital</th>
            <th>Email</th>
            <th>Data de Solicitação</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $cpf = $_SESSION['cpf'];
        $sql = "SELECT A.dataDeSolicitacao, H.nome, H.email  FROM Agendamento AS A INNER JOIN Hospital AS H ON (A.cnpj = H.cnpj) AND A.cpf = '$cpf' AND A.processado = 0";
        $solicitacoes = mysqli_query($conn, $sql);

        foreach($solicitacoes as $solicitacao){
            $html = "<form>";
            $html .= "<tr>";
            $html .= "<td>".$solicitacao['nome']."</td>";
            $html .= "<td>".$solicitacao['email']."</td>";
            $html .= "<td>".date('d/m/y', strtotime($solicitacao['dataDeSolicitacao']))."</td>";
            $html .= "<td><button>Modificar</button></td>";
            $html .= "</tr>";
            $html .= "</form>";
            echo $html;
        } ?>
        </tbody>
    </table>

</div>

</body>
</html>

