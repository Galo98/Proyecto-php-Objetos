<?php 
    include 'clases.php';
    $mensajeCli = "";
    $mensajeEmp = "";
    $listado = 0; 
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
    }else if($_POST['listar'] != ""){
        if($_POST['listar'] == "Cliente"){
            $listado = 1;
        }else if ($_POST['listar'] == "Empleado"){
            $listado = 2;
        }
        $listar = $_POST['listar']::listar();
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
    <main class="contenedorGeneral">
        <h1><a href="index.php" class="linkT">Administrador</a></h1>
        <div class="contenedorForms">
            <div class="contenedorClientes">
                <h2>Alta de clientes</h2>
                <form class="clientesForm" action="" method="POST">
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
                        <input type="number" maxlength="8"  pattern="[0-9]{10}" name="clidni" id="clidni">
                    </label>
                    <label for="clidire">
                        Direccion
                        <input type="text" name="clidire" id="clidire">
                    </label>
                    <label for="clitel">
                        Telefono
                        <input type="text" maxlength="10"  pattern="[0-9]{10}" name="clitel" id="clitel">
                    </label>
                    <button class="btn">Cargar Cliente</button>
                        <?php if($mensajeCli != ""){?>
                    <div class="mensajeCli">
                            <p><?php echo $mensajeCli;?></p>
                    </div>
                        <?php }?>
                    
                </form>
            </div>
            <div class="contenedorEmpleados">
                <h2>Alta de empleados</h2>
                <form class="empleadosForm" action="" method="POST">
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
                        <input type="number" maxlength="8" pattern="[0-9]{10}" name="empdni" id="empdni">
                    </label>
                    <label for="empdire">
                        Direccion
                        <input type="text" name="empdire" id="empdire">
                    </label>
                    <label for="emptel">
                        Telefono
                        <input type="text" maxlength="10" pattern="[0-9]{10}" name="emptel" id="emptel">
                    </label>
                    <label for="empsueldo">
                        Sueldo
                        <input type="number" maxlength="9" step="0.01" name="empsueldo" id="empsueldo">
                    </label>
                    <label for="emprol">
                        Rol
                        <select name="emprol" id="emprol">
                            <option value="admin">admin</option>
                            <option value="empleado">empleado</option>
                        </select>
                    </label>
                    <label for="empfecha">
                        Fecha de ingreso
                        <input type="date" name="empfecha" id="empfecha">
                    </label>
                    <button class="btn">Cargar Empleado</button>
                        <?php if($mensajeEmp != ""){?>
                    <div class="mensajeEmp">
                            <p><?php echo $mensajeEmp;?></p>
                    </div>
                        <?php }?>
                </form>
            </div>
        </div>
        <section class="contenedorListas">
            <h1>Listados</h1>
            <form action="" method="POST" class="contenedorBuscador">
                <label class="menuListas">
                    <input type="text">
                    <select name="rol" id="">
                        <option value="1">cliente</option>
                        <option value="2">empleado</option>
                        <option value="3">admin</option>
                    </select>
                    <button class="btn"class="btn">buscar</button>
                </label>
            </form>

            <div class="contenedorBtnLitados">
                <form action="index.php#listado" method="POST">
                    <input type="hidden" name="listar" value="Cliente">
                    <button class="btn">Listar Clientes</button>
                </form>
                <form action="index.php#listado" method="POST">
                    <input type="hidden" name="listar" value="Empleado">
                    <button class="btn">Listar Empleados</button>
                </form>
            </div>

            <div class="Listas" id="listado">
                <?php switch($listado){
                    case 0;
                        break;
                    case 1:?>
                    <table class="tftable" border="1">
                        <tr>
                            <th>Nro Cliente</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DNI</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                        </tr>
                        <?php while($dato = mysqli_fetch_assoc($listar)){?>
                        <tr>
                            <td><?php echo $dato['nroCliente'];?></td>
                            <td><?php echo $dato['nombre'];?></td>
                            <td><?php echo $dato['apellido'];?></td>
                            <td><?php echo $dato['dni'];?></td>
                            <td><?php echo $dato['direccion'];?></td>
                            <td><?php echo $dato['telefono'];?></td>
                        </tr>
                        <?php }?>
                    </table>
                        <?php
                            break;
                        case 2: ?>
                    <table class="tftable" border="1">
                        <tr>
                            <th>Nro Empleado</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DNI</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Sueldo</th>
                            <th>Rol</th>
                            <th>Antiguedad</th>
                        </tr>
                        <?php while($dato = mysqli_fetch_assoc($listar)){?>
                        <tr>
                            <td><?php echo $dato['nroEmpleado'];?></td>
                            <td><?php echo $dato['nombre'];?></td>
                            <td><?php echo $dato['apellido'];?></td>
                            <td><?php echo $dato['dni'];?></td>
                            <td><?php echo $dato['direccion'];?></td>
                            <td><?php echo $dato['telefono'];?></td>
                            <td><?php echo $dato['sueldo'];?></td>
                            <td><?php echo $dato['rol'];?></td>
                            <td><?php echo $dato['antiguedad'];?></td>
                        </tr>
                        <?php }?>
                    </table>
                        <?php
                            break;
                        } ?>
            </div>
        </section>
    </main>
</body>
</html>