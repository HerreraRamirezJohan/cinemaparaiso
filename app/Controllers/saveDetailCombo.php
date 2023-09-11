<?php
    require("../models/products.php");
    echo json_encode(Product::saveCombo($_POST['listProducts'], $_POST['prod']));
?>