<?php
ini_set('max_execution_time', '0');
include 'php/connect.php';
$timediffInsert=0;
//for($t=0;$t<2;$t++){
    //bloco de inserção
    $starttimeInsert = microtime(true);

    for($k=1;$k<1001;$k++){
        for($i=0;$i<1000;$i++){
            $sql="INSERT INTO students (matricula,email) VALUES ('". ($i*$k) ."','". ($k) ."@gmail.com'); ";
            //echo $ret;
            $ret=mysqli_query($connect,$sql);
        }
        
    }
    //echo $sql;
    $endtimeInsert = microtime(true);
    $timediffInsert += $endtimeInsert - $starttimeInsert;

    
//}

echo "\n Insert avg time= ". ($timediffInsert) ."\n";

?>