<?php 

include("class_diplomskiRadovi.php");
include("curl.php");


$firstObject = new diplomskiRadovi($data["oib"], $data["text"], $data["link"], $data["title"]);
echo print_r($firstObject, true);
    
   
$titles = $dom->find('.fusion-post-content-container p');
$articleNumber = count($titles);

$firstObject->save($articleNumber);

$firstObject->read();
    

?>