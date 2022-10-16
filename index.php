<?php 
    include 'clases.php';
    $mensajeCli = "";
    $mensajeEmp = "";
    if(isset($_POST['clinom']) && $_POST['clinom'] != ""){
        $clinom = $_POST['clinom'];
        $cliape = $_POST['cliape'];
        $clidni = $_POST['clidni'];
        $clidire = $_POST['clidire'];
        $clitel = $_POST['clitel'];

        $queryid = "select * from clientes order by nroCliente desc limit 1;";
        $sql = mysqli_query(conectarBD(),$queryid);
        $cliID = mysqli_fetch_row($sql);
        $cliID[0]++;

        $cliente = new Cliente($cliID,$clinom,$cliape,$clidni,$clidire,$clitel);
        $mensajeCli = $cliente->darDeAlta();

    }else if(isset($_POST['empnom']) && $_POST['empnom'] != ""){

        $empnom = $_POST['empnom'];
        $empape = $_POST['empape'];
        $empdni = $_POST['empdni'];
        $empdire = $_POST['empdire'];
        $emptel = $_POST['emptel'];
        $empsueldo = $_POST['empsueldo'];
        $emprol = $_POST['emprol'];
        $empfecha = $_POST['empfecha'];

        $queryid = "select * from empleados order by nroEmpleado desc limit 1;";
        $sql = mysqli_query(conectarBD(),$queryid);
        $empID = mysqli_fetch_row($sql);
        $empID[0]++;

        $empleado = new Empleado ($empID,$empnom,$empape,$empdni,$empdire,$emptel,$empsueldo,$emprol,$empfecha);
        $mensajeEmp = $empleado->darDeAlta();
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=|, initial-scale=1.0">
    <title>Guia 3 | Olguin Galo</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <h1><a href="index.php" class="linkT">Administrador</a></h1>
    <div class="contenedorForms">
        <div class="contenedorClientes">
            <h2>Alta de clientes</h2>
            <form action="" method="POST">
                <label for="clinom">
                    Nombre
                    <input type="text" name="clinom" id="clinom">
                </label>
                <label for="cliape">
                    Apellido
                    <input type="text" name="cliape" id="cliape">
                </label>
                <label for="clidni">
                    DNI
                    <input type="number" name="clidni" id="clidni">
                </label>
                <label for="clidire">
                    Direccion
                    <input type="text" name="clidire" id="clidire">
                </label>
                <label for="clitel">
                    Telefono
                    <input type="text" name="clitel" id="clitel">
                </label>
                <button>Cargar Cliente</button>
                <div>
                    <?php if($mensajeCli != ""){?>
                        <p><?php echo $mensajeCli;?></p>
                    <?php }?>
                </div>
            </form>
        </div>
        <div class="contenedorEmpleados">
            <h2>Alta de empleados</h2>
            <form action="" method="POST">
                <label for="empnom">
                    Nombre
                    <input type="text" name="empnom" id="empnom">
                </label>
                <label for="empape">
                    Apellido
                    <input type="text" name="empape" id="empape">
                </label>
                <label for="empdni">
                    DNI
                    <input type="number" name="empdni" id="empdni">
                </label>
                <label for="empdire">
                    Direccion
                    <input type="text" name="empdire" id="empdire">
                </label>
                <label for="emptel">
                    Telefono
                    <input type="text" name="emptel" id="emptel">
                </label>
                <label for="empsueldo">
                    Sueldo
                    <input type="number" step="0.01" name="empsueldo" id="empsueldo">
                </label>
    
                <label for="emprol">Rol</label>
                <select name="emprol" id="emprol">
                    <option value="admin">Admin</option>
                    <option value="empleado">empleado</option>
                </select>

                <label for="empfecha">
                    Fecha de ingreso
                    <input type="date" name="empfecha" id="empfecha">
                </label>

                <button>Cargar Empleado</button>
                <?php if($mensajeEmp != ""){?>
                    <p><?php echo $mensajeEmp;?></p>
                <?php }?>
            </form>
        </div>
    </div>
</body>
</html>