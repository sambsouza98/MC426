<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Médicos</title>
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
    <h3 class="p-t-10 p-b-10"></h3>
    <form action="hospital_adiciona_medico.php">
        <button type="submit" class="btn btn-dark">
            Adicionar Médico
        </button>
        <p class="t-b-10"></p>
    </form>
    <table class="table">
        <thead class="thead-light">
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
                $html = "<tr class='table-light'>";
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

