/** NOTE aquí se dejan  las variables de evento */
var formulario      = document.getElementById("formulario");
var tipoArrary      = [];
var ciudadArrary    = [];
var estructuraTotal = "";
var imagenes        = "";
imagenes            = '<div> <hr><img class = "'+'homeImage"'+' src = "'+'./public/img/home.jpg"'+' alt = "'+'image_of_home"></div>';
var inicio          = '<div class = "'+'texto"> <hr>';
var fin             = '</div>';
var dataTotal       = '';


/** SECTION fUNCION PARA FILTRAR EN EL JSON por ciudad  Y TIPO CON EL BOTON */


$("#submitButton").click( function() {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
    event.preventDefault();
    var Ciudad   = $("#selectCiudad").val()? $("#selectCiudad").val(): '';
    var Tipo     = $("#selectTipo").val() ? $("#selectTipo").val()   : '';
    var busqueda = {
        "Ciudad": Ciudad,
        "Tipo"  : Tipo
    }
    $.ajax({
        data    : busqueda,//enviamos los datos      
        url     : './private/ajax/category.php?operador=searchJson', //indicamos la ruta donde se genera la busqueda de los bienes
        tipe    : "POST",
        dataType : 'json',
        success: function(data) {
          arrayData( data, 0 );
         
        },
        error: function() {
            console.log("No se ha podido obtener la información de los bienes");
        }
    });
    
});    
$("#tabs a").click( function() { 
    if ( $("#tabs").tabs().context.activeElement.id == 'ui-id-1') {
        getDataJson();
    }else{

        $.ajax({
             url: './private/ajax/category.php?operador=showList', //indicamos la ruta donde se genera la busqueda de los bienes
             tipe    : "get",
             dataType: 'json',//indicamos que es de tipo Json
            success: function(respuesta) {
              arrayData( respuesta, 1 );
           },
             error: function() {
                   console.log("No se ha podido obtener la información de los bienes guardados");
           }
        });
    }
    
});   
/** SECTION fUNCION PARA FILTRAR EN EL la base de datos por pestaña */




/** SECTION ORGANIZAR LA FUNCIÓN DE BUSCAR DATOS CON EL JSON */

function iterativeData( data,tab ) {
    estructuraTotal = procesoIterativo( data , tab);  
    return estructuraTotal;
}
var prueba ="";
function procesoIterativo( data, tab ) {

    for (var i = 0; i < data.length; i++) {
        var element    = data[i];
        var estructura = "";
        for (var key in element){
          if (element.hasOwnProperty(key)) { //NOTE se controla que este elemento si tenga la propiedad en el key
              if ( key == 'Ciudad' ) {
                  if ( !ciudadArrary.includes( element[key]) ) {
                      ciudadArrary.push(element[key]);
                  }
              }
              if ( key == 'Tipo' ) {
                  if ( !tipoArrary.includes( element[key]) ) {
                      tipoArrary.push(element[key]);
                  }
              }
              estructura += '<b>' + key + ' :</b> '+ element[key]+ '<br>';
          }
        }
        
        var texto = estructura;
        if (tab) {
            estructuraTotal += imagenes + inicio + texto  + fin ;
        } else {
            estructuraTotal += imagenes + inicio + texto + '<button onclick="dataSave('+ i  +')"> GUARDAR </button>' + fin ;
        }
    }
    return estructuraTotal;
}

function dataSave( params ) {
    
    var dataAdd = dataTotal[params];
    $.ajax({
        data    : dataAdd,//enviamos los datos      
        url     : './private/ajax/category.php?operador=uno', //indicamos la ruta donde se genera la busqueda de los bienes
        tipe    : "POST",
        success: function(data) {
          alert( "Registro de la base de datos Correcto" );         
        },
        error: function() {
            alert( "Registro de la base de datos Correcto" );
        }
    });
}

function dataLocal( data ) {
    return data;
}
