<?php
    /**
    * Archivo de configuración de la base de datos con PDO
    */
    $password ='';
    $usuario = 'root';
    $nombreDb ='intelcost_bienes';
    try {
        $bd = new PDO(
            'mysql:host=localhost;
            dbname=' . $nombreDb,
            $usuario,
            $password,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" )
        );
    } catch (Exception $e) {
        echo "Error de conexion ".$e->getMessage();
        
    }