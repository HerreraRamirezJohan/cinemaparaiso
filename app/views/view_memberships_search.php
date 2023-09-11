<?php
    require '../models/membership.php';

    $objMembership = new Membership();
    $membershipSerch = $objMembership->getMembership($_GET['search-bar']);
?>
<script>
    function activateFormToEdit(){
        var inputName = document.getElementById('client_name');
        var inputEmail = document.getElementById('email');
        var inputPoints = document.getElementById('point');
        var btnSave = document.getElementById('btnSave');

        inputName.disabled = false;
        inputEmail.disabled = false;
        inputPoints.disabled = false;
        btnSave.disabled = false;
    }
</script>
<!-- Actualizar un dato -->
<?php
    if(!empty($_POST['client_name']) && !empty($_POST['email']) && !empty($_POST['points'])){
        $membershipObj = new Membership();
        $is_created = $membershipObj->editMembership($_POST['client_name'], $_POST['email'], $_POST['points'], $_POST['membership_id']);
        //echo $is_created;
        header('Location:'.'./view_memberships.php');
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
                    <a href="./view_employes.php" class="side-option">
                        <p>Empleados</p>
                    </a>
                    <a href="view_products.php" class="side-option">
                        <p>Productos</p>
                    </a>
                    <a href="view_memberships.php" class="side-option-active">
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
            <div class="row">
                <form action="./view_memberships_search.php" method="get">
                    <div class="row">
                        <input type="text" name="search-bar" id="search-bar" placeholder="Buscar ID de Membresia">
                        <input type="submit" value="Buscar" class="button" id="btn-search">
                        <a href="./view_memberships.php" class="button btn">Cancelar</a>
                    </div>
                </form>
                <button class="button btn" onclick="activateFormToEdit()" >Editar</button>
            </div>
                <!-- Formulario de empleado -->
            <form action="./view_memberships_search.php" name="employe-form" method="post">
                    <!-- Acomodo de formulario -->
                    <div class="row">
                        <div class="column">
                            <p>ID de la Membresía:</p> 
                            <input type="text" name="membership_id" id="membership_id" placeholder="ID Membresia" readonly value=<?php echo $membershipSerch[0]?>>
                        </div>
                        <div class="column">
                            <p>Nombre del cliente:</p>
                            <input type="text" name="client_name" id="client_name" placeholder="Nombre Completo" disabled value='<?php echo $membershipSerch[1]?>'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <p>Correo:</p>
                            <input type="text" name="email" id="email" placeholder="Correo Electronico" disabled value=<?php echo $membershipSerch[2]?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <p>Puntos Actuales:</p>
                            <input type="number" name="points" id="point" placeholder="Puntos" disabled value=<?php echo $membershipSerch[5]?>>
                        </div>
                        <div class="column">
                            <p>Fecha de Registro</p>
                            <input type="text" name="start_date" id="star_date" readonly value=<?php echo $membershipSerch[3]?>>
                        </div>
                    </div>

                    <input type="submit" class="button" id="btnSave" value="Guardar" disabled>
            </form>
        </div>
    </div>
    
    
    
</body>
</html>