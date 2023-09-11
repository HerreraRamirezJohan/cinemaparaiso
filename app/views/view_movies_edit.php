<?php 
    require('../models/movies.php');

    $movieObj = new Movie();

    if(isset($_POST['movie_id'])){
        $subtitle =  isset( $_POST['subtitle']) ? '1' : '0';

        $msg = $movieObj->editMovie($_POST['languaje'], $subtitle, $_POST['summary'],
        $_POST['author'],  $_POST['time'],  $_POST['type'],  $_POST['movie_name'], $_POST['movie_id']);
        echo "<script>alert('".$msg."');</script>";
    }
    //Colocar id de busqueda
    $myMovie = $movieObj->getMovie($_GET['movie_id'])
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles_tables.css">
    <title>Edicion de Pelicula</title>
</head>
<body>
    <div class="main-container  center">
        <div class="form-container">
            <h3>Editar Pelicula</h3>
            <form action="./view_movies_edit.php?movie_id=<?php echo $_GET["movie_id"];?>" method="post">
                <div class="row box">
                    <div class="line">
                        <p>ID:</p>
                        <input type="text" name="movie_id" id="movie_id" readonly value='<?php echo $_GET["movie_id"];?>'>
                    </div>
                    <div class="column">
                        <p>Lenguaje:</p>
                        <select name="languaje" id="languaje">
                            <option value="ENG"<?php echo $myMovie[1]=='ENG' ? 'selected':'' ?>>Ingles</option>
                            <option value="ESP"<?php echo $myMovie[1]=='ESP' ? 'selected':'' ?>>Español</option>
                            <option value="ZH"<?php echo $myMovie[1]=='ZH' ? 'selected':'' ?>>Mandarin</option>
                            <option value="JAP"<?php echo $myMovie[1]=='JAP' ? 'selected':'' ?>>Japones</option>
                        </select>
                    </div>
                </div>

                <div class="column box">
                    <p>Nombre de Pelicula:</p>
                    <input type="text" name="movie_name" id="name" value="<?php echo $myMovie[8]?>">
                </div>

                <div class="box line">
                    <p>¿Está subtitulada al Español?</p>
                    <input type="checkbox" name="subtitle" id="subtitle" value="1" <?php echo $myMovie[2] ? 'checked':'' ?>>
                </div>

                <div class="box">
                    <div class="column">
                        <p>Autor:</p>
                        <input type="text" name="author" id="author" value="<?php echo $myMovie[4]?>">
                    </div>

                    <div class="column">
                        <p>Duración(hrs):</p>
                        <input type="time" value="<?php echo $myMovie[6] ?>" max="05:00" min="00:30" value="120" name="time" id="time" required >
                    </div>
                </div>
                <div class="box line">
                    <p>Genero:</p>
                    <input type="text" name="type" id="type" value="<?php echo $myMovie[7]?>">

                </div>
                <p>Sinopsis:</p>
                <textarea name="summary" id="summary" rows="5"><?php echo $myMovie[3]?></textarea>

                <div class="row">
                    <a href="./view_movies.php" class="btn button">Regresar</a>
                    <input type="submit" value='Guardar' class="btn button"></input>
                </div>
            </form>
        </div>
    </div>
</body>
</html>