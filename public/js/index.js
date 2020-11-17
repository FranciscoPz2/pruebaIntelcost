var dataJson  = $("#dataJson");
var dataQuery = $("#dataQuery");

/*
  Creación de una función personalizada para jQuery que detecta cuando se detiene el scroll en la página
*/
$.fn.scrollEnd = function(callback, timeout) {
  $(this).scroll(function(){
    var $this = $(this);
    if ($this.data('scrollTimeout')) {
      clearTimeout($this.data('scrollTimeout'));
    }
    $this.data('scrollTimeout', setTimeout(callback,timeout));
  });
};
/*
  Función que inicializa el elemento Slider
*/

function inicializarSlider(){
  $("#rangoPrecio").ionRangeSlider({
    type: "double",
    grid: false,
    min: 0,
    max: 100000,
    from: 200,
    to: 80000,
    prefix: "$"
  });
}
/*
  Función que reproduce el video de fondo al hacer scroll, y deteiene la reproducción al detener el scroll
*/
function playVideoOnScroll(){
  var ultimoScroll = 0,
      intervalRewind;
  var video = document.getElementById('vidFondo');
  $(window)
    .scroll((event)=>{
      var scrollActual = $(window).scrollTop();
      if (scrollActual > ultimoScroll){
       
     } else {
        //this.rewind(1.0, video, intervalRewind);
        video.play();
     }
     ultimoScroll = scrollActual;
    })
    .scrollEnd(()=>{
      video.pause();
    }, 10)
}
/** NOTE el proyecto inicial va hasta esta linea */

/** SECTION llamado a archivos y base de datos por AJAX */
function getDataJson(){
  var data = $.ajax({
    url: './private/ajax/category.php?operador=showJson', //indicamos la ruta donde se genera el Json de datos 
    tipe    : "get",
    dataType: 'json',//indicamos que es de tipo JSON
    success: function(respuesta) {
      arrayData( respuesta, 0 );
    },
    error: function() {ç
          console.log("No se ha podido obtener la información de los bienes pre cargados");
    }
  });
}


function getDataAJAX() {
  
}

/** SECTION Estructuracion de archivo JSon para modificarse */
function arrayData( data, tab ){
    dataTotal = dataLocal( data );
    estructuraTotal = '';
    var selectionCity = $('#selectCiudad');
    var selectionTipe = $('#selectTipo');
    selectionCity.empty();
    selectionTipe.empty();
    selectionCity.append('<option value="">Elige un tipo</option>');
    selectionTipe.append('<option value="">Elige un tipo</option>');
    dataJson.html(estructuraTotal);
    estructuraTotal=iterativeData( data,tab );
    // console.log( "la estructura", estructuraTotal );
    for (let i = 0; i < ciudadArrary.length; i++) {
      const element = ciudadArrary[i];
      $('#selectCiudad').append('<option value="'+element+'">'+element+'</option>');
    }
    for (let i = 0; i < tipoArrary.length; i++) {
      const element = tipoArrary[i];
      $('#selectTipo').append('<option value="' + element+'">' + element+'</option>');
    }
    if ( tab ) {
      document.getElementById("cantidadGuardados").innerHTML =  data.length;
      dataQuery.html(estructuraTotal);
    }else{
      dataJson.html(estructuraTotal);
      document.getElementById("cantidad").innerHTML =  data.length;
    }
   
}




/** SECTION Inicializador de Funciones */
getDataJson();
getDataAJAX();
inicializarSlider();
playVideoOnScroll();


