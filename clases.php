<?php
    function conectarBD(){
        $serv="localhost";
        $usr="root";
        $pss="";
        $bd="galoGuia3";
        $c=mysqli_connect($serv, $usr, $pss, $bd);
        return $c;
    }

    #region Clase Persona
    abstract class Persona{
        
        //Atributos

        protected $nombre;
        protected $apellido;
        protected $dni;

        // Constructor

        public function __construct($nombre,$apellido,$dni){
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->dni = $dni;
        }

        // Metodos

        public abstract function mostrarDatos();

        public abstract function darDeAlta();

        public abstract static function buscar($campo,$rol);

        protected function saludar(){
            echo 'Hola soy ' .$this->nombre .' ' .$this->apellido .' y soy de la clase ' .get_class($this);
        }
        protected function hablar($texto){
            echo $texto;
        }
    }
#endregion

    #region Clase Cliente
    class Cliente extends Persona{

        // Atributos
        private $nroCliente;
        private $direccion;
        private $telefono;

        // Constructor

        public function __construct($nroCliente,$nombre,$apellido,$dni,$direccion,$telefono){
            parent::__construct($nombre,$apellido,$dni);
            $this->nroCliente = $nroCliente;
            $this->direccion = $direccion;
            $this->telefono = $telefono;
        }

        // Metodos

        public function mostrarDatos(){
            echo "Nombre: " .$this->nombre;
            echo "Apellido: " .$this->apellido;
            echo "DNI: " .$this->dni;
            echo "Direccion: " .$this->direccion;
            echo "Telefono: " .$this->telefono;
        }

        public function darDeAlta(){
            $mensaje = "";
            $con = conectarBD();
            $sql = "insert into clientes (nombre,apellido,dni,direccion,telefono) values ('$this->nombre','$this->apellido',$this->dni,'$this->direccion',$this->telefono)";
            mysqli_query($con,$sql);

            if (mysqli_affected_rows($con)>0){
                $mensaje = "Se guardo un nuevo cliente";
            }else{
                $mensaje = "No se pudo guardar al nuevo cliente";
            }
            return $mensaje;
        }

        public static function buscar($campo,$rol){
            $con = conectarBD();
            $rl = $rol;
            if(is_numeric($campo)){
                $sql = "select * from clientes where nroCliente = $campo;";
                $resultado = mysqli_query($con,$sql);
                (mysqli_affected_rows($con) > 0) ? self::crearListadoCliente($resultado) : parent::hablar("Campo invalido o no ingresado, valor = $campo") ; 
            }else if(gettype($campo) == 'string'){
                $sql = "select * from clientes where nombre='$campo'";
                $resultado = mysqli_query($con,$sql);
                (mysqli_affected_rows($con) > 0) ? self::crearListadoCliente($resultado) : parent::hablar("Campo invalido o no ingresado, valor = $campo") ;
            }else{
                echo "El campo ingresado: " .$campo .", no es valido";
            }
            
        }

        public static function listar(){
            $con = conectarBD();
            $sql = "select * from clientes";
            $resultado = mysqli_query($con,$sql);
            if(mysqli_affected_rows($con) > 0){
                self::crearListadoCliente($resultado);
            }else {
                echo "No hay clientes cargados en el sistema";
            }
            
        }

        public function saludar(){
            parent::saludar();
        }

        private static function crearListadoCliente($datosBD){?>
        <table>
            <tr>
                <th>Nro Cliente</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Direccion</th>
                <th>Telefono</th>
            </tr>
            <?php while($dato = mysqli_fetch_assoc($datosBD)){?>
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
    <?php }
        
    }
#endregion

    #region Clase empleado
    class Empleado extends Persona{

        // Atributos
        private $nroEmpleado;
        private $direccion;
        private $telefono;
        private $sueldo;
        private $rol;
        private $antiguedad;

        // Constructor

        public function __construct($nroEmpleado,$nombre,$apellido,$dni,$direccion,$telefono,$sueldo,$rol,$antiguedad){
            parent::__construct($nombre,$apellido,$dni);
            $this->nroEmpleado = $nroEmpleado;
            $this->direccion = $direccion;
            $this->telefono = $telefono;
            $this->sueldo = $sueldo;
            $this->rol = $rol;
            $this->antiguedad = $antiguedad;
        }

        // Metodos

        public function mostrarDatos(){
            echo "NroEmpleado: " .$this->nroEmpleado;
            echo "Nombre: " .$this->nombre;
            echo "Apellido: " .$this->apellido;
            echo "DNI: " .$this->dni;
            echo "Direccion: " .$this.direccion;
            echo "Telefono: " .$this.telefono;
            echo "Sueldo: " .$this.sueldo;
            echo "Rol: " .$this.rol;
            echo "Antiguedad: " .$this->antiguedad;
        }

        public function darDeAlta(){
            $mensaje = "";
            $con = conectarBD();
            $sql = "insert into empleados (nombre,apellido,dni,direccion,telefono,sueldo,rol,antiguedad) values ('$this->nombre','$this->apellido',$this->dni,'$this->direccion',$this->telefono,$this->sueldo,'$this->rol','$this->antiguedad')";
            mysqli_query($con,$sql);
            if (mysqli_affected_rows($con) > 0){
                $mensaje = "Se guardo un nuevo empleado";
            }else{
                $mensaje = "No se pudo guardar al nuevo empleado";
            }
            return $mensaje;
        }

        public static function buscar($campo,$rol){
            $con = conectarBD();
            if($campo == ""){
                $sql = "select * from empleados where rol = '$rol';";
            } else if(is_numeric($campo)){
                $sql = "select * from empleados where nroEmpleado=$campo ";
            } else if(gettype($campo) === 'string'){
                $sql = "select * from empleados where nombre like '%$campo%' or apellido like '%$campo%' or direccion like '%$campo%' or antiguedad like '%$campo%' and rol='$rol';";
            }
            $resultado = mysqli_query($con,$sql);
            
            (mysqli_affected_rows($con) > 0 ) ? self::crearListadoEmpleados($resultado) : parent::hablar("No se han encontrado resultados para la busqueda $campo , y el rol $rol") ;
        }
        
        public static function listar(){
            $con = conectarBD();
            $sql = "select * from empleados";
            $resultado = mysqli_query($con,$sql);
            
            (mysqli_affected_rows($con) > 0 ) ? self::crearListadoEmpleados($resultado) : parent::hablar("No hay empleados cargados en el sistema");
        }

        public function saludar(){
            parent::saludar();
        }

        private static function crearListadoEmpleados($datosBD){ ?>
            <table>
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
                    <?php while($dato = mysqli_fetch_assoc($datosBD)){?>
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
<?php       }
        
    }
#endregion

/* (isset($_POST['rol']) && $_POST['rol'] === 1 ? Cliente::buscar($_POST['buscador'],$_POST['rol']) : (isset($_POST['rol']) && $_POST['rol'] === 2) ) ? Empleado::buscar($_POST['buscador'],$rol[$_POST['rol']]) : ""; */
?>