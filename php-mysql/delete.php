<?php
ini_set('max_execution_time', '0');
include 'php/connect.php';

$timediffDelete=0;
    
    //bloco de remocao
    $starttimeDelete = microtime(true);
    $sql="SELECT * FROM `students`";
    $ret=mysqli_query($connect,$sql);
    $endtimeDelete = microtime(true);
    $timediffDelete += $endtimeDelete - $starttimeDelete;
    //


echo "\n Delete avg time= ". ($timediffDelete) ."\n";

?>