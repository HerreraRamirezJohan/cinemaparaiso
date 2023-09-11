<?php
require '../config/connection.php';
    class Movie
    {
        var $movie_id;
        var $languaje;
        var $subtitle;
        var $summary;
        var $author;
        var $movie_img;
        var $movie_time;
        var $movie_type;
        var $movie_name;

        function getCountOfMovie(){
            try{
                $objConnection = new ConnectionPHP();
                $query = "select MAX(movie_id) from movie";
                $stmt = $objConnection->getConnection()->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchColumn() + 1;
                return $result;  
                
            }catch(PDOException $msg){
                echo ('Error: '.$msg->getMessage());
            }
        }
        function insertMovie($languaje, $subtitle, $summary, $author, $movie_time, $movie_type, $movie_name){
            try{
                $objConnection = new ConnectionPHP();
                $query = "INSERT INTO movie(languaje, subtitle, summary, author, movie_time, movie_type, movie_name)
                VALUES ('$languaje', '$subtitle', '$summary', '$author', '$movie_time', '$movie_type', '$movie_name');";
                $stmt = $objConnection->getConnection()->prepare($query);
                $stmt->execute();
                return 'Pelicula guardada exitosamente';
                
            }catch(PDOException $msg){
                return 'Error: '.$msg->getMessage();
            }
        }

        function getAllMovies(){
            try{
                $objConnection = new ConnectionPHP();
                $query = "SELECT movie_id,movie_name,author,EXTRACT(HOUR FROM movie_time) AS hr,
                EXTRACT(MINUTE FROM movie_time) AS mt,movie_type,languaje,subtitle FROM movie;";
                $stmt = $objConnection->getConnection()->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
                
            }catch(PDOException $msg){
                return 'Error: '.$msg->getMessage();
            }
        }
        function getMovie($id){
            try{
                $objConnection = new ConnectionPHP();
                $query = "SELECT * FROM movie WHERE movie_id = :id";
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
        function editMovie($languaje, $subtitle, $summary, $author, $movie_time, $movie_type, $movie_name, $id){
            try{
                $objConnection = new ConnectionPHP();
                $query = "UPDATE movie SET languaje='$languaje', subtitle='$subtitle',summary='$summary',author='$author',
                 movie_time='$movie_time', movie_type='$movie_type', movie_name='$movie_name' WHERE movie_id='$id'";
                $stmt = $objConnection->getConnection()->prepare($query);
                $stmt->execute();

                return "Empleado Editado exitosamente.";
                
            }catch(PDOException $msg){
                return 'Error: '.$msg->getMessage();
            }
        }
    }
?>