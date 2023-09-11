<?php
    require('../models/products.php');
    $getLastId = new Product();

    
    //Obtener productos
    $productObj = new Product();
    $listProducts = $productObj->getAllProducts()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles_tables.css">

    <title>CinemaParaiso</title>
</head>
<body>
    <div class="row">
        <div class="sidebar">
            <nav>
                <a href="#"><h1>Adminstración</h1></a>
                <ul>
                    <a href="./view_employes.php" class="side-option">
                        <p>Empleados</p>
                    </a>
                    <a href="./view_products.php" class="side-option">
                        <p>Productos</p>
                    </a>
                    <a href="./view_memberships.php" class="side-option">
                        <p>Membresías</p>
                    </a>
                    <a href="./view_movies.php" class="side-option">
                        <p>Películas</p>
                    </a>
                    <a href="./views_1-N/view_ProductSale.php" class="side-option">
                        <p>Venta de productos</p>
                    </a>
                    <a href="#" class="side-option-active">
                        <p>Edicion de combos</p>
                    </a>
                </ul>
            </nav>
        </div>

        <div class="main-container center">
            <div class="table">
                <h3>Ajustes de combo y edicion de producto</h3>
                <table id="products-table">
                    <thead>
                    <col class="col1"/>
                    <col class="col2"/>
                    <col class="col3"/>
                    <col class="col4"/>
                    <col class="col5"/>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Stock Actual</th>
                            <th>Precio</th>
                        </tr>
                    </thead>

                    <tbody id="detail_products">                            
                        <?php 
                            foreach($listProducts as $row){
                                if($row["is_combo"] == true){ 
                        ?>
                            <tr>
                                <td><?php echo $row["product_id"]?></td>
                                <td><?php echo $row["product_name"]?></td>
                                <td><?php echo $row["stock"]?></td>
                                <td><?php echo "$".$row["price_stock"].".00"?></td>
                                <td><a href='view_combo_edit.php?product_id=<?php echo $row["product_id"];?>' class="button btn">Editar</a></td>
                            </tr>
                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>