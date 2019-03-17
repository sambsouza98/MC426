<!DOCTYPE html>
<html>
<head>
    <?php
    require('../transicao/session.php');
    require('../transicao/connection.php');
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div style="width: 100%; background-color: lightseagreen; text-align:right">
    <form action="../index.php">
        <button type="submit" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Log out
        </button><br><br>
    </form>
</div>
<div class="container">
    <?php
    $sql = "SELECT * FROM Hospital WHERE autenticado = 0";
    $solicitacoes = mysqli_query($conn, $sql);
    ?>
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

