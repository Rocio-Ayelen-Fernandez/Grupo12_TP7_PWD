<?php 
function data_submitted() {
    $_AAux= array();
    if (!empty($_POST))
        $_AAux =$_POST;
        else
            if(!empty($_GET)) {
                $_AAux =$_GET;
            }
        if (count($_AAux)){
            foreach ($_AAux as $indice => $valor) {
                if ($valor=="")
                    $_AAux[$indice] = 'null' ;
            }
        }
        return $_AAux;
        
}
function verEstructura($e){
    echo "<pre>";
    print_r($e);
    echo "</pre>"; 
}

spl_autoload_register(function($class_name) {
    // Verificación que la sesión esté iniciada
    if (!isset($_SESSION)) {
        session_start();
    }

    // Definición de rutas de directorios
    $directories = array(
        isset($_SESSION['ROOT']) ? $_SESSION['ROOT'] . 'Modelo/' : '',
        isset($_SESSION['ROOT']) ? $_SESSION['ROOT'] . 'Modelo/conector/' : '',
        isset($_SESSION['ROOT']) ? $_SESSION['ROOT'] . 'Control/' : '',
        isset($_SESSION['ROOT']) ? $_SESSION['ROOT'] . 'util/' : '',
        isset($_SESSION['ROOT']) ? $_SESSION['ROOT'] . 'vendor/' : ''
    );
    
    // Iteración sobre cada directorio
    foreach($directories as $directory) {
        // Verificación si el archivo existe en el directorio actual
        if (!empty($directory)) {
            $file = $directory . $class_name . '.php';
            if (file_exists($file)) {
                require_once($file);
                return;
            }
        }
    }
});


?>