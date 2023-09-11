<?php
    class ConnectionPHP
    {
        function getConnection(){
            $host = "localhost";
            $dbname = "cinemaparaiso";
            $username = "postgres";

            $password = "Poyo13501j#";
            //$password = "Johan2001p#";
            try {
                $conn = new PDO ("pgsql:host= $host; dbname=$dbname", $username, $password);
                return $conn;
                echo("Conexion exitosa");
            }
            catch(PDOException $exp){
                echo ("Conexion Fallida".$exp->getMessage());
            }
        }
    }
?>