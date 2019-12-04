<?php
ini_set('max_execution_time', '0');
include 'php/connect.php';
/* $host = "localhost";
$user = "root";		
$senha = "";
$banco_dados = "nosql_test";
$connect = new mysqli($host, $user, $senha, $banco_dados);
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
} */

$timediffInsert=0;
for($t=0;$t<2;$t++){
    //bloco de inserção
    $starttimeInsert = microtime(true);

    for($k=1;$k<1001;$k++){
        for($i=0;$i<1000;$i++){
            $stmt = $connect->prepare("INSERT INTO students (matricula,email) VALUES (?, ?)");
            $stmt->bind_param("ss", $matricula, $email);
            $matricula=$i*$k;
            $email=$k."@gmail.com";
            $stmt->execute();
            //echo $ret;
            //$ret=mysqli_query($connect,$sql);
        }
        
    }
    //echo $sql;
    $endtimeInsert = microtime(true);
    $timediffInsert += $endtimeInsert - $starttimeInsert;
}
    //

echo "\n Insert avg time= ". ($timediffInsert/2) ."\n";
$stmt->close();
$connect->close();
?>