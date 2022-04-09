<?php

namespace es\abd\usuarios;

use es\abd\Aplicacion;
use es\abd\MagicProperties;

class Usuario{

    use MagicProperties;

    public const ADMIN_ROLE = 1;
    public const USER_ROLE = 2;

    private $id;
    private $nombreUsuario;
    private $password;
    private $nombre;
    private $roles;
    private $correo;

    private function __construct($nombreUsuario, $nombre, $password,$correo, $id = null, $roles = []){
        $this->id = $id;
        $this->nombreUsuario= $nombreUsuario;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->roles = $roles;
        $this->correo = $correo;
    }

    public static function login($nombreUsuario, $password, $correo){
        $usuario = self::buscaUsuario($nombreUsuario,$correo);
        if ($usuario && $usuario->compruebaPassword($password)) {
            return $usuario;
        }
        return false;
    }

    public static function buscaUsuario($nombreUsuario,$correo){
        $conn = Aplicacion::getInstancia()->getConexionBd();
        $query = sprintf("SELECT * FROM Usuarios U WHERE U.nombreUsuario = '%s'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);
        $query1 = sprintf("SELECT * FROM Usuarios U WHERE U.correo = '%s'", $conn->real_escape_string($correo));
        $rs1 = $conn->query($query1);
        $result = false;
        if ($rs && $rs1) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                if($fila){
                    $result = new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['correo'], $fila['id']);
                }    
            }
            else if($rs1->num_rows==1){
                $fila = $rs1->fetch_assoc();
                if($fila){
                    $result = new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['correo'], $fila['id']);
                }   
            }
            $rs->free();
            $rs1->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public static function buscaPorId($idUsuario)
    {
        $conn = Aplicacion::getInstancia()->getConexionBd();
        $query = sprintf("SELECT * FROM Usuarios WHERE id=%d", $idUsuario);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if($fila){
                $result = new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['correo'], $fila['id']);
            }   
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    private static function cargaRoles($usuario)
    {
        $roles=[];
            
        $conn = Aplicacion::getInstancia()->getConexionBd();
        $query = sprintf("SELECT RU.rol FROM RolesUsuario RU WHERE RU.usuario=%d"
            , $usuario->id
        );
        $rs = $conn->query($query);
        if ($rs) {
            $roles = $rs->fetch_all(MYSQLI_ASSOC);
            $rs->free();

            $usuario->roles = [];
            foreach($roles as $rol) {
                $usuario->roles[] = $rol['rol'];
            }
            return $usuario;

        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return false;
    }

    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function crea($nombreUsuario, $nombre, $password, $correo, $rol){

        $user = new Usuario($nombreUsuario, $nombre, self::hashPassword($password), $correo);
        $user->añadeRol($rol);
        return $user->guarda();
    }
    

    private static function inserta($usuario){
        $result = false;
        $conn = Aplicacion::getInstancia()->getConexionBd();
        $query=sprintf("INSERT INTO Usuarios(nombreUsuario, nombre, password, correo) VALUES('%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            ,$conn->real_escape_string($usuario->correo));
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
            $result = self::insertaRoles($usuario);
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    private static function insertaRoles($usuario)
    {
        $conn = Aplicacion::getInstancia()->getConexionBd();
        foreach($usuario->roles as $rol) {
            $query = sprintf("INSERT INTO RolesUsuario(usuario, rol) VALUES (%d, %d)"
            , $usuario->id
            ,$rol
            );
            if (!$conn->query($query) ) {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
                return false;
            }
        }
        return $usuario;
    }
    
    private static function actualiza($usuario){
        $result = false;
        $conn = Aplicacion::getInstancia()->getConexionBd();
        $query=sprintf("UPDATE Usuarios U SET nombreUsuario = '%s', nombre='%s', password='%s', correo='%s' WHERE U.id=%i"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->correo)
            , $usuario->id);
            if ( $conn->query($query) ) {
                $result = self::borraRoles($usuario);
                if ($result) {
                    $result = self::insertaRoles($usuario);
                }
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
        
        return $result;
    }

    private static function borraRoles($usuario)
    {
        $conn = Aplicacion::getInstancia()->getConexionBd();
        $query = sprintf("DELETE FROM RolesUsuario RU WHERE RU.usuario = %d"
            , $usuario->id
        );
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return $usuario;
    }
   
    private static function borra($usuario){
        return self::borraPorId($usuario->id);
    }
    
    private static function borraPorId($idUsuario){
        if (!$idUsuario) {
            return false;
        } 

        $conn = Aplicacion::getInstancia()->getConexionBd();
        $query = sprintf("DELETE FROM Usuarios U WHERE U.id = %d", $idUsuario);
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombreUsuario(){
        return $this->nombreUsuario;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function añadeRol($role)
    {
        $this->roles[] = $role;
    }

    public function getRoles(){
        return $this->roles;
    }

    public function tieneRol($role)
    {
        if ($this->roles == null) {
            self::cargaRoles($this);
        }
        return array_search($role, $this->roles) !== false;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function compruebaPassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }

    public function guarda()
    {
        if ($this->id !== null) {
            return self::actualiza($this);
        }
        return self::inserta($this);
    }
    
    public function borrate(){
        if ($this->id !== null) {
            return self::borra($this);
        }
        return false;
    }
}