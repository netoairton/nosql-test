<?php
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
   
$filter = [];
$options =[
    'projection' => [
        'email' => 1
    ],
];
$query = new MongoDB\Driver\Query($filter,$options);
$cursor = $manager->executeQuery('nosql-test.students', $query);

//print_r($cursor->toArray());
foreach($cursor as $document){
    $document = json_decode(json_encode($document),true);
    echo "\n".$document['email'];
}
echo "\n\n";
?>