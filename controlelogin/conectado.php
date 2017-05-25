<?php
    include("../config/confloginrel.php");
    session_start();
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    
    $result = pg_query("select usuario.cpf
                          from usuario
                         where usuario.cpf = '$cpf' AND usuario.senha = '$senha'");
    if (pg_num_rows($result) > 0) {
            $_SESSION['cpf'] = $cpf;
            $_SESSION['senha'] = $senha;
            header('location:../painel.php');

    } else {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        $redirect = "../index.php?erro=01";
        header("location:$redirect");
    }
?>