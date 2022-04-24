<?php

namespace es\abd;

/**
 * Clase que mantiene el estado global de la aplicación.
 */
use es\abd\usuarios\Usuario;

class Aplicacion{
	const ATRIBUTOS_PETICION = 'attsPeticion';

	private static $instancia;

    /**
	 * Devuele una instancia de {@see Aplicacion}.
	 * 
	 * @return Aplicacion Obtiene la única instancia de la <code>Aplicacion</code>
	 */
	public static function getInstancia() {
		if (  !self::$instancia instanceof self) {
			self::$instancia = new static();
		}
		return self::$instancia;
	}

	/**
	 * @var array Almacena los datos de configuración de la BD
	 */
	private $bdDatosConexion;
	
     /**
     * @var string Ruta donde se encuentra instalada la aplicación. Por ejemplo, si
     *             la aplicación está accesible en http://localhost/miApp/, este
     *             parámetro debería de tomar el valor "/miApp".
     */
	private $rutaApp; //??¿¿¿?

    /**
     * @var string Ruta absoluta al directorio "includes" de la aplicación.
     */
    private $dirInstalacion = __DIR__;

    /**
     * Almacena si la Aplicacion ya ha sido inicializada.
     *
     * @var boolean
     */
    private $inicializada;

    /**
     * Almacena si la Aplicacion está generando una página de error
     *
     * @var boolean
     */
    private $generandoError;

    /**
     * @var \mysqli Conexión de BD.
     */
    private $conn;

    /**
     * @var array Tabla asociativa con los atributos pendientes de la petición.
     */
    private $atributosPeticion;
	
	/**
	 * Evita que se pueda instanciar la clase directamente.
	 */
	private function __construct() {
		$this->inicializada = false;
        $this->generandoError = false;
	}

    /**
	 * Inicializa la aplicación.
	 * 
	 * @param array $bdDatosConexion datos de configuración de la BD
	 */
	public function init($bdDatosConexion, $rutaApp = '/', $dirInstalacion = __DIR__){
        if (!$this->inicializada) {
            $this->bdDatosConexion = $bdDatosConexion;

            $this->rutaRaizApp = $rutaApp;

            // Eliminamos la última /
            $tamRutaRaizApp = mb_strlen($this->rutaRaizApp);
            if ($tamRutaRaizApp > 0 && mb_substr($this->rutaRaizApp, $tamRutaRaizApp-1, 1) === '/') {
                $this->rutaRaizApp = mb_substr($this->rutaRaizApp, 0, $tamRutaRaizApp - 1);
            }

            // El último separador de la ruta (ya sea el separador específico del sistema o /)
            $this->dirInstalacion = $dirInstalacion;
            $tamDirInstalacion = mb_strlen($this->dirInstalacion);
            if ($tamDirInstalacion > 0) {
                $ultimoChar = mb_substr($this->dirInstalacion, $tamDirInstalacion-1, 1);
                if ($ultimoChar === DIRECTORY_SEPARATOR || $ultimoChar === '/') {
                    $this->dirInstalacion = mb_substr($this->dirInstalacion, 0, $tamDirInstalacion - 1);
                }
            }

            $this->conn = null;
            session_start();

            /* Se inicializa los atributos asociados a la petición en base a la sesión y se eliminan para que
        * no estén disponibles después de la gestión de esta petición.
        */
            $this->atributosPeticion = $_SESSION[self::ATRIBUTOS_PETICION] ?? [];
            unset($_SESSION[self::ATRIBUTOS_PETICION]);

            $this->inicializada = true;
        }
    }

	/**
	 * Cierre de la aplicación.
	 */
	public function shutdown(){
	    $this->compruebaInstanciaInicializada();
	    if ($this->conn !== null && ! $this->conn->connect_errno) {
	        $this->conn->close();
	    }
	}
	
	/**
	 * Comprueba si la aplicación está inicializada. Si no lo está muestra un mensaje y termina la ejecución.
	 */
	private function compruebaInstanciaInicializada(){
        if (!$this->inicializada && $this->generandoError) {
            $this->paginaError(502, 'Error', 'Oops', 'La aplicación no está configurada. Tienes que modificar el fichero config.php');
        }
    }
	
	/**
	 * Devuelve una conexión a la BD. Se encarga de que exista como mucho una conexión a la BD por petición.
	 * 
	 * @return \mysqli Conexión a MySQL.
	 */
	public function getConexionBd(){
	    $this->compruebaInstanciaInicializada();
		if (! $this->conn ) {
			$bdHost = $this->bdDatosConexion['host'];
			$bdUser = $this->bdDatosConexion['user'];
			$bdPass = $this->bdDatosConexion['pass'];
			$bd = $this->bdDatosConexion['bd'];
			
			$this->conn = new \mysqli($bdHost, $bdUser, $bdPass, $bd);
			if ( $this->conn->connect_errno ) {
				echo "Error de conexión a la BD: (" . $this->conn->connect_errno . ") " . utf8_encode($this->conn->connect_error);
				exit();
			}
			if ( ! $this->conn->set_charset("utf8mb4")) {
				echo "Error al configurar la codificación de la BD: (" . $this->conn->errno . ") " . utf8_encode($this->conn->error);
				exit();
			}
		}
		return $this->conn;
	}

	public function resuelve($path = ''){
        $this->compruebaInstanciaInicializada();
        $rutaAppLongitudPrefijo = mb_strlen($this->rutaRaizApp);
        if (mb_substr($path, 0, $rutaAppLongitudPrefijo) === $this->rutaRaizApp) {
            return $path;
        }

        if (mb_strlen($path) > 0 && mb_substr($path, 0, 1) !== '/') {
            $path = '/' . $path;
        }

        return $this->rutaRaizApp . $path;
    }

    public function doInclude($path = ''){
        $this->compruebaInstanciaInicializada();
        $params = array();
        $this->doIncludeInternal($path, $params);
    }

    private function doIncludeInternal($path, &$params){
        $this->compruebaInstanciaInicializada();

        if (mb_strlen($path) > 0 && mb_substr($path, 0, 1) !== '/') {
            $path = '/' . $path;
        }
        include($this->dirInstalacion . $path);
    }

    public function generaVista(string $rutaVista, &$params){
        $this->compruebaInstanciaInicializada();
        $params['app'] = $this;
        if (mb_strlen($rutaVista) > 0 && mb_substr($rutaVista, 0, 1) !== '/') {
            $rutaVista = '/' . $rutaVista;
        }
        $rutaVista = "/vistas{$rutaVista}";
        $this->doIncludeInternal($rutaVista, $params);
    }

    // return bool (true | false)
    public function show_advert(){
        
        // Muestra publicidad con un 20% de probabilidad si el usuario no es admin o si no está logueado en la página
        if( !$this->usuarioLogueado() || !$this->esAdmin() ) {
            $prob = rand(0,10);

            if($prob < 2) 
                return true;
        }
        return false;
    }

    public function login(Usuario $user){
        $this->compruebaInstanciaInicializada();
        $_SESSION['login'] = true;
        $_SESSION['nombre'] = $user->getNombreUsuario();
        $_SESSION['idUsuario'] = $user->getId();
        $_SESSION['rol'] = $user->getRol();
    }

    public function logout(){
        $this->compruebaInstanciaInicializada();
        //Doble seguridad: unset + destroy
        unset($_SESSION['login']);
        unset($_SESSION['nombre']);
        unset($_SESSION['idUsuario']);
        unset($_SESSION['rol']);

        session_destroy();
        session_start();
    }

    public function usuarioLogueado(){
        $this->compruebaInstanciaInicializada();
        return ($_SESSION['login'] ?? false) === true;
    }

    public function nombreUsuario(){
        $this->compruebaInstanciaInicializada();
        return $_SESSION['nombre'] ?? '';
    }

    public function idUsuario(){
        $this->compruebaInstanciaInicializada();
        return $_SESSION['idUsuario'] ?? '';
    }

    public function esAdmin(){
        $this->compruebaInstanciaInicializada();
        return $this->usuarioLogueado() && (Usuario::ADMIN_ROLE == $_SESSION['rol']);
    }

    public function tieneRol($rol){
        $this->compruebaInstanciaInicializada();
        return $this->usuarioLogueado() && ($rol ==  $_SESSION['rol']);
    }

    public function paginaError($codigoRespuesta, $tituloPagina, $mensajeError, $explicacion = ''){
        $this->generandoPaginaError = true;
        http_response_code($codigoRespuesta);

        $params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => "<h1>{$mensajeError}</h1><p>{$explicacion}</p>"];
        $this->generaVista('/plantillas/plantilla.php', $params);
        exit();
    }

    public function verificaLogado($urlNoLogado){
        $this->compruebaInstanciaInicializada();
        if (!$this->usuarioLogueado()) {
            self::redirige($urlNoLogado);
        }
    }

    /**
     * Añade un atributo <code>$valor</code> para que esté disponible en la siguiente petición bajo la clave <code>$clave</code>.
     *
     * @param string $clave Clave bajo la que almacenar el atributo.
     * 
     *
     */
    public function putAtributoPeticion($clave, $valor){
        $atts = null;
        if (isset($_SESSION[self::ATRIBUTOS_PETICION])) {
            $atts = &$_SESSION[self::ATRIBUTOS_PETICION];
        } else {
            $atts = array();
            $_SESSION[self::ATRIBUTOS_PETICION] = &$atts;
        }
        $atts[$clave] = $valor;
    }

    /**
     * Devuelve un atributo establecido en la petición actual o en la petición justamente anterior.
     *
     *
     * @param string $clave Clave sobre la que buscar el atributo.
     *
     * 
     */
    public function getAtributoPeticion($clave){
        $result = $this->atributosPeticion[$clave] ?? null;
        if (is_null($result) && isset($_SESSION[self::ATRIBUTOS_PETICION])) {
            $result = $_SESSION[self::ATRIBUTOS_PETICION][$clave] ?? null;
        }
        return $result;
    }

    public static function redirige($url){
        header('Location: ' . $url);
        exit();
    }

    public function buildUrl($relativeURL, $params = []){
        $url = $this->resuelve($relativeURL);
        $query = self::buildParams($params);
        if (!empty($query)) {
            $url .= '?' . $query;
        }

        return $url;
    }

    public static function buildParams($params, $separator = '&', $enclosing = ''){
        $query = '';
        $numParams = 0;
        foreach ($params as $param => $value) {
            if ($value != null) {
                if ($numParams > 0) {
                    $query .= $separator;
                }
                $query .= "{$param}={$enclosing}{$value}{$enclosing}";
                $numParams++;
            }
        }
        return $query;
    }
}