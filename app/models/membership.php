<?php
require '../config/connection.php';
    class Membership
    {
        var $membership_id;
        var $client_name;
        var $email;
        var $start_date;
        var $end_date;
        var $points;

        function getCountOfMembership(){
            try{
                $objConnection = new ConnectionPHP();
                $query = "select MAX(membership_id) from membership";
                $stmt = $objConnection->getConnection()->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchColumn() + 1;
                return $result;  
                
            }catch(PDOException $msg){
                echo ('Error: '.$msg->getMessage());
            }
        }

        function getMembership($id){
            try{
                $objConnection = new ConnectionPHP();
                $query = "SELECT * FROM membership WHERE membership_id = :id";
                $stmt = $objConnection->getConnection()->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $result = $stmt->fetch();
                #var_dump($result);
                return $result;
            }catch(PDOException $msg){
                echo ('Error: '.$msg->getMessage());
            }
        }
        function insertMembership($name, $email){
            try{
                $objConnection = new ConnectionPHP();
                $query = "INSERT INTO membership(client_name, email) VALUES ('".$name."','".$email."')";
                $stmt = $objConnection->getConnection()->prepare($query);
                $stmt->execute();
                return "Membresia guardada exitosamente.";
                
            }catch(PDOException $msg){
                return 'Error: '.$msg->getMessage();
            }
        }
        function editMembership($name, $_email, $points, $id){
            try{
                $objConnection = new ConnectionPHP();
                $query = "UPDATE membership SET client_name='".$name."', email='".$_email."', points=".$points." WHERE membership_id=".$id;
                $stmt = $objConnection->getConnection()->prepare($query);
                $stmt->execute();

                return "Membresia Editada exitosamente.";
                
            }catch(PDOException $msg){
                return 'Error: '.$msg->getMessage();
            }
        }
    }
?>