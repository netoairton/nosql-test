<?php
ini_set('max_execution_time', '0');
include 'php/connect.php';
$timediffUpdate=0;
    
    //bloco de update
    $starttimeUpdate = microtime(true);
    $sql="UPDATE students SET matricula=FLOOR(RAND()*(100-1+1)+1), email=CONCAT(FLOOR(RAND()*(100-1+1)+1),'@gmail.com') WHERE 1";
    $ret=mysqli_query($connect,$sql);
    $endtimeUpdate = microtime(true);
    $timediffUpdate += $endtimeUpdate - $starttimeUpdate;
    //


echo "\n Update avg time= ". ($timediffUpdate) ."\n";

?>