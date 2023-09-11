<?php
  $product = [];
  $listProducts = [];

  for($i = 0; $i < 2;$i++){
    $product['id'] = $i+1;
    $product['amount'] = 4;
    $product['price'] = 25; 

    // var_dump($product);
    $listProducts[$i] = $product;
  }

  var_dump($listProducts[0]["id"])
  ?>