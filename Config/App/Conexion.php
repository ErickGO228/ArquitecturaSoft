<?php
class Conexion {
    protected static $instancia;
    protected $conect;

    protected function __construct() {
        $pdo = "mysql:host=" . host . ";dbname=" . db . ";" . charset;
        try {
            $this->conect = new PDO($pdo, user, pass);
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error en la conexión" . $e->getMessage();
        }
    }

    public static function obtenerInstancia() {
        if (self::$instancia === null) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function obtenerConexion() {
        return $this->conect;
    }
}
?>
