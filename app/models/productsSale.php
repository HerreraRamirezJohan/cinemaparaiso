<?php

use FTP\Connection;

class ProductsSale
{
    var $invoice;
    var $membership_id_fk;
    var $employe_rfc_fk;
    var $sale_date;

    function getCountInvoice()
    {
        require '../../config/connection.php';
        try{
            $objConnection = new ConnectionPHP();
            $query = "select MAX(invoice) from sale_product";
            $stmt = $objConnection->getConnection()->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchColumn() + 1;
            return $result;  
            
        }catch(PDOException $msg){
            echo ('Error: '.$msg->getMessage());
        }
    }

    public static function saveSale($listProducts){
        require('../config/connection.php');
        try{
            $data = json_decode($listProducts, true);
            //Creamos el folio de la venta en DB
            $objConnection = new ConnectionPHP();
            $query = 'INSERT INTO sale_product(employe_rfc_fk) VALUES(1)';
            $stmt = $objConnection->getConnection()->prepare($query);
            $stmt->execute();
            //Guardamos el detalle de la venta
            $query = 'INSERT INTO detail_sale_product VALUES ';
            foreach($data as $product){
                $query .= "(".$product['invoice'].",".$product['id'].",".$product['amount'].",".$product['price']."),";
            }

            $query = rtrim($query, ",");
            $stmt = $objConnection->getConnection()->prepare($query);
            $stmt->execute();
            return "Venta Finalizada.";

        }catch(PDOException $msg){
            return 'Error: '.$msg->getMessage();
        }
    }
}
?>