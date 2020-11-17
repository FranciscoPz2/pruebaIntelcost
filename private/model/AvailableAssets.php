<?php

    /**
     *Leemos el JSON data-1.json 
    * 
    */
    require "../config/conexion.php";

    class AvailableAssets{
        /**
         * SECTION Constructor
         * @version 1.0
         * @author Franciscopz2
         * 
         */
        public function __construct(){
            
        }
        /**
         * SECTION insertar bienes
         * @version 1.0
         * @author Franciscopz2
         * 
         * 
         */

        public function insertAssets( $Id, $Direccion,$Ciudad,$Telefono,$Codigo,$Tipo,$Precio,$Status ){

            $sql = "INSERT INTO bienes (direccion, ciudad, telefono, codigo_postal,tipo,precio,state) VALUES ('$Direccion', '$Ciudad', '$Telefono','$Codigo','$Tipo','$Precio','$Status')";
            return queryExect($sql);
        }
        /**
         * SECTION Editar bienes
         * @version 1.0
         * @author Franciscopz2
         */

        public function updateAssets( $Id, $Direccion,$Ciudad,$Telefono,$Codigo,$Tipo,$Precio,$Status ){
        $sql = "UPDATE bienes  SET direccion= ('$Direccion'), ciudad= ('$Ciudad'), telefono= ('$Telefono'), codigo_postal= ('$Codigo'),tipo= ('$Tipo'),precio= ('$Precio'),state=('$Status') WHERE id=('$Id')";
            return queryExect( $sql );
        }
        /**
         * SECTION Eliminar bienes
         * @version 1.0
         * @author Franciscopz2
         */

        public function DeleteAssets( $Id, $Status ){
            $sql = "UPDATE bienes  SET state=('$Status') WHERE id=('$Id')";
            return queryExect( $sql );
        }
        /**
         * SECTION Leer bienes en especifico 
         * @version 1.0
         * @author Franciscopz2
         */

        public function showAssetsList( $Id,$Status ){
            $sql = "SELECT * FROM bienes WHERE id=('$Id') AND state <> 0";
            return queryExectSimpleDataIdReturn( $sql );
        }
        /**
         * SECTION Leer bienes
         * @version 1.0
         * @author Franciscopz2
         */
        
        public function showAssets(){
            $sql = "SELECT * FROM bienes WHERE state <> 0";
            return queryExect( $sql );
        }
   
    }

    // $datos_bienes = file_get_contents("data-1.json");

    // $json_bienes = json_encode($datos_bienes);
    // $json_bienes = json_decode($datos_bienes);

    // // var_dump($json_bienes);
    // foreach ($json_bienes as $key => $value) {
    //    var_dump($key);
    //     # code...
    //     // var_dump( "$key: $value <br>");
    // }
  
    // foreach($json_bienes as $jsonArray){
    //         // var_dump($jsonArray);
    //         $Idval     = (isset( $jsonArray["Id"]) ? $jsonArray["Id"] : '');
    //         $Direccion = (isset( $jsonArray["Direccion"]) ? $jsonArray["Direccion"] : '');
    //         $Ciudad    = (isset( $jsonArray["Ciudad"] ) ?  $jsonArray["Ciudad"] : '');
    //         $Telefono  = (isset( $jsonArray["Telefono"] ) ?  $jsonArray["Telefono"] : '');
    //         $CodigoP   = (isset( $jsonArray["Codigo_Postal"] ) ?  $jsonArray["Codigo_Postal"] : '');
    //         $Tipo      = (isset( $jsonArray["Tipo"]) ?  $jsonArray["Tipo"] : '');
    //         $Precio    = (isset( $jsonArray["Precio"]) ?  $jsonArray["Precio"] : '');
    //         echo '<pre>';
    //         // echo " Id : ". $Idval." <br/> Dirección: ".$Direccion ."<br/> Ciudad: ".$Ciudad."<br/> Telefono: ".$Telefono."<br/> Codigo Postal".$CodigoP."<br/> Tipo ".$Tipo ."<br/> Precio ".$Precio ." <br/> ";  
    //         // echo "";

    // }


?>
