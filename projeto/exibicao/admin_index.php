<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Página inicial</title>
    <?php
    session_start();
    if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] != 0){
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
        <form action="admin_index.php" style=" display:inline-block;">
            <button type="submit" class="btn btn-light font-weight-bold" style="color:white; background-color: lightseagreen; padding: 5px">
                <span class="glyphicon glyphicon-log-out"></span> Página Inicial
            </button>
        </form>
        <form action="admin_cadastro.php" style=" display:inline-block;">
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
            $sql = "SELECT * FROM Hospital WHERE autenticado = 0";
            $solicitacoes = mysqli_query($conn, $sql);
            if(mysqli_num_rows($solicitacoes) > 0){
            echo "<h3 class='p-t-20'>Solicitações pendentes</h3>
            <table class=\"table\">
            <thead class='thead-dark'>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>CNPJ</th>
                <th></th>
            </tr>
            </thead>
            <tbody>";
            foreach($solicitacoes as $solicitacao){
                $html = "<form action='admin_analise.php' method='post'>";
                    $html .= "<tr>";
                        $html .= "<td>".$solicitacao['nome']."</td>";
                        $html .= "<td>".$solicitacao['email']."</td>";
                        $html .= "<td>".$solicitacao['cnpj']."</td>";
                        $html .= "<input type='hidden' name='cnpj' value=".$solicitacao['cnpj'].">";
                        $html .= "<td><button class='btn btn-dark'>Analisar</button></td>";
                    $html .= "</tr>";
                $html .= "</form>";
                echo $html;
             }
                echo "</tbody>
    </table>";
            } ?>


</div>
</body>
</html>

