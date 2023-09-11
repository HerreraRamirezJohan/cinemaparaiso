<?php
    require("../models/products.php");
    echo json_encode(Product::editCombo($_POST['listProducts'], $_POST['prod']));
?>