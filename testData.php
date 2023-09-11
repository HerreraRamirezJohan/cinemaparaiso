<?php 
    $json = '[{"invoice":"1","id":"1","amount":"1","price":"9.99"},{"invoice":"1","id":"4","amount":"1","price":"45.49"}]';
    
    $data = json_decode($json, true);
    echo $data[1]['amount'];
?>