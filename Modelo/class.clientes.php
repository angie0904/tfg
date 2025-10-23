<!-- <?php
// require_once('class.db.php');
// class usuarios{
//     public $db;
//         public $conn;

//         public function __construct(){
//             $this->db = new db();
//             $this->conn = $this->db->getConn();
//         }

//         // Obtenemos el id del usuario con su nombre
//         public function getId($nombre){
//             $consulta = "SELECT id FROM pacientes WHERE nombre = ?";
//             $sentencia = $this->conn->prepare($consulta);
//             $sentencia->bind_param("s", $nombre);
//             $sentencia->bind_result($id);
//             $info = array();
//             $sentencia->execute();
//             while($sentencia->fetch()){
//                 array_push($info, [$id]);
//             };
//             $sentencia->close();
//             return $info;
//         }
    // private $db;
    // public function __construct(){
    //     $this->db=new db();
    // }

    // public function getClientes(){
    //     $conn=$this->db->conn;
    //     $sent="SELECT * FROM pacientes";
    //     $cons=$conn->prepare($sent);
    //     $cons->bind_result($NHC,$Nombre,$Apellidos);
    //     $cons->execute();
    //     $result=array();
    //     while($cons->fetch()){
    //         $clientes[$NHC] = array('nom'=>$Nombre,'ape'=>$Apellidos);
    //     }
    //     $cons->close();
    //     return $clientes;
    // }
    // public function getCliente(string $login){
    //     $conn=$this->db->conn;
    //     $sent="SELECT  NHC,Nombre,Apellidos FROM pacientes WHERE login=?";
    //     $cons=$conn->prepare($sent);
    //     $cons->bind_param('i',$login);
    //     // $cons->bind_result($id_clientes,$nombre,$apellidos,$dirección,$telefono);
    //     $cons->execute();
    //     $res=false;
    //     if($cons->affected_rows==1) $res=true;
    //     $cons->close();
    //     return $res;
    // }
        //     public function getID($Nombre){
        //     $conn=$this->db->conn;
        //     $consulta = "SELECT Nombre, NHC FROM pacientes WHERE login = ?";
        //     $sentencia = $this->$conn->prepare($consulta);
        //     $sentencia->bind_param("s", $Nombre);
        //     $sentencia->bind_result($Nombre);
        //     $info = array();
        //     $sentencia->execute();
        //     while($sentencia->fetch()){
        //         array_push($info, [$Nombre]);
        //     };
        //     $sentencia->close();
        //     return $info;
        // }

    // public function borrarCliente(int $id_clientes){
    //     $conn=$this->db->conn;
    //     $sent="DELETE FROM clientes WHERE id_clientes=?";
    //     $cons=$conn->prepare($sent);
    //     $cons->bind_param("i",$id_clientes);
    //     $cons->execute();
    //     $res=false;
    //     if($cons->affected_rows==1) $res=true;
    //     $cons->close();
    //     return $res;
    // }
    // public function modificarClientes(int $id_clientes,String $nombre,String $apellidos, String $dirección, int $telefono){
    //     $conn=$this->db->conn;
    //     $sent="UPDATE clientes SET nombre=?,apellidos=?,dirección=?,telefono1=? WHERE id_clientes=?";
    //     $cons=$conn->prepare($sent);
    //     $cons->bind_param("sssii",$nombre,$apellidos,$dirección,$telefono,$id_clientes);
    //     $cons->execute();
    //     $res=false;
    //     if($cons->affected_rows==1) $res=true;
    //     $cons->close();
    //     return $res;
    // }
    // public function insertarCliente(String $nombre,String $apellidos, String $dirección, int $telefono){
    //     $conn=$this->db->conn;
    //     $sent="INSERT INTO clientes (nombre,apellidos,dirección,telefono1) VALUES (?,?,?,?)";
    //     $cons=$conn->prepare($sent);
    //     $cons->bind_param("sssi",$nombre,$apellidos,$dirección,$telefono);
    //     $cons->execute();
    //     $res=false;
    //     if($cons->affected_rows==1) $res=true;
    //     $cons->close();
    //     return $res;
    // }

?> -->