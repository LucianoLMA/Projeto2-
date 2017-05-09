<?php
session_start();
if ($_SESSION['cpf'] == null) {
    header('location:index.php');
}
?>