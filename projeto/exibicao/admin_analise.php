<?php
require("../transicao/session.php");
require('../transicao/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Informações do hospital</title>
    <link rel="stylesheet" type="text/css" href="../css/userinfo.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<?php
$cnpj = $_POST['cnpj'];
$sql = "SELECT * FROM Hospital WHERE cnpj = '$cnpj'";
$info = mysqli_fetch_assoc(mysqli_query($conn, $sql));?>

<div style="width: 100%; background-color: lightseagreen; text-align:right">
    <form action="../index.php">
        <button type="submit" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Log out
        </button><br><br>
    </form>
</div>
<div class="container">
    <form id="contact" method="post" action="../transicao/admin_analise_processamento.php">
        <h3>Informações cadastrais</h3>
            <label for="cnpj">CNPJ</label>
            <input type="text" name="cnpj" id="cnpj" value=<?php echo $info['cnpj'];?>>
            <label for="nome">Nome</label>
            <input type="text" id='nome' value=<?php echo $info['nome'];?> disabled>
            <label for="email">Email</label>
            <input type="text" id="email" value=<?php echo $info['email'];?> disabled>
        <button type="submit" name="res" class="btn btn-primary btn-lg" value="1">Aprovar</button>
        <button type="submit" name="res" class="btn btn-primary btn-lg" value="0" style="background-color: darkred">Recusar</button>

    </form>
</div>
</body>
</html>