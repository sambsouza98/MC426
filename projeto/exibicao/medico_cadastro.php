<?php
require('../transicao/session.php');
require('../transicao/connection.php');
if($_SESSION['tipoUsuario'] != 2){
    unset($_SESSION['tipoUsuario']);
    header("Location: ../index.php");
}
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
$cpf = $_SESSION['cpf'];
$sql = "SELECT M.*, U.senha FROM Medico AS M INNER JOIN Usuario AS U ON M.idUsuario = U.idUsuario AND U.idUsuario = '$idUsuario'";
$info = mysqli_fetch_assoc(mysqli_query($conn, $sql));?>

<div style="width: 100%; background-color: lightseagreen; text-align: right">
    <form action="medico_cadastro.php" style=" display:inline-block;">
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
    <form id="contact" method="post" action="../transicao/medico_altera_cadastro.php">
        <h3>Informações cadastrais</h3>
        <label for="nome">Nome</label>
        <input type="text" id='nome' name='nome' value=<?php echo $info['nome'];?> readonly>
        <label for="cpf">CPF</label>
        <input type="text" id="cpf" name='cpf' value=<?php echo $info['cpf'];?> readonly>
        <label for="crm">CRM</label>
        <input type="text" id="crm" name='crm' value=<?php echo $info['crm'];?> readonly>
        <label for="telefone">Telefone</label>
        <input type="text" id="telefone"  name='telefone' value=<?php echo $info['telefone'];?>>
        <label for="especializacao">Especialização</label>
        <input type="text" id="especializacao"  name='especializacao' value=<?php echo $info['especializacao'];?>>
        <label for="email">Email</label>
        <input type="text" id="email" name='email' value=<?php echo $info['email'];?>>
        <label for="novaSenha">Nova senha</label>
        <input type="text" id="novaSenha" name='novaSenha'>
        <label for="senha">Senha</label>
        <input type="text" id="senha" name="senha" required>
        <button type="submit" class="btn btn-primary btn-lg">Alterar</button>
    </form>
</div>
</body>
</html>