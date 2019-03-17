<!DOCTYPE html>
<html>
<head>
    <?php
    require('../transicao/session.php');
    require('../transicao/connection.php');
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
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


</div>
</body>
</html>

