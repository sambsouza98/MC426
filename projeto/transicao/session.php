<?php
session_start();
if(!isset($_SESSION['tipoUsuario'])){
    header('Location: ../index.php');
}