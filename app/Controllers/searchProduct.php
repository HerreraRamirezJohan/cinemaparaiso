<?php 
    require("../models/products.php");
    echo json_encode(Product::getProduct($_POST['id']));
?>