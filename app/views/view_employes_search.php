<?php
    require '../models/emploeye.php';

    $objEmploye = new Employe();
    $employeSerch = $objEmploye->getEmploye($_GET['search-bar']);
?>
<script>
    function activateFormToEdit(){
        var inputName = document.getElementById('employe_name');
        var inputEmail = document.getElementById('email');
        var inputphone = document.getElementById('phone');
        var btnSave = document.getElementById('btnSave');

        inputName.disabled = false;
        inputEmail.disabled = false;
        inputphone.disabled = false;
        btnSave.disabled = false;
    }
</script>
<!-- Actualizar un dato -->
<?php
    if(!empty($_POST['employe_name']) && !empty($_POST['email']) && !empty($_POST['phone'])){
        $employeObj = new Employe();
        $is_created = $employeObj->editEmploye($_POST['employe_name'], $_POST['email'], $_POST['phone'], $_POST['rfc']);
        header('Location:'.'./view_employes.php');
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
                    <a href="./view_employes.php" class="side-option-active">
                        <p>Empleados</p>
                    </a>
                    <a href="view_products.php" class="side-option">
                        <p>Productos</p>
                    </a>
                    <a href="view_memberships.php" class="side-option">
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
                <form action="./view_employes_search.php" method="get">
                    <div class="row">
                        <input type="text" name="search-bar" id="search-bar" placeholder="Buscar por RFC">
                        <input type="submit" value="Buscar" class="button" id="btn-search">
                        <a href="./view_employes.php" class="button btn">Cancelar</a>
                    </div>
                </form>
                <button class="button btn" onclick="activateFormToEdit()" >Editar</button>
            </div>
                <!-- Formulario de empleado -->
            <form action="./view_employes_search.php" name="employe-form" method="post">
                <!-- Acomodo de formulario -->
                <div class="row">
                    <div class="column">
                        <p>RFC:</p> 
                        <input type="text" name="rfc" id="rfc" placeholder="RFC" readonly value=<?php echo $employeSerch[0]; ?>>
                    </div>
                    <div class="column">
                        <p>Nombre de empleado:</p>
                        <input type="text" name="employe_name" id="employe_name" placeholder="Nombre Completo" disabled value='<?php echo $employeSerch[1]; ?>'>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <p>Correo:</p>
                        <input type="text" name="email" id="email" placeholder="Correo Electronico" disabled value=<?php echo $employeSerch[2]; ?>>
                    </div>
                    <div class="column">
                        <p>Número de Teléfono:</p>
                        <input type="tel" name="phone" id="phone" placeholder="Número Teléfonico" disabled value=<?php echo $employeSerch[3]; ?>>
                    </div>
                </div>

                <input type="submit" class="button" value="Guardar" id="btnSave" disabled>
            </form>
        </div>
    </div>
    
    
    
</body>
</html>