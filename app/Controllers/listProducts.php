<?php 
    require("../models/products.php");
    echo json_encode(Product::getAllProducts());
?>