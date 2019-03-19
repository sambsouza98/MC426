<?php
    session_start();
    if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] != 3){
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
$sql = "SELECT P.*, U.senha FROM Paciente AS P INNER JOIN Usuario AS U ON P.idUsuario = U.idUsuario AND U.idUsuario = '$idUsuario'";
$info = mysqli_fetch_assoc(mysqli_query($conn, $sql));?>

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
    <form id="contact" method="post" action="../transicao/paciente_altera_cadastro.php">
        <h3>Informações cadastrais</h3>
        <label for="nome">Nome</label>
        <input type="text" id='nome' name='nome' value=<?php echo $info['nome'];?> readonly>
        <label for="cpf">CPF</label>
        <input type="text" id="cpf" name='cpf' value=<?php echo $info['cpf'];?> readonly>
        <label for="telefone">Telefone</label>
        <input type="text" id="telefone"  name='telefone' value=<?php echo $info['telefone'];?>>
        <label for="dataDeNascimento">Data de Nascimento</label>
        <input type="text" id="dataDeNascimento"  name='dataDeNascimento' value=<?php echo $info['dataDeNascimento'];?>>
        <label for="tipoSanguineo">Tipo Sanguíneo</label>
        <?php
            if(!empty($info['tipoSanguineo'])){
                $html = "<input type='text' id='tipoSanguineo' name='tipoSanguineo' value=".$info['tipoSanguineo']." readonly>";
                echo $html;
            }
            else{
                $html = "<select id='tipoSanguineo' name='tipoSanguineo'>";
                $html .= "<option></option>";
                $html .= "<option value='A-'>A-</option>";
                $html .= "<option value='A+'>A+</option>";
                $html .= "<option value='B-'>B-</option>";
                $html .= "<option value='B+'>B+</option>";
                $html .= "<option value='AB-'>AB-</option>";
                $html .= "<option value='AB+'>AB+</option>";
                $html .= "<option value='O-'>O-</option>";
                $html .= "<option value='O+'>O+</option>";
                $html .= "</select>";
                echo $html;
            }
        ?>
        <br>
        <label for="sexo">Sexo</label>
        <input type="text" id="sexo" name='sexo' value=<?php echo $info['sexo'];?>>
        <label for="alergias">Alergias</label>
        <input type="text" id="alergias" name='alergias' value=<?php echo $info['alergias'];?>>
        <label for="convenio">Convênio</label>
        <input type="text" id="convenio" name='convenio' value=<?php echo $info['convenio'];?>>
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