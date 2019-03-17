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

<div style="width: 100%; background-color: lightseagreen; text-align: right">
    <form action="hospital_medicos.php" style=" display:inline-block">
        <button type="submit" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Médicos
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
    <form id="contact" method="post" action="../transicao/hospital_adiciona_medico_processamento.php">
        <h3>Cadastro Médico</h3>
        <label for="crm">CRM</label>
        <input type="text" name="crm" id="crm">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome">
        <label for="cpf">CPF</label>
        <input type="text" name="cpf" id="cpf">
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <label for="senha">Senha</label>
        <input type="text" name="senha" id="senha">
        <button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>

    </form>
</div>
</body>
</html>