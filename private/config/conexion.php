<?php
require_once "global.php";
/** SECTION Conexión a base de datos */
$conect = new mysqli( DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
mysqli_query( $conect,  'SET NAMES "'. DB_ENCODE . '"');

// SECTION  Verificar si hay errores en la conexión
if ( mysqli_connect_errno() ) {
    printf( " Falló la conexión con la base de datos : %s \n", mysqli_connect_error());
    exit();
}

if ( !function_exists('queryExect') ) {
    // SECTION  ejecuta la consulta y devuelve el resultado
    function queryExect( $sql ){
        global $conect;
        $query = $conect->query($sql);
        return $query;
    }
    // SECTION ejecuta la consulta como paramtro y devuelve la fila
    function queryExectSimpleData( $sql ){
        global $conect;
        $query = $conect->query($sql);
        $row   = $query->fetch_assoc();
        return $query;
    }
    // SECTION ejecuta la consulta y devuelve el id o la llave primaria de la consulta
    function queryExectSimpleDataIdReturn( $sql ){
        global $conect;
        $query = $conect->query($sql);
        return $conect ->insert_id;
    }
    //SECTION limpia los caracteres que se pueden enviar en la cadena de la consulta
    function cleanString( $str ){
        global $conect;
        $str = mysqli_real_escape_string($conect,trim($str));
        return htmlspecialchars($str);

    }

}
