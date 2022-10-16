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

        public abstract static function buscar();

        protected function saludar(){
            echo 'Hola soy ' .$this->nombre .' ' .$this->apellido .' y soy de la clase ' .get_class($this);
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

        }

        public function darDeAlta(){
            $mensaje = "";
            $con = conectarBD();
            $sql = "insert into clientes (nombre,apellido,dni,direccion,telefono) values ('$this->nombre','$this->apellido',$this->dni,'$this->direccion',$this->telefono)";
            mysqli_query($con,$sql);

            if (mysqli_affected_rows($con)>0){
                $mensaje = "se han guardado los registros";
            }else{
                $mensaje = "no se guardaron los registros";
            }
            return $mensaje;
        }

        public static function buscar(){

        }

        public static function listar(){
            
        }

        public function saludar(){
            parent::saludar();
        }
        
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

        }

        public function darDeAlta(){
            $mensaje = "";
            $con = conectarBD();
            $sql = "insert into empleados (nombre,apellido,dni,direccion,telefono,sueldo,rol,antiguedad) values ('$this->nombre','$this->apellido',$this->dni,'$this->direccion'.$this->telefono,$this->sueldo,'$this->rol','$this->antiguedad')";
            mysqli_query($con,$sql);
            if (mysqli_affected_rows($con) > 0){
                $mensaje = "se han guardado los registros";
            }else{
                $mensaje = "no se guardaron los registros";
            }
            return $mensaje;
        }

        public static function buscar(){

        }
        
        public static function listar(){

        }

        public function saludar(){
            parent::saludar();
        }
    }
#endregion


?>