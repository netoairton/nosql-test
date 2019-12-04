<?php
ini_set('max_execution_time', '0');
include 'php/connect.php';

$timediffSelect=0;
//for($t=0;$t<2;$t++){
    
    //bloco de seleção
    $starttimeSelect = microtime(true);
    $sql="SELECT * FROM `students`";
    $ret=mysqli_query($connect,$sql);
    $endtimeSelect = microtime(true);
    $timediffSelect += $endtimeSelect - $starttimeSelect;
    //
    
//}
echo "\n Select avg time= ". ($timediffSelect) ."\n";

?>