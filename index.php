<?php 
    include 'clases.php';
    $mensajeCli = "";
    $mensajeEmp = "";
    $listado = 0; 
    $rol = ['','cliente','empleado','admin'];
    if(isset($_POST['clinom']) && $_POST['clinom'] != ""){
        $queryid = "select * from clientes order by nroCliente desc limit 1;";
        $sql = mysqli_query(conectarBD(),$queryid);
        $cliID = mysqli_fetch_row($sql);
        $cliID[0]++;
        $cliente = new Cliente($cliID,$_POST['clinom'],$_POST['cliape'],$_POST['clidni'],$_POST['clidire'],$_POST['clitel']);
        $mensajeCli = $cliente->darDeAlta();
        // $cliente->mostrarDatos();
    }else if(isset($_POST['empnom']) && $_POST['empnom'] != ""){
        $queryid = "select * from empleados order by nroEmpleado desc limit 1;";
        $sql = mysqli_query(conectarBD(),$queryid);
        $empID = mysqli_fetch_row($sql);
        $empID[0]++;
        $empleado = new Empleado ($empID,$_POST['empnom'],$_POST['empape'],$_POST['empdni'],$_POST['empdire'],$_POST['emptel'],$_POST['empsueldo'],$_POST['emprol'],$_POST['empfecha']);
        $mensajeEmp = $empleado->darDeAlta();
        // $empleado->mostrarDatos();
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
                        <input type="text" name="clinom" id="clinom" required placeholder="Nombre">
                    </label>
                    <label for="cliape">
                        Apellido
                        <input type="text" name="cliape" id="cliape" required placeholder="Apellido">
                    </label>
                    <label for="clidni">
                        DNI
                        <input type="number" maxlength="8"  pattern="[0-9]{10}" name="clidni" id="clidni" required placeholder="24987987">
                    </label>
                    <label for="clidire">
                        Direccion
                        <input type="text" name="clidire" id="clidire" required placeholder="Calle 1234">
                    </label>
                    <label for="clitel">
                        Telefono
                        <input type="number" minlength="8" maxlength="10"  pattern="[0-9]{10}" name="clitel" id="clitel" required placeholder="1512341234">
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
                        <input type="text" name="empnom" id="empnom" required placeholder="Nombre">
                    </label>
                    <label for="empape">
                        Apellido
                        <input type="text" name="empape" id="empape" required placeholder="Apellido">
                    </label>
                    <label for="empdni">
                        DNI
                        <input type="number" maxlength="8" pattern="[0-9]{10}" name="empdni" id="empdni" required placeholder="24987987">
                    </label>
                    <label for="empdire">
                        Direccion
                        <input type="text" name="empdire" id="empdire" required placeholder="Calle 1234">
                    </label>
                    <label for="emptel">
                        Telefono
                        <input type="number" minlength="8" maxlength="10" pattern="[0-9]{10}" name="emptel" id="emptel" required placeholder="1512341234">
                    </label>
                    <label for="empsueldo">
                        Sueldo
                        <input type="number" maxlength="9" step="0.01" name="empsueldo" id="empsueldo" required placeholder="00000.00">
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
            <form action="index.php#listado" method="POST" class="contenedorBuscador">
                <label class="menuListas">
                    <input type="text" placeholder="Nombre o ID" name="buscador">
                    <select name="rol">
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
            
            <div id="listado">
            <?php 
            
            (isset($_POST['listar']) && $_POST['listar'] !== "") ? $_POST['listar']::listar() : "";

            if(isset($_POST['rol']) && $_POST['rol'] == 1){
                Cliente::buscar($_POST['buscador'],$_POST['rol']);
            }else if(isset($_POST['rol']) && $_POST['rol'] >= 2){
                Empleado::buscar($_POST['buscador'],$rol[$_POST['rol']]);
            }
            
            ?>
            </div>
        </section>
    </main>
</body>
</html>