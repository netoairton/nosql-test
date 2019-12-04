<?php

$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 500);
$timediffInsertion=0;$timediffDelete=0;$timediffUpdate=0;$timediffSelect=0;
//$document1 = ['matricula'=>0,'email'=>'55@gmail.com'];
for($k=1;$k<3;$k++){

    //bloco de inserção
    $starttimeInsertion = microtime(true);
    $bulk = new MongoDB\Driver\BulkWrite;
    for($i=0;$i<1000;$i++){
        for($j=0;$j<1000;$j++){
            $doc= ['matricula'=> $i*$k,'email'=>($j*$k).'@gmail.com'];
            $bulk->insert($doc);
        }
    }
    $result = $manager->executeBulkWrite('nosql-test.students', $bulk, $writeConcern);
    printf("\nInserted %d document(s)\n", $result->getInsertedCount());
    $endtimeInsertion = microtime(true);
    $timediffInsertion += $endtimeInsertion - $starttimeInsertion;
    //
    //bloco de atualização
    $starttimeUpdate = microtime(true);
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update(
        [],
        ['matricula' => rand(0,1000), 'email' => ''.rand(0,1000).'@gmail.com'],
        ['multi'=>true]
    );
    $result = $manager->executeBulkWrite('nosql-test.students', $bulk);
    printf("\nUpdated  %d document(s)\n", $result->getModifiedCount());
    $endtimeUpdate = microtime(true);
    $timediffUpdate += $endtimeUpdate - $starttimeUpdate;
    //
    //bloco de selecao
    $starttimeSelect = microtime(true);
    $filter = [];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $manager->executeQuery('nosql-test.students', $query);

    $count=0;
    foreach($cursor as $document){
        ++$count;
        if($count>20){break;}
        $document = json_decode(json_encode($document),true);
        echo "\n".$document['matricula']." / ".$document['email'];
    }
    $endtimeSelect = microtime(true);
    $timediffSelect += $endtimeSelect - $starttimeSelect;
    //
    //bloco de remocao
    $starttimeDelete = microtime(true);
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete([]);
    $result = $manager->executeBulkWrite('nosql-test.students', $bulk);
    $endtimeDelete = microtime(true);
    $timediffDelete += $endtimeDelete - $starttimeDelete;
    //
}
echo "\n Insertion Avg Time= ".($timediffInsertion/2)." \n";
echo "\n Update Avg Time= ".($timediffUpdate/2)." \n";
echo "\n Select Avg Time= ".($timediffSelect/2)." \n";
echo "\n Delete Avg Time= ".($timediffDelete/2)." \n";

?>