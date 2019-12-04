<?php
$host = "localhost";
$user = "root";		
$senha = "";
$banco_dados = "nosql_test";
$connect = mysqli_connect($host, $user, $senha, $banco_dados);
$connect-> set_charset("utf8");
?>