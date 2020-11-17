<?php

require_once "../model/AvailableAssets.php";


$category  = new AvailableAssets(); 

// $Id        = isset( $_POST["Id"] ) ? cleanString( $_POST["Id"] )              : "";
// $Direccion = isset( $_POST["Direccion"] ) ? cleanString( $_POST["Direccion"] ): "";
// $Telefono  = isset( $_POST["Telefono"] ) ? cleanString( $_POST["Telefono"] )  : "";  
// $Codigo    = isset( $_POST["Codigo"] ) ? cleanString( $_POST["Codigo"] )      : "";    
// $Ciudad    = isset( $_POST["Ciudad"] ) ? cleanString( $_POST["Ciudad"] )      : "";    
// $Tipo      = isset( $_POST["Tipo"] ) ? cleanString( $_POST["Tipo"] )          : "";      
// $Precio    = isset( $_POST["Precio"] ) ? cleanString( $_POST["Precio"] )      : "";    
// $Status    = isset( $_POST["state"] ) ? cleanString( $_POST["state"] )        : 0 ; 

header('Content-Type: application/json');

switch ($_GET["operador"]) {
    case 'uno':
        $Id        = isset( $_REQUEST["Id"] ) ? cleanString( $_REQUEST["Id"] )              : "";
        $Direccion = isset( $_REQUEST["Direccion"] ) ? cleanString( $_REQUEST["Direccion"] ): "";
        $Telefono  = isset( $_REQUEST["Telefono"] ) ? cleanString( $_REQUEST["Telefono"] )  : "";  
        $Codigo    = isset( $_REQUEST["Codigo_Postal"] ) ? cleanString( $_REQUEST["Codigo_Postal"] )      : "";    
        $Ciudad    = isset( $_REQUEST["Ciudad"] ) ? cleanString( $_REQUEST["Ciudad"] )      : "";    
        $Tipo      = isset( $_REQUEST["Tipo"] ) ? cleanString( $_REQUEST["Tipo"] )          : "";      
        $Precio    = isset( $_REQUEST["Precio"] ) ? cleanString( $_REQUEST["Precio"] )      : "";    
        $Status    = isset( $_REQUEST["state"] ) ? cleanString( $_POST["state"] )           : 1 ; 
        var_dump($Id, $Direccion,$Ciudad,$Telefono,$Codigo,$Tipo,$Precio,$Status);
        if ( !empty($Id) ) {
                $text = $category->insertAssets($Id, $Direccion,$Ciudad,$Telefono,$Codigo,$Tipo,$Precio,$Status); 
                echo $text ? "Bien registrado" : "No se pudo registrar el bien";
        }else{
                echo "Parametros erroneos para agregar el bien";
        }
        break;
    case 'update':
        if ( empty($Id) ) {
            $text = $category-updateAssets( $Id, $Direccion,$Ciudad,$Telefono,$Codigo,$Tipo,$Precio,$Status ); 
            echo $text ? "Bien Editado" : "No se pudo Editar el bien";
        }else{
            echo "El bien que sesea Eliminar no está registrado";
        }
        break;
    case 'delete':
        if ( empty($Id) ) {
            $text = $category->DeleteAssets($Id, $Status); 
            echo $text ? "Bien registrado" : "No se pudo registrar el bien";
        }else{
            echo "El bien que sesea Eliminar no está registrado";
        }
        break;
    
    case 'show':
            $text = $category->showAssetsList(); 
            echo $text ? json_encode( $text ) : "No hay datos registrados";
        break;
    case 'showJson':
        
        $data = file_get_contents("../data-1.json");
        echo( $data ? ( $data ) : "No hay data");
        
    break;
    case 'searchJson':
        $city         = $_REQUEST["Ciudad"];
        $tipe         = $_REQUEST["Tipo"];
        $new_json     = array();
        $datos_bienes = file_get_contents("../data-1.json");
        $json_bienes  = json_decode($datos_bienes);
        $flag = false;
        // var_dump( count($json_bienes) );
        for ($i=0; $i < count($json_bienes); $i++) { 
            $dataAsset = $json_bienes[$i];
            foreach ($dataAsset as $key => $value) {
                if (  $value == $tipe || $value == $city  ) {
                    $flag = true;
                }
            }
            if ( $flag ) {
                array_push( $new_json, $dataAsset );
                $flag = false;
            }
        }
        
        $data = $new_json;  
        print_r( $data ? json_encode( $data ) : "No hay data");

        break;
    case 'showList':
            $text = $category->showAssets(); 
            $data = array();
            
            while ($registro = $text->fetch_object() ) {
                $data[]=array(
                    "Id"            => $registro->id,
                    "Nombre"        => $registro->direccion,
                    "Telefono"      => $registro->Telefono,
                    "Codigo_postal" => $registro->codigo_postal,
                    "Tipo"          => $registro->tipo,
                    "Precio"        => $registro->precio,
                    "Estado"        => $registro->state,
                );

            }
            
            // var_dump($results);


            printf( $text ? json_encode( $data ) : "No hay data");
        
        break;
    
    default:
        break;
}