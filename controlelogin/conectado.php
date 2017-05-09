<?php
    include("../config/confloginrel.php");
    session_start();
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    
    $result = pg_query("select usuario.cpf
                          from colaborador 
                         inner join usuario 
                            on colaborador.idusuario = usuario.id
                         where usuario.cpf = '$cpf' AND usuario.senha = '$senha'");
    if (pg_num_rows($result) > 0) {
            $_SESSION['cpf'] = $cpf;
            $_SESSION['senha'] = $senha;
            header('location:../painel.php');

    } else {
        $redirect = "../index.php";
        header("location:$redirect");
    }
?>