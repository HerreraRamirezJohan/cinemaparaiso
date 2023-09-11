<?php
    require("../models/productsSale.php");
    echo json_encode(ProductsSale::saveSale($_POST['listProducts']));
?>