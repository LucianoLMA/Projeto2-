<?php
$host = "localhost";
$port = "5432";
$db = "locadoraveiculos";
$user = "postgres";
$pass = "masterkey";

$conxao = "host='$host' port='$port' dbname='$db' user='$user' password='$pass'";
$con = pg_connect($conxao);
?>