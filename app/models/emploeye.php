<?php
require '../config/connection.php';
    class Employe
    {
        var $employe_rfc;
        var $employe_name;
        var $email;
        var $phone;
        var $start_date;
        var $end_date;

        function getCountOfEmploye(){
            try{
                $objConnection = new ConnectionPHP();
                $query = "select MAX(employe_rfc) from employe";
                $stmt = $objConnection->getConnection()->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchColumn() + 1;
                return $result;  
                
            }catch(PDOException $msg){
                echo ('Error: '.$msg->getMessage());
            }
        }

        function getEmploye($id){
            try{
                $objConnection = new ConnectionPHP();
                $query = "SELECT * FROM employe WHERE employe_rfc = :id";
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
        function insertEmploye($name, $email, $phone){
            try{
                $objConnection = new ConnectionPHP();
                $query = "INSERT INTO employe(employe_name, email, phone) VALUES ('".$name."','".$email."','".$phone."')";
                $stmt = $objConnection->getConnection()->prepare($query);
                $stmt->execute();
                return "Empleado guardado exitosamente.";
                
            }catch(PDOException $msg){
                return 'Error: '.$msg->getMessage();
            }
        }
        function editEmploye($name_employe, $_email, $_phone, $id){
            try{
                $objConnection = new ConnectionPHP();
                $query = "UPDATE employe SET employe_name='".$name_employe."', email='".$_email."', phone='".$_phone."' WHERE employe_rfc=".$id;
                $stmt = $objConnection->getConnection()->prepare($query);
                $stmt->execute();

                return "Empleado Editado exitosamente.";
                
            }catch(PDOException $msg){
                return 'Error: '.$msg->getMessage();
            }
        }
    }
?>