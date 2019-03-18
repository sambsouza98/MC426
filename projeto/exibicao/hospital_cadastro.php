<?php
require('../transicao/session.php');
require('../transicao/connection.php');
if($_SESSION['tipoUsuario'] != 1){
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
$sql = "SELECT H.*, U.senha FROM Hospital AS H LEFT JOIN Usuario AS U ON H.idUsuario = U.idUsuario AND U.idUsuario = '$idUsuario'";
$info = mysqli_fetch_assoc(mysqli_query($conn, $sql));?>

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
    <form id="contact" method="post" action="../transicao/hospital_altera_cadastro.php">
        <h3>Informações cadastrais</h3>
        <label for="nome">Nome</label>
        <input type="text" id='nome' name='nome' value=<?php echo $info['nome'];?> readonly>
        <label for="cnpj">CNPJ</label>
        <input type="text" id="cnpj" name='cnpj' value=<?php echo $info['cnpj'];?> readonly>
        <label for="telefone">Telefone</label>
        <input type="text" id="telefone"  name='telefone' value=<?php echo $info['telefone'];?>>
        <label for="dataDeAbertura">Data de Abertura</label>
        <input type="text" id="dataDeAbertura"  name='dataDeAbertura' value=<?php echo $info['dataDeAbertura'];?>>
        <label for="endereco">Endereço</label>
        <input type="text" id="endereco"  name='endereco' value=<?php echo $info['endereco'];?>>
        <label for="conveniosAceitos">Convênios aceitos</label>
        <input type="text" id="conveniosAceitos" name='conveniosAceitos' value=<?php echo $info['conveniosAceitos'];?>>
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