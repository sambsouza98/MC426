<?php
session_start();
if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] != 0){
    unset($_SESSION['tipoUsuario']);
    header("Location: ../index.php");
}
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
$idUsuario = $_SESSION['idUsuario'];
$sql = "SELECT email, senha FROM Usuario WHERE idUsuario = '$idUsuario'";
$info = mysqli_fetch_assoc(mysqli_query($conn, $sql));?>

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
        </button>
    </form>
    <br>
</div>
<div class="container">
    <form id="contact" method="post" action="../transicao/admin_altera_cadastro.php">
        <h3>Informações cadastrais</h3>
        <label for="email">Email</label>
        <input type="text" id="email" name='email' value=<?php echo $info['email'];?> required>
        <label for="novaSenha">Nova senha</label>
        <input type="text" id="novaSenha" name='novaSenha'>
        <label for="senha">Senha</label>
        <input type="text" id="senha" name="senha" required>
        <button type="submit" class="btn btn-primary btn-lg">Alterar</button>
    </form>
</div>
</body>
</html>