<?php 
    require '../../models/productsSale.php';
    $getLastId = new ProductsSale();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style_1-N.css">

    <title>CinemaParaiso</title>
</head>
<body>
    <div class="row">
        <div class="sidebar">
            <nav>
                <a href="../../../index.php"><h1>Adminstración</h1></a>
                <ul>
                    <a href="../view_employes.php" class="side-option">
                        <p>Empleados</p>
                    </a>
                    <a href="../view_products.php" class="side-option">
                        <p>Productos</p>
                    </a>
                    <a href="../view_memberships.php" class="side-option">
                        <p>Membresías</p>
                    </a>
                    <a href="../view_movies.php" class="side-option">
                        <p>Películas</p>
                    </a>
                    <a href="#" class="side-option">
                        <p>Venta de productos</p>
                    </a>
                    <a href="../view_combos.php" class="side-option">
                        <p>Venta de boletos</p>
                    </a>
                </ul>
            </nav>
        </div>

        <!-- Formulario -->
        <div class="main-container">
            <div class="sub-container">
                <h3>Venta de Dulceria</h3>
                <div class="row">
                    <div class="row">
                        <input type="search" name="search_prod" id="search_prod" placeholder="Buscar por ID" required>
                        <button class="button btn" onclick="app.search(document.getElementById('search_prod').value)">Buscar</button>
                    </div>
                    <!-- Folio de venta -->
                    <p>Folio: </p>
                    <input type="text" name="invoice" id="invoice" readonly value="<?php echo $getLastId->getCountInvoice()?>">
                    <p>Fecha:</p>
                    <input type="text" name="sale_date" id="sale_date" value="" readonly>
                </div>
                <!-- recopilacion de productos de compra-->
                <div class="row">
                    <input type="hidden" id="product_id" name="prodcut_id">
                    <input type="hidden" name="price_stock" id="price_stock">
                    <input type="hidden" name="stock" id="stock">
                    <p>Nombre de producto:</p>
                    <input type="text" name="product_name" id="product_name" readonly>
                    <p>Cantidad:</p>
                    <input type="number" name="cantidad" id="cantidad" min='1' max='10' required value="1">
                    <button class="btn button" type="button" onclick="addProduct()">Agregar producto</button>
                </div>
                <!-- Detalle de compra -->
                <div class="row">
                    <div class="table">
                        <h3>Detalle de compra</h3>
                        <table id="table_detail table">
                            <thead>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                            </thead>
                            <tbody id="detail_sale">
        
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <p>Total: $</p>
                        <input type="number" name="total" id="total" value="0.00" style="height: 2rem;">
                        <div class="box">
                            <button class="btn button" onclick="compleateSale()">Confirmar Orden</button>
                            <button class="btn button" onclick="location.reload()">Cancelar Orden</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Scripts -->
    <script src="../../js/code.js"></script>

    <script>
        //Detectar clics en tabla
        let tabla = document.getElementById('detail_sale');
        tabla.addEventListener("click", deleteRow);

        function deleteRow(e){
            console.log(e);
            if(e.target.matches('.deleteRow')){
                let tIndex = e.target.parentNode.parentNode.rowIndex - 1;
                console.log(tIndex);
                tabla.deleteRow(tIndex);
                getTotalSale();
            }
        }
        //Obtener la fecha actual
        var dateInput = document.getElementById('sale_date');
        var today = new Date();
        var date = today.getDate() + '/' + ( today.getMonth() + 1 ) + '/' + today.getFullYear();
        dateInput.value = date;
        //Agregar productos a la compra

        function compleateSale(){
            app.saveSale(getProductsSold())
            .then((result) => {
                alert(result);
                location.reload();
            }).catch((err) => {
                console.log(err);
            });
        }

        // function removeRow(e){
        //     i
        // }

        function addProduct(){

            let product = getProduct();
            //Verifica si hay productos buscados
            if(product['product_id'] != "" || product['product_id'] != 'undefined'){
                //Verifica que se haya colocada una cantidad
                if(product['cantidad'] != ""){
                    if(productExist(product)){
                        if(Number(product['cantidad']) <= Number(product['stock'])){
                            addToTable(product);
                        }else{
                            alert('La cantidad solicitada excede nuestro inventario o el producto no existe.');
                        }
                    }
                }
                else{
                    alert('Especifique cantidad deseada.')
                }
            }
            else{
                alert('No se a buscado ningun producto');
            }
            
        }
        //Obtener productos vendidos
        function getProductsSold(){
            let table = document.getElementById('detail_sale');
            let filas = table.getElementsByTagName('tr');
            
            
            var productsList = [];

            for(let i = 0; i < filas.length; i++){
                let product = {}
                product['invoice'] = document.getElementById('invoice').value;
                product['id'] = table.rows[i].cells[0].innerHTML;
                product['amount'] = table.rows[i].cells[2].innerHTML;
                product['price'] = table.rows[i].cells[3].innerHTML;
                productsList.push(product);
            }
            console.log(productsList);
            return productsList;
        }

        function productExist(product){
            let tabla = document.getElementById('detail_sale');
            let filas = tabla.getElementsByTagName('tr'); 
            
            if(filas.length != 0){
                for(let i = 0, cell; i < filas.length; i++){
                    cell = tabla.rows[i].cells[0]; //nos movemos en cada fila y obtenemos ID
                    oldAmount = tabla.rows[i].cells[2].innerHTML;//nos movemos en cada fila y obtenemos cantidad solicitada
                    if(cell.innerHTML == product['product_id']){//Validamos si el producto ya fue registrado
                        newAmount = Number(product['cantidad'])+Number(oldAmount)
                        if(newAmount <= product['stock']){
                            tabla.rows[i].cells[2].innerHTML = newAmount;
                            tabla.rows[i].cells[4].innerHTML = Number(tabla.rows[i].cells[2].innerHTML * tabla.rows[i].cells[3].innerHTML).toFixed(2);
                            getTotalSale();
                            return false;
                        }else{
                            alert('Cantidad insuficiente en stock para agregar al pedido.\n' + 
                            'Producto restante = '+ (Number(product['stock']) - Number(oldAmount)));
                            return false;
                        }

                    }
                }
            }
            return true;
            
        }
        function getTotalSale(){
            var tabla = document.getElementById('detail_sale');
            let filas = tabla.getElementsByTagName('tr');

            var total = 0;
            for(let i = 0; i < filas.length; i++){
                var celda = tabla.rows[i].cells[4];
                total+=parseFloat(celda.innerHTML);
            }

            let inputTotal = document.getElementById('total');
            inputTotal.value = total.toFixed(2);

        }

        function addToTable(product){
            var table = document.getElementById('detail_sale');
            var newRow = table.insertRow(-1);

            col_id = newRow.insertCell(0);
            col_id.innerHTML = product['product_id'];

            col_name = newRow.insertCell(1);
            col_name.innerHTML = product['product_name'];

            col_cantidad = newRow.insertCell(2);
            col_cantidad.innerHTML = Number(product['cantidad']);

            col_precio = newRow.insertCell(3);
            col_precio.innerHTML = Number(product['price']).toFixed(2);

            col_subtotal = newRow.insertCell(4);
            col_subtotal.innerHTML = (col_cantidad.innerHTML * col_precio.innerHTML).toFixed(2);

            col_btn_remove = newRow.insertCell(5);
            col_btn_remove.innerHTML = "<input type='button' value='Eliminar' class='btn button deleteRow' style='background-color:red;margin:0'></input>"

            getTotalSale();
        }
        function getProduct(){
            var product = [];
            product['product_name'] = document.getElementById('product_name').value;
            product['product_id'] = document.getElementById('product_id').value;
            product['price'] = document.getElementById('price_stock').value;
            product['stock'] = document.getElementById('stock').value;
            product['cantidad'] = document.getElementById('cantidad').value;
            return product;
        }
    </script>
</body>
</html>