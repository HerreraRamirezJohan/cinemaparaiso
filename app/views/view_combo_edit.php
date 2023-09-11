<?php
    require('../models/products.php');
    
    //Obtener todos los productos que pueden integrar al combo
    $productObj = new Product();
    $listProducts = $productObj->getAllProducts();

    //Colocar id de busqueda
    $myProduct = $productObj->getProduct($_GET['product_id']);

    //Obtenemos el detalle del combo
    $detailCombo = $productObj->getDetailCombo($_GET['product_id']);
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

        <div class="main-container">
            <div class="box1">
                <h3>Producto en Edicion</h3>
                <div class="form-container">
                    <form>
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

                        <div class="box line">
                            <p>¿Es Combo?</p>
                            <input type="checkbox" name="combo" id="combo" value="1" disabled checked>
                        </div>
                        <div class="row">
                            <a href="./view_combos.php" class="btn button" style="padding: 0 1rem; margin: 0">Regresar</a>
                            <button class="btn button" style="margin-top: 2rem" id="save_prod" onclick="editProduct_Combo()">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="center">
                <h3>Detalle de combo</h3>
                <div class="table">
                    <table id="products-table">
                        <thead>
                        <col class="col1"/>
                        <col class="col2"/>
                        <col class="col3"/>
                        <col class="col4"/>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
    
                        <tbody id="detail_products">                            
                            <?php 
                                foreach($listProducts as $row){
                                    if($row["is_combo"] == false){ 
                            ?>
                                <tr>
                                    <td><?php echo $row["product_id"]?></td>
                                    <td><?php echo $row["product_name"]?></td>
                                    <td>
                                        <input type="number" name="amount" id="amount" value=
                                            <?php 
                                                foreach($detailCombo as $productCombo){
                                                    if($productCombo['product_id_fk'] == $row["product_id"]){
                                                        echo '"'.$productCombo['amount'].'"';
                                                    }
                                                }
                                            ?>
                                        >
                                    </td>
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
    </div>
    

</body>
</html>
<script src="../js/combo.js"></script>
<script>
    //validacion numeros negativos
    function editProduct_Combo(){
        let checkbox = document.getElementById('combo');
        if(checkbox.checked){
            if(Object.entries(getProd()).length === 0){
                alert('Favor de ingresar datos al producto.');
            }else{
                myCombo = getProducts();
                if(myCombo.length >= 2){
                    saveCombo(myCombo, getProd());

                }else{
                    alert('2 Productos distintos mimimos para generar un combo.')
                }
            }
        }else{
            if(Object.entries(getProd()).length === 0){
                alert('Favor de ingresar datos al producto');
            }else{
                comboApp.editProduct(getProd())
                .then((result) => {
                    alert(result);
                }).catch((err) => {
                    console.log(err);
                });
            }
        }
    }
    function saveCombo(listProducts, prod){
        comboApp.editCombo(listProducts, prod)
        .then((result) => {
            debugger;
            alert(result);
        }).catch((err) => {
            console.log(err);
        });
    }
    function getProd(){
        prod = {};
        name = document.getElementById('product_name').value;
        price = document.getElementById('price_stock').value;
        stock = document.getElementById('stock').value;
        if(name != '' && price !='' && stock != ''){
            prod['name'] = name;
            prod['price'] = price;
            prod['stock'] = stock;

            let checkbox = document.getElementById('combo');
            if(checkbox.checked){
                prod['is_combo'] = 'true';
            }else{
                prod['is_combo'] = 'false';
            }
        }

        return prod;
    }
    
    function getProducts(){
        let tabla = document.getElementById('detail_products');
        let rows = tabla.getElementsByTagName('tr');

        var productsList = [];

            for(let i = 0; i < rows.length; i++){
                cantidadObj = tabla.rows[i].cells[2];
                amount = cantidadObj.getElementsByTagName('input')[0].value;
                
                if(amount > 0){
                    let product = {};
                    product['id_product_fk'] = tabla.rows[i].cells[0].innerHTML;
                    
                    product['cantidad'] = amount;
    
                    product['id_combo'] = document.getElementById('product_id').value;
                    productsList.push(product);
                }
            }
        return productsList;
    }
</script>