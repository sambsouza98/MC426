<!DOCTYPE html>
<html>
<head>
    <?php
    session_start();
    if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] != 0){
        unset($_SESSION['tipoUsuario']);
        header("Location: ../index.php");
    }
    require('../transicao/connection.php');
    ?>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div style="width: 100%; background-color: lightseagreen; text-align: right">
    <form action="admin_index.php" style=" display:inline-block;">
        <button type="submit" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Index
        </button>
    </form>
    <form action="admin_cadastro.php" style=" display:inline-block;">
        <button type="submit" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Cadastro
        </button>
    </form>
    <form action="../index.php" style=" display:inline-block;">
        <button type="submit" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Log out
        </button><br>
    </form>
</div>
<div class="container">
    <h3>Solicitações pendentes</h3>
        <table class="table">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>CNPJ</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM Hospital WHERE autenticado = 0";
            $solicitacoes = mysqli_query($conn, $sql);

            foreach($solicitacoes as $solicitacao){
                $html = "<form action='admin_analise.php' method='post'>";
                    $html .= "<tr>";
                        $html .= "<td>".$solicitacao['nome']."</td>";
                        $html .= "<td>".$solicitacao['email']."</td>";
                        $html .= "<td>".$solicitacao['cnpj']."</td>";
                        $html .= "<input type='hidden' name='cnpj' value=".$solicitacao['cnpj'].">";
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

