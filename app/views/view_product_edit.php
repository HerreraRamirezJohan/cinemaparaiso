<?php 
    require('../models/products.php');

    $productObj = new Product();

    if(isset($_POST['product_id'])){

        $msg = $productObj->editProduct($_POST['product_id'], $_POST['product_name'],
        $_POST['price_stock'], $_POST['stock']);
        echo "<script>alert('".$msg."');</script>";
    }
    //Colocar id de busqueda
    $myProduct = $productObj->getProduct($_GET['product_id'])
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
        <!-- Barra de navegacion -->
        <div class="sidebar">
            <nav>
                <a href="../../index.php"><h1>Adminstración</h1></a>
                <ul>
                    <a href="view_employes.php" class="side-option">
                        <p>Empleados</p>
                    </a>
                    <a href="#" class="side-option-active">
                        <p>Productos</p>
                    </a>
                    <a href="view_memberships.php" class="side-option">
                        <p>Membresías</p>
                    </a>
                    <a href="view_movies.php" class="side-option">
                        <p>Películas</p>
                    </a>
                </ul>
            </nav>
        </div>

        <div class="main-container center">
            <div class="form-container">
                <h3>Ingresar Datos</h3>
                <form action="./view_product_edit.php?product_id=<?php echo $_GET['product_id'];?>" method="post">
                    <div class="line">
                        <p class="big">ID: </p>
                        <input type="text" name="product_id" id="product_id" readonly value="<?php echo $myProduct['product_id'];?>">
                    </div>
                    <div class="box line-bottom">
                        <p>Nombre de producto</p>
                        <input type="text" name="product_name" id="product_name" required value="<?php echo $myProduct['product_name'];?>">
                    </div>
                    <div class="box line-bottom">
                        <p>Precio de Stock</p>
                        $<input type="number" name="price_stock" id="price_stock" step=".01" min="0.01" required value="<?php echo $myProduct['price_stock'];?>">
                    </div>
                    <div class=" line box line-bottom">
                        <p>Cantidad almacenada: </p>
                        <input type="number" name="stock" id="stock" required value="<?php echo $myProduct['stock'];?>">
                    </div>
                    
                    <div class="row">
                        <a href="./view_products.php" class="btn button">Regresar</a>
                        <button class="btn button" type="submit" id="save_prod">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>