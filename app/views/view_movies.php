<?php
    require('../models/movies.php');
    $getLastId = new Movie();
?>

<?php
    //Guardar pelicula
    if(!empty($_POST['movie_name'])
    and !empty($_POST['author'])
    and !empty($_POST['summary'])
    and !empty($_POST['type'])){
        $subtitle =  isset( $_POST['subtitle']) ? '1' : '0';

        $movieObj = new Movie();
        $is_created = $movieObj->insertMovie($_POST['languaje'], $subtitle, $_POST['summary'],
        $_POST['author'],  $_POST['time'],  $_POST['type'],  $_POST['movie_name']);
        echo "<script>alert('".$is_created."');</script>";
    }

    //Mostrar peliculas
    $movieObj = new Movie();
    $listMovies = $movieObj->getAllMovies();
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
                    <a href="view_products.php" class="side-option">
                        <p>Productos</p>
                    </a>
                    <a href="view_memberships.php" class="side-option">
                        <p>Membresías</p>
                    </a>
                    <a href="#" class="side-option-active">
                        <p>Películas</p>
                    </a>
                </ul>
            </nav>
        </div>
        <!-- Final de Barra de Navegacion -->
        <!-- Contenedor de Formulario -->
        <div class="main-container">
            <div class="box1">
                <h3>Ingresar Datos</h3>
                <div class="form-container">
                    <form action="view_movies.php" method="post">
                        <div class="row box">
                            <div class="line">
                                <p>ID:</p>
                                <input type="text" name="movie_id" id="movie_id" readonly value='<?php echo $getLastId->getCountOfMovie();?>'>
                            </div>
                            <div class="column">
                                <p>Lenguaje:</p>
                                <select name="languaje" id="languaje">
                                    <option value="ENG" selected>Ingles</option>
                                    <option value="ESP">Español</option>
                                    <option value="ZH">Mandarin</option>
                                    <option value="JAP">Japones</option>
                                </select>
                            </div>
                        </div>

                        <div class="column box">
                            <p>Nombre de Pelicula:</p>
                            <input type="text" name="movie_name" id="name">
                        </div>

                        <div class="box line">
                            <p>¿Está subtitulada al Español?</p>
                            <input type="checkbox" name="subtitle" id="subtitle" value="1">
                        </div>

                        <div class="box">
                            <div class="column">
                                <p>Autor:</p>
                                <input type="text" name="author" id="author" >
                            </div>

                            <div class="column">
                                <p>Duración(hrs):</p>
                                <input type="time" max="05:00" min="00:30" name="time" id="time" required>
                            </div>
                        </div>
                        <div class="box line">
                            <p>Genero:</p>
                            <input type="text" name="type" id="type">

                        </div>
                        <p>Sinopsis:</p>
                        <textarea name="summary" id="summary" rows="5"></textarea>

                        <input type="submit" value='Guardar' class="btn button">
                    </form>
                </div>
            </div>
            <div class="box2">
                <h3>Películas Registradas</h3>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Autor</th>
                                <th>Duración</th>
                                <th>Genero</th>
                                <th>Idioma</th>
                                <th>¿Subtitulada?</th>
                            </tr>
                        </thead>
    
                        <tbody>
                            <?php 
                                foreach($listMovies as $row){
                            ?>
    
                                    <tr>
                                        <th><?php echo $row["movie_id"]?></th>
                                        <th><?php echo $row["movie_name"]?></th>
                                        <th><?php echo $row["author"]?></th>
                                        <th><?php echo ($row["hr"]? $row["hr"]:"00").":".($row["mt"]? $row["mt"]:"00") ?></th>
                                        <th><?php echo $row["movie_type"]?></th>
                                        <th><?php echo $row["languaje"]?></th>
                                        <th><?php echo $row["subtitle"]? "Si": "No" ?></th>
                                        <th><a href='view_movies_edit.php?movie_id=<?php echo $row["movie_id"];?>' class="button btn">Editar</a></th>
                                    </tr>
    
                            <?php
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