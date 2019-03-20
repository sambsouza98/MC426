<?php
session_start();
if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] != 1){
    unset($_SESSION['tipoUsuario']);
    header("Location: ../index.php");
}
require('../transicao/connection.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Dados do usuário</title>
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<?php
$idUsuario = $_SESSION['idUsuario'];
$sql = "SELECT H.*, U.senha FROM Hospital AS H LEFT JOIN Usuario AS U ON H.idUsuario = U.idUsuario AND U.idUsuario = '$idUsuario'";
$info = mysqli_fetch_assoc(mysqli_query($conn, $sql));?>

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
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login101">
            <form class="login100-form validate-form p-l-55 p-r-55 p-t-10" method="post" action="../transicao/hospital_altera_cadastro.php">
					<span class="login100-form-title p-b-10">
						Usuário
					</span>
                <div class="wrap-input100 validate-input">
                    <label for="nome" class="text-muted">Nome:</label>
                    <input class="form-control" type="text" id='nome' name='nome' value=<?php echo $info['nome'];?> readonly>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input ">
                    <label for="cnpj" class="text-muted">CNPJ:</label>
                    <input class="form-control" type="text" id="cnpj" name='cnpj' value=<?php echo $info['cnpj'];?> readonly>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input ">
                    <label for="telefone" class="text-muted">Telefone:</label>
                    <input class="form-control" type="text" id="telefone"  name='telefone' value=<?php echo $info['telefone'];?>>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input">
                    <label for="dataDeAbertura" class="text-muted">Data de Abertura:</label>
                    <input class="form-control" type="date" id="dataDeAbertura"  name='dataDeAbertura' value=<?php echo $info['dataDeAbertura'];?>>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input ">
                    <label for="endereco" class="text-muted">Endereço:</label>
                    <input class="form-control" type="text" id="endereco"  name='endereco' value=<?php echo $info['endereco'];?>>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input ">
                    <label for="conveniosAceitos" class="text-muted">Convênios aceitos:</label>
                    <input class="form-control" type="text" id="conveniosAceitos" name='conveniosAceitos' value=<?php echo $info['conveniosAceitos'];?>>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input ">
                    <label for="email" class="text-muted">Email:</label>
                    <input class="form-control" type="text" id="email" name='email' value=<?php echo $info['email'];?> required>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input ">
                    <label for="novaSenha" class="text-muted">Nova senha:</label>
                    <input class="form-control" type="password" id="novaSenha" name='novaSenha'>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input ">
                    <label for="senha" class="text-muted">Senha:</label>
                    <input class="form-control" type="password" id="senha" name="senha" required>
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn p-b-10 p-t-15">
                    <button type="submit" class="login100-form-btn">
                        Alterar dados
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>