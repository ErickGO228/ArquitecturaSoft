Utilizar Xampp
Cambiar el puerto de MySQL, utilizar el 3308
Cambiar la contraseña de Xampp en:
  login.php: $conn = new mysqli($host, $username, '', $dbname);
            //$conn = new mysqli($host, $username, 'root', $dbname);

  y en db-connect.php: //$password = 'root';
                        $password = '';

en db/datos.slq hay datos para hacer pruebas, hay que importarlos a phpmyadmin y las contraseñas de los dos usuarios registrados es 123
