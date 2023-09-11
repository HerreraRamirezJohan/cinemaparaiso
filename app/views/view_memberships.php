<?php
    require '../models/membership.php';

    $objMembership = new Membership();
?>

<?php
    if(!empty($_POST['client_name']) && !empty($_POST['email'])){
        $membershipObj = new Membership();
        $is_created = $membershipObj->insertMembership($_POST['client_name'], $_POST['email']);
        echo "<script>alert('".$is_created."');</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">

    <title>CinemaParaiso</title>
</head>
<body>
    <!-- Barra de navegacion -->
    <div class="row gap">
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
                    <a href="#" class="side-option-active">
                        <p>Membresías</p>
                    </a>
                    <a href="view_movies.php" class="side-option">
                        <p>Películas</p>
                    </a>
                </ul>
            </nav>
        </div>

        <div class="container-form">
            <h3>Ajustes de empleados</h3>
            <!-- formulario de busqueda -->
            <form action="./view_memberships_search.php" method="get">
                <div class="row">
                    <input type="text" name="search-bar" id="search-bar" placeholder="Buscar ID de Membresia">
                    <input type="submit" value="Buscar" class="button">
                </div>
            </form>
                <form action="./view_memberships.php" name="employe-form" method="post">
                    <!-- Acomodo de formulario -->
                    <div class="row">
                        <div class="column">
                            <p>ID de la Membresía:</p> 
                            <input type="text" name="membership_id" placeholder="ID Membresia" id="membership_id" disabled value=<?php echo $objMembership->getCountOfMembership()?>>
                        </div>
                        <div class="column">
                            <p>Nombre del cliente:</p>
                            <input type="text" name="client_name" placeholder="Nombre Completo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <p>Correo:</p>
                            <input type="text" name="email" placeholder="Correo Electronico">
                        </div>
                        <div class="column">
                            <p>Puntos por nuevo cliente:</p>
                            <input type="number" name="points" id="points" placeholder="Puntos" disabled value='20'>
                        </div>
                    </div>

                    <input type="submit" class="button" value="Guardar">
                </form>
        </div>
    </div>
    
</body>
</html>