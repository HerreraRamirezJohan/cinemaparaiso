<?php
    require("../models/products.php");
    echo json_encode(Product::insertProduct($_POST['prod']));
?>