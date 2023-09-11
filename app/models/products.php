<?php 
require '../config/connection.php';

class Product
{
    var $product_id;
    var $product_name;
    var $price_stock;
    var $stock;

    function getCountOfProduct()
    {
        try{
            $objConnection = new ConnectionPHP();
            $query = "select MAX(product_id) from product";
            $stmt = $objConnection->getConnection()->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchColumn() + 1;
            return $result;  
            
        }catch(PDOException $msg){
            echo ('Error: '.$msg->getMessage());
        }
    }

    function getDetailCombo($id){
        try{
            $objConnection = new ConnectionPHP();
            $query = "SELECT * FROM combo WHERE product_combo_id_fk=$id";
            $stmt = $objConnection->getConnection()->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            
        }catch(PDOException $msg){
            return 'Error: '.$msg->getMessage();
        }
    }

    public static function editCombo($listProducts, $prod){
        try{
            $objConnection = new ConnectionPHP();
            $data = json_decode($listProducts, true);
            $baseProduct = json_decode($prod, true);
            $objConnection = new ConnectionPHP();
            $baseProduct = json_decode($prod, true);
            $query1 = " UPDATE product SET product_name='".$baseProduct['name']."',price_stock=".$baseProduct['price'].",".
            "stock=".$baseProduct['stock']." WHERE product_id=".$data[0]['id_combo'];
            
            $stmt = $objConnection->getConnection()->prepare($query1);
            $stmt->execute();

            //eliminamos los datos del combo
            $query2 = 'DELETE FROM combo where product_combo_id_fk='.$data[0]['id_combo'];
            $stmt = $objConnection->getConnection()->prepare($query2);
            $stmt->execute();

            //Guardamos el detalle de la venta
            $query = 'INSERT INTO combo VALUES ';
            foreach($data as $product){
                $query .= "(".$product['id_product_fk'].",".$product['id_combo'].",".$product['cantidad']."),";
            }

            $query = rtrim($query, ",");
            $stmt = $objConnection->getConnection()->prepare($query);
            $stmt->execute();
            return "Combo editado exitosamente";
        }catch(Error $err){
            return 'ERROR: '.$err;
        }
    }
    
    public static function saveCombo($listProducts, $prod){
        try{
            $objConnection = new ConnectionPHP();
            $data = json_decode($listProducts, true);
            $baseProduct = json_decode($prod, true);
            
            $query1 = "INSERT INTO product(product_name, price_stock, stock, is_combo) 
            VALUES ('".$baseProduct['name']."',".$baseProduct['price'].",".$baseProduct['stock'].",".$baseProduct['is_combo'].");";
            $stmt = $objConnection->getConnection()->prepare($query1);
            $stmt->execute();



            //Guardamos el detalle de la venta
            $query = 'INSERT INTO combo VALUES ';
            foreach($data as $product){
                $query .= "(".$product['id_product_fk'].",".$product['id_combo'].",".$product['cantidad']."),";
            }

            $query = rtrim($query, ",");
            $stmt = $objConnection->getConnection()->prepare($query);
            $stmt->execute();
            return "Combo guardado exitosamente";
        }catch(Error $err){
            return 'ERROR: '.$err;
        }
    }

    public static function insertProduct($prod)
    {
        try{
            $objConnection = new ConnectionPHP();
            $baseProduct = json_decode($prod, true);
            $query1 = "INSERT INTO product(product_name, price_stock, stock, is_combo) 
            VALUES ('".$baseProduct['name']."',".$baseProduct['price'].",".$baseProduct['stock'].",".$baseProduct['is_combo'].");";
            $stmt = $objConnection->getConnection()->prepare($query1);
            $stmt->execute();

            return 'Producto guardada exitosamente';
            
        }catch(PDOException $msg){
            return 'Error: '.$msg->getMessage();
        }
    }

    public static function getAllProducts()
    {
        try{
            $objConnection = new ConnectionPHP();
            $query = "SELECT * FROM product";
            $stmt = $objConnection->getConnection()->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            
        }catch(PDOException $msg){
            return 'Error: '.$msg->getMessage();
        }
    }

    function editProduct($id, $name, $price, $amount){
        try{
            $objConnection = new ConnectionPHP();
            $query = "UPDATE product SET product_name='$name', price_stock=$price, stock=$amount 
            WHERE product_id=$id";
            $stmt = $objConnection->getConnection()->prepare($query);
            $stmt->execute();

            return "Producto Editado exitosamente.";
            
        }catch(PDOException $msg){
            return 'Error: '.$msg->getMessage();
        }
    }

    public static function getProduct($id)
    {
        try{
            $objConnection = new ConnectionPHP();
            $query = "SELECT * FROM product WHERE product_id = :id";
            $stmt = $objConnection->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch();
            // var_dump($result);
            return $result;
        }catch(PDOException $msg){
            echo ('Error: '.$msg->getMessage());
        }
    }
}
?>