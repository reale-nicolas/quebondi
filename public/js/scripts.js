var map;
var arrMarker = [];
var arrAutocomplete = [];
var arrInput = [];

var marker;
var infowindow;


var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};

var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

function initializeApplication()
{
    initializeMap();
    initializeAutocompleteMenu();
    initializeRecorridosMenu();
}
    
    
function initializeMap()
{
    //Iniciamos el mapa
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: new google.maps.LatLng(-24.7931342, -65.4303173),
        streetViewControl: false,
        mapTypeControl: false,
        mapTypeControlOptions: {
            mapTypeIds: ['styled_map']
        }
    });

    //Associate the styled map with the MapTypeId and set it to display.
    map.mapTypes.set('styled_map', styledMapType);
    map.setMapTypeId('styled_map');
    
    infowindow = new google.maps.InfoWindow();
    marker = new google.maps.Marker(
    {
        map: map
    });
    
    
    if(  isMobile.any() !== null ) 
    {
        google.maps.event.addListener(map, 'dblclick', function(mouseEvent) 
        {
            displayMenuOptionOnMap(mouseEvent.latLng);
            mouseEvent.preventDefault();
            return;
        });
    } 
    else 
    {
        map.addListener('rightclick', function(mouseEvent) 
        {
            displayMenuOptionOnMap(mouseEvent.latLng);
        });
    }
}
    
    
    
    function initializeAutocompleteMenu()
    {
        //Cuadricula en la que debe priorizar las busquedas google del autocmpletado
        var defaultBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(-24.675531, -65.593153),
            new google.maps.LatLng(-24.948735, -65.329512)
        );

        //Seteamos la cuadricula, limitamos resultados a Argentina e indicamos que se buscaran direcciones
        var options = {
            types: ['address'],
            bounds: defaultBounds,
            componentRestrictions: {
                country: 'ar'
            }
        };
        
        arrInput['origen'] = document.getElementById('origen-input');
        arrInput['destino'] = document.getElementById('destino-input');
        

        //event fired when user selects direction from list direction.
        //Here we have to make a marker into maps showing the point selected by user.
        arrAutocomplete['origen'] = new google.maps.places.Autocomplete(arrInput['origen'], options);
        //arrAutocomplete['origen'].bindTo('bounds', map);
        
        google.maps.event.addListener(arrAutocomplete['origen'], 'place_changed', function ()
        {
            onPlaceListItemSelected(arrAutocomplete['origen'].getPlace(), "origen");
        });


        arrAutocomplete['destino'] = new google.maps.places.Autocomplete(arrInput['destino'], options);
        google.maps.event.addListener(arrAutocomplete['destino'], 'place_changed', function ()
        {
            onPlaceListItemSelected(arrAutocomplete['destino'].getPlace(), "destino");
        });
    }


    function initializeRecorridosMenu()
    {
        $.ajax(
        {
            url: "http://api_quebondi.app/api/lines",
            type: 'GET',
            async: false,
            jsonpCallback: 'cargarOpcionesMenuRecorridosXLinea',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function(JSONResult) {
                JSONPcallback(JSONResult);
//               cargarOpcionesMenuRecorridosXLinea(JSONResult);
            },
            error: function(e) {
               console.log(e.message);
            }
        });
    }
    
   
   function JSONPcallback(jsonResponse){
//       console.log(jsonResponse);
   }
    
    function displayMenuOptionOnMap(latlng)
    {
        marker.setPosition(latlng);
        marker.setVisible(true);

        var geocoder = new google.maps.Geocoder;
        geocoder.geocode({'location': latlng}, function(results, status) 
        {
            if (status === 'OK') 
            {
                if (results[0]) 
                {
                    console.log(results[0]);
                    var street = getAddressComponenet(results[0], "route");
                    var door_number = getAddressComponenet(results[0], "street_number");
                    var locality = getAddressComponenet(results[0], "administrative_area_level_2");
                    var province = getAddressComponenet(results[0], "administrative_area_level_1");
                    
                    var placeId = results[0].place_id;
                    
                    if (street === "Unnamed Road") {
                        street = "Calle S/N";
                    }
                    if (door_number === null) {
                        door_number = "S/N";
                    }
                    if (locality === null) {
                        locality = "";
                    }
                    if (province === null) {
                        province = "";
                    }
                    
                    infowindow.setContent('\
                        <div class="" style="min-width:200px">'+
                            '<strong>'+
                                street +' '+ door_number +' - ' +
                                locality +
                            '</strong><br>' +
                            results[0].geometry.location + '<br><br>' +
                            '<div class="col-xs-6 text-left"><a href="#" role="button" onclick="setOrigenDestino(\''+placeId+'\', \'origen\')">Desde aqui</a></div>'+
                            '<div class="text-right"><a href="#" role="button" onclick="setOrigenDestino(\''+placeId+'\', \'destino\')">Hasta aqui</a></div>'+
                        '</div>'
                    );
                    infowindow.open(map, marker);
                } else {
                    window.alert('No results found');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
        });
    }
    
    function setOrigenDestino(placeId, origenDestino)
    {
        var request = {
            placeId: placeId
        };
        var service = new google.maps.places.PlacesService(map);
        service.getDetails(request, function(place, status){
            infowindow.close();
            onPlaceListItemSelected(place, origenDestino);
        });
        
    }
    
    
    function getAddressComponenet(address, component)
    {
        for (var i=0; i<address.address_components.length; i++) {
            for (var j=0; j<address.address_components[i].types.length; j++) {
                console.log(address.address_components[i].types[j]);
                if (address.address_components[i].types[j] === component) {
                    return address.address_components[i].long_name;
                }
            }
        }
        return null;
    }
    
    
    function onPlaceListItemSelected(place, tipoDireccion)
    {
//        var place = inputAddress.getPlace();
        //Verificamos que la varibale tipoDireccion se encuentre seteada
        //y que su valor pertenezca a los valores aceptados.
        if ((tipoDireccion !== 'origen' && tipoDireccion !== 'destino') || (!place.geometry))
        {
            return null;
        }
        //Limpiamos los valores que puedan tener los campos de direccion, pues se deben rellenar 
        //con la nueva direccion seleccionada.
        unsetVaribales(tipoDireccion);

        // If the place has a geometry, then present it on a map.
//        if (place.geometry.viewport)
//        {
//            map.fitBounds(place.geometry.viewport);
//        } else
//        {
            map.setCenter(place.geometry.location);
//            map.setZoom(16);
//        }


        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++)
        {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType])
            {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(tipoDireccion + "-" + addressType).value = val;
            }
        }
        document.getElementById(tipoDireccion + "-input").value = place.formatted_address;
        document.getElementById(tipoDireccion + "-latitud").value = place.geometry.location.lat();
        document.getElementById(tipoDireccion + "-longitud").value = place.geometry.location.lng();



        arrMarker[tipoDireccion] = marker;
        marker = new google.maps.Marker(
        {
            map: map
        });

        console.log(JSON.stringify(place));
    }