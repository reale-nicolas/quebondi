<script>



function drawBusRoute(busRoute)
{
    var rutaBusCoordenadas = new Array(); 

    for (var j = 0; j < busRoute.length; j++) 
    {
        rutaBusCoordenadas[j] = {lat: busRoute[j].latitud, lng: busRoute[j].longitud};
    }

    return new google.maps.Polyline({
        path: rutaBusCoordenadas,
        map: map,
        geodesic: true,
        strokeColor: '#'+Math.floor(Math.random()*16777215).toString(16),
        strokeOpacity: 1.0,
        strokeWeight: 2
    });
}


function drawBusStops(busStop)
{
    var markers = [];
    for (var j = 0; j < busStop.length; j++) 
    {
        markers.push(
            new google.maps.Marker(
            {
                map: map,
                position: {lat: busStop[j].latitud, lng: busStop[j].longitud}
            })
        );
    }
    return markers;
}

function drawBusStopsAndRoute(number, letter, zone)
{
    for( var i = 0; i < arrMarksAndPathBusStopRoute.length; i++)
    {
        if ( arrMarksAndPathBusStopRoute[i][0] == number &&
             arrMarksAndPathBusStopRoute[i][1] == letter ) 
        {
            
            arrMarksAndPathBusStopRoute[i][4].setMap(map);
            
            for (var j = 0; j < arrMarksAndPathBusStopRoute[i][3].length; j++) 
            {
                arrMarksAndPathBusStopRoute[i][3][j].setMap(map);
            }     
        }
    }    
}



function cargarOpcionesMenuRecorridosXLinea(jsonResult)
    {
//        console.log(jsonResult);
        
        var lines = new Array();

        for (var i = 0; i < jsonResult.length; i++) 
        {
            var corredor = jsonResult[i];
          
            if (!Array.isArray(lines[[corredor.number, corredor.letter]]))
                lines[[corredor.number, corredor.letter]] = new Array();
            lines[[corredor.number, corredor.letter]].push(corredor.zone);
 
        }
        
        
        var divElementMenuContent = document.getElementById("divRecorridosLineaList");
        divElementMenuContent.innerHTML = '';
        
        
        for (var index in lines) 
        {
//            console.log("Element: "+lines[index]+" - Index: "+index);
            
            var arrCorredor     = index.split(",");
            var corredorName    = arrCorredor[0];
            var ramalName       = arrCorredor[1];
//            var corredorName = corredor.name;
            
//            console.log( corredorName+ramalName);

            var aElement = document.getElementById("a-corredor-"+corredorName);
            
            if(aElement === null && typeof aElement === "object")
            {
                aElement = document.createElement("a");
                aElement.setAttribute("id", "a-corredor-"+corredorName);
                aElement.setAttribute("href", "#");
                aElement.setAttribute("class","w3-bar-item w3-button");
                aElement.setAttribute("onclick","$('#div-corredor-"+corredorName+"').toggleClass('w3-hide');");
                
                var iElement = document.createElement("i");
                iElement.setAttribute("class","fa fa-bus w3-margin-right");

                var spanElement = document.createElement("span");
                spanElement.innerHTML = "Línea "+corredorName;

                aElement.appendChild(iElement);
                aElement.appendChild(spanElement);

                divElementMenuContent.appendChild(aElement);
                
                var divElement = document.createElement("div");
                divElement.setAttribute("id", "div-corredor-"+corredorName);
                divElement.setAttribute("class", "w3-hide");

                var ulElement = document.createElement("ul");
                ulElement.setAttribute("id", "ul-corredor-"+corredorName);
                ulElement.setAttribute("class", "w3-ul w3-right");
                ulElement.setAttribute("style", "width:90%");
                
            } else {
                
                var divElement = document.getElementById("div-corredor-"+corredorName);
            
                var ulElement = document.getElementById("ul-corredor-"+corredorName);
            }
            
            
            
            
                
            
                
                var liElement       = document.createElement("li");
                liElement.setAttribute("id","li-corredor-"+corredorName+"-ramal-"+ramalName);
                liElement.setAttribute("class","w3-padding-16");
                liElement.setAttribute("style","cursor:pointer;");
                liElement.setAttribute("onclick","selectRamalMenuItems('"+corredorName+"','"+ramalName+"')");
                liElement.onmouseover = function(){this.style.backgroundColor = "#d3f9ec";};
                liElement.onmouseout  = function(){this.style.backgroundColor = "#ffffff";};
                var spanElement     = document.createElement("span");
                spanElement.setAttribute("class","w3-button w3-white w3-right");
                spanElement.setAttribute("style", "padding: 0px;height: 20px;");
            
            
                var inputElement    = document.createElement("input");
                inputElement.setAttribute("type", "checkbox");
                inputElement.setAttribute("class", "w3-check");
                inputElement.setAttribute("style","cursor:pointer;margin:0px;top:0px;width:20px;height:20px;");
                
                
//                var recorridoStr = '{"lines":[';
//                var esPrimero = true;
//                for (var k = 0; k < ramal.stop.length; k++) 
//                {
//                    if (!esPrimero)
//                        recorridoStr += ', ';
//                    recorridoStr += '{"latitud":'+ramal.stop[k].latitud+', "longitud":'+ramal.stop[k].longitud+'}';
//                    esPrimero = false;
//                }
//                recorridoStr += ']}';
////var recorridoStr = '{"lines":"1"}';
//                inputElement.setAttribute("stops",recorridoStr);
                
                
                var imgElement      = document.createElement("img");
                imgElement.setAttribute("class","w3-left w3-margin-right");
                imgElement.setAttribute("style","width:30px");
                imgElement.setAttribute("src","<?php echo e(URL::asset('images/')); ?>/"+corredorName+ramalName+".png");
                var span1Element    = document.createElement("span");
                span1Element.innerHTML = "Ramal "+ramalName;
                
            
                spanElement.appendChild(inputElement);
                liElement.appendChild(spanElement);
                liElement.appendChild(imgElement);
                liElement.appendChild(span1Element);
                
                ulElement.appendChild(liElement);
            
            
            
            
            
            divElement.appendChild(ulElement);
            divElementMenuContent.appendChild(divElement);
        }
        
    } 
    
    
    
    
    function cargarOpcionesMenuRecorridosXLinea123Back(jsonResult)
    {
        console.log(jsonResult);
        
        var lines = new Array();
        
        for (var i = 0; i < jsonResult.length; i++) 
        {
            var corredor = jsonResult[i];
          
            if (!Array.isArray(lines[[corredor.number, corredor.letter]]))
                lines[[corredor.number, corredor.letter]] = new Array();
            lines[[corredor.number, corredor.letter]].push(corredor.zone);
 
        }
        console.log(lines);
        
        var divElementMenuContent = document.getElementById("divRecorridosLineaList");
        divElementMenuContent.innerHTML = '';
            
        for (var i = 0; i < jsonResult.length; i++) 
        {
            var corredor = jsonResult[i];
            var corredorName = corredor.name;
            
            console.log("Corredor: "+corredorName + corredor );
            
            var aElement = document.createElement("a");
            aElement.setAttribute("id", "a-corredor-"+corredorName);
            aElement.setAttribute("href", "#");
            aElement.setAttribute("class","w3-bar-item w3-button");
            aElement.setAttribute("onclick","$('#div-corredor-"+corredorName+"').toggleClass('w3-hide');");
            
            var iElement = document.createElement("i");
            iElement.setAttribute("class","fa fa-bus w3-margin-right");
            
            var spanElement = document.createElement("span");
            spanElement.innerHTML = "Línea "+corredorName;
            
            aElement.appendChild(iElement);
            aElement.appendChild(spanElement);
            
            divElementMenuContent.appendChild(aElement);
            
            var divElement = document.createElement("div");
            divElement.setAttribute("id", "div-corredor-"+corredorName);
            divElement.setAttribute("class", "w3-hide");
            
            var ulElement = document.createElement("ul");
            ulElement.setAttribute("class", "w3-ul w3-right");
            ulElement.setAttribute("style", "width:90%");
                
            for (var j = 0; j < corredor.ramals.length; j++) 
            {
                var ramal = corredor.ramals[j];
                var ramalName       = ramal.name;
                
                var liElement       = document.createElement("li");
                liElement.setAttribute("id","li-corredor-"+corredorName+"-ramal-"+ramalName);
                liElement.setAttribute("class","w3-padding-16");
                liElement.setAttribute("style","cursor:pointer;");
                liElement.setAttribute("onclick","selectRamalMenuItems('"+corredorName+"','"+ramalName+"')");
                liElement.onmouseover = function(){this.style.backgroundColor = "#d3f9ec";};
                liElement.onmouseout  = function(){this.style.backgroundColor = "#ffffff";};
                var spanElement     = document.createElement("span");
                spanElement.setAttribute("class","w3-button w3-white w3-right");
                spanElement.setAttribute("style", "padding: 0px;height: 20px;");
                var inputElement    = document.createElement("input");
                inputElement.setAttribute("type", "checkbox");
                inputElement.setAttribute("class", "w3-check");
                inputElement.setAttribute("style","cursor:pointer;margin:0px;top:0px;width:20px;height:20px;");
                
                var recorridoStr = '{"lines":[';
                var esPrimero = true;
                for (var k = 0; k < ramal.stop.length; k++) 
                {
                    if (!esPrimero)
                        recorridoStr += ', ';
                    recorridoStr += '{"latitud":'+ramal.stop[k].latitud+', "longitud":'+ramal.stop[k].longitud+'}';
                    esPrimero = false;
                }
                recorridoStr += ']}';
//var recorridoStr = '{"lines":"1"}';
                inputElement.setAttribute("stops",recorridoStr);
                
                var imgElement      = document.createElement("img");
                imgElement.setAttribute("class","w3-left w3-margin-right");
                imgElement.setAttribute("style","width:30px");
                imgElement.setAttribute("src","<?php echo e(URL::asset('images/')); ?>/"+corredorName+ramalName+".png");
                var span1Element    = document.createElement("span");
                span1Element.innerHTML = "Ramal "+ramalName;
             
                spanElement.appendChild(inputElement);
                liElement.appendChild(spanElement);
                liElement.appendChild(imgElement);
                liElement.appendChild(span1Element);
                
                ulElement.appendChild(liElement);
            }
            divElement.appendChild(ulElement);
            divElementMenuContent.appendChild(divElement);
        }
        /*
        <a href="#" class="w3-bar-item w3-button"><i class="fa fa-bus w3-margin-right"></i>Corredor 1</a>
        <div>
            <ul class="w3-ul w3-right" style="width:90%">
                <li class="w3-padding-16">
                    <span class="w3-button w3-white w3-right" style="padding: 0px;">
                        <input type="checkbox" onchange="getLines()"></input>
                    </span>
                    <img src="<?php echo e(URL::asset('images/saeta_1a.png')); ?>" class="w3-left w3-margin-right" style="width:30px">
                    <span class="">Corredor 1A</span><br>
                </li>
                <li class="w3-padding-16">
                    <span class="w3-button w3-white w3-right" style="padding: 0px;">
                        <input type="checkbox"></input>
                    </span>
                    <img src="<?php echo e(URL::asset('images/saeta_1b.png')); ?>" class="w3-left w3-margin-right" style="width:30px">
                    <span class="">Corredor 1B</span><br>
                </li>
                <li class="w3-padding-16">
                    <span class="w3-button w3-white w3-right" style="padding: 0px;">
                        <input type="checkbox"></input>
                    </span>
                    <img src="<?php echo e(URL::asset('images/saeta_1c.png')); ?>" class="w3-left w3-margin-right" style="width:30px">
                    <span class="">Corredor 1C</span><br>
                </li>
            </ul>
        </div>
        */
        
        //cajadatos.innerHTML=e.target.responseText; 
    } 
    




        
        
//        console.log(jsonRecorrido);
//        
//        drawBusesStops(jsonRecorrido.lines);

   
    
    
    function addMarker(place)
    {
        var marker = new google.maps.Marker(
        {
            map: map
        });

        if (typeof place.geometry !== 'undefined'){
            marker.setPosition(place.geometry.location);
        } else {
            marker.setPosition(place);
        }
        marker.setVisible(true);

        return marker;
    }

    function unsetVaribales(tipoDireccion)
    {
        if (typeof arrMarker[tipoDireccion] !== 'undefined' && arrMarker[tipoDireccion] !== null)
            arrMarker[tipoDireccion].setVisible(false);
        arrMarker[tipoDireccion] = null;

        for (var component in componentForm)
        {
            document.getElementById(tipoDireccion + "-" + component).value = '';
        }
        document.getElementById(tipoDireccion + "-latitud").value = '';
        document.getElementById(tipoDireccion + "-longitud").value = '';

        return;
    }


    

    $(document).ready(function ()
    {
        $("#origen-input").focus();
        $("input").bind(
                {
                    "paste": function ()
                    {
                        var tipoDireccion;
                        if ($(this).attr("id") === "origen-input")
                        {
                            tipoDireccion = "origen";
                        } else if ($(this).attr("id") === "destino-input")
                        {
                            tipoDireccion = "destino";
                        } else
                            return;

                        unsetVaribales(tipoDireccion);

                    },
                    click: function ()
                    {
                        $(this).select();
                    },
                    blur: function ()
                    {
                        var tipoDireccion;
                        if ($(this).attr("id") === "origen-input")
                        {
                            tipoDireccion = "origen";
                        } else if ($(this).attr("id") === "destino-input")
                        {
                            tipoDireccion = "destino";
                        }

                        if (($(this).attr("id") === "origen-input") || ($(this).attr("id") === "destino-input"))
                        {
                            manageInputsClass(tipoDireccion);
                        } else if ($(this).attr("id") === "distancia-input")
                        {
                            //Seteamos el rectangulo del mapa que se cargara al momento del inicio.
                            var boundsqq;
                            if (arrMarker["destino"].position.lng() > arrMarker["origen"].position.lng()) {
                                boundsqq = new google.maps.LatLngBounds(
                                        new google.maps.LatLng(arrMarker["origen"].position.lat(), arrMarker["origen"].position.lng()),
                                        new google.maps.LatLng(arrMarker["destino"].position.lat(), arrMarker["destino"].position.lng())
                                        );
                                map.fitBounds(boundsqq);
                            } else {
                                boundsqq = new google.maps.LatLngBounds(
                                        new google.maps.LatLng(arrMarker["destino"].position.lat(), arrMarker["destino"].position.lng()),
                                        new google.maps.LatLng(arrMarker["origen"].position.lat(), arrMarker["origen"].position.lng())
                                        );
                                map.fitBounds(boundsqq);
                            }

                        }
                    }

                });
        // Handler for .ready() called.
        var arrScreenDimension = getWidthAndHeightScreen();
        document.getElementById("map").style.height = arrScreenDimension.height + "px";
    });

    function manageInputsClass(tipoDireccion)
    {
        if ($("#" + tipoDireccion + "-input").val() === "")
        {
            //Las latitudes coinciden
            $("#" + tipoDireccion + "-input").parent().removeClass("has-error");
            $("#" + tipoDireccion + "-input").parent().removeClass("has-success");
            $("#" + tipoDireccion + "-input").next().removeClass("glyphicon-warning-sign");
            $("#" + tipoDireccion + "-input").next().removeClass("glyphicon-ok");
            $("#" + tipoDireccion + "-input").next().addClass("hide");
            return;
        } else {
            $.getJSON("http://maps.google.com/maps/api/geocode/json?address=" + $("#" + tipoDireccion + "-input").val(), function (data)
            {
                if (data.status === "OK") {
                    var valueInput = Number(document.getElementById(tipoDireccion + "-latitud").value);

                    console.log(Number(data.results[0].geometry.location.lat.toFixed(3)));
                    console.log(Number(valueInput.toFixed(3)));

                    if (Number(data.results[0].geometry.location.lat.toFixed(3)) === Number(valueInput.toFixed(3)))
                    {
                        //Las latitudes coinciden
                        $("#" + tipoDireccion + "-input").parent().removeClass("has-error");
                        $("#" + tipoDireccion + "-input").parent().addClass("has-success");
                        $("#" + tipoDireccion + "-input").next().removeClass("glyphicon-warning-sign");
                        $("#" + tipoDireccion + "-input").next().addClass("glyphicon-ok");
                        $("#" + tipoDireccion + "-input").next().removeClass("hide");
                    } else {
                        //Las latitudes no coinciden
                        $("#" + tipoDireccion + "-input").parent().removeClass("has-success");
                        $("#" + tipoDireccion + "-input").parent().addClass("has-error");
                        $("#" + tipoDireccion + "-input").next().removeClass("glyphicon-ok");
                        $("#" + tipoDireccion + "-input").next().addClass("glyphicon-warning-sign");
                        $("#" + tipoDireccion + "-input").next().removeClass("hide");
                    }
                } else {
                    //No hubo resultados en el JSON
                    $("#" + tipoDireccion + "-input").parent().removeClass("has-success");
                    $("#" + tipoDireccion + "-input").parent().addClass("has-error");
                    $("#" + tipoDireccion + "-input").next().removeClass("glyphicon-ok");
                    $("#" + tipoDireccion + "-input").next().addClass("glyphicon-warning-sign");
                    $("#" + tipoDireccion + "-input").next().removeClass("hide");
                }

            });
        }
    }

    function investAdsress()
    {
        var valoresAux = [];

        for (var component in componentForm)
        {
            valoresAux["origen-" + component] = document.getElementById("origen-" + component).value;
            document.getElementById("origen-" + component).value = document.getElementById("destino-" + component).value;
            document.getElementById("destino-" + component).value = valoresAux["origen-" + component];
        }
        valoresAux["origen-latitud"] = document.getElementById("origen-latitud").value;
        valoresAux["origen-longitud"] = document.getElementById("origen-longitud").value;

        document.getElementById("origen-latitud").value = document.getElementById("destino-latitud").value;
        document.getElementById("origen-longitud").value = document.getElementById("destino-longitud").value;

        document.getElementById("destino-latitud").value = valoresAux["origen-latitud"];
        document.getElementById("destino-longitud").value = valoresAux["origen-longitud"];

        valoresAux["destino-input"] = document.getElementById("destino-input").value;
        document.getElementById("destino-input").value = document.getElementById("origen-input").value;
        document.getElementById("origen-input").value = valoresAux["destino-input"];
    }

    function getWidthAndHeightScreen()
    {
        var myWidth = 0, myHeight = 0;
        if (typeof (window.innerWidth) === 'number')
        {
            //No-IE 
            myWidth = window.innerWidth;
            myHeight = window.innerHeight;
        } else if (document.documentElement &&
                (document.documentElement.clientWidth || document.documentElement.clientHeight))
        {
            //IE 6+ 
            myWidth = document.documentElement.clientWidth;
            myHeight = document.documentElement.clientHeight;
        } else if (document.body && (document.body.clientWidth || document.body.clientHeight))
        {
            //IE 4 compatible 
            myWidth = document.body.clientWidth;
            myHeight = document.body.clientHeight;
        } else
        {
            myWidth = 600;
            myHeight = 800;
            alert("Imposible determinar alto y ancho de la pantalla");
        }

        var windowProperties = {
            "width": myWidth,
            "height": myHeight
        };

        return windowProperties;
    }

    //ubicación geográfica del usuario,
    function getLocation()
    {
        if (navigator.geolocation) {
            var options = {
                enableHighAccuracy: true,
                //timeout: 15000,
                maximumAge: 0
            };
            navigator.geolocation.watchPosition(
                function(position) {setCurrentLocationfunction(position);},
                function(position) {errorCurrentLocationfunction(position);},
                options
            );
            navigator.geolocation.watchPosition(
                function(position) {setCurrentLocationfunction(position);},
                function(position) {errorCurrentLocationfunction(position);},
                options
            );
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    
    function setCurrentLocationfunction(position)
    {
        alert("Error al buscar su ubicacion. Lat: " + position.coords.latitude + "Lon: " + position.coords.longitude);
        console.log("Lat: " + position.coords.latitude + "Lon: " + position.coords.longitude);
        console.log('More or less ' + position.coords.accuracy + ' meters.');
    }

    function setCurrentLocationfunction(position)
    {
        console.log("Lat: " + position.coords.latitude + "Lon: " + position.coords.longitude);
        console.log('More or less ' + position.coords.accuracy + ' meters.');
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        var latlng = new google.maps.LatLng(lat, lng);

        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'latLng': latlng}, function (results, status)
        {

            map.setZoom(16);
            marker = new google.maps.Marker({
                position: latlng,
                map: map
            });
            map.setCenter(latlng);
            arrMarker["origen"] = marker;
        });
//                    else {
//                      
//                      console.log("Hubo un error en 2");
//                    }
//                  } else {
//                      console.log("Hubo un error en 1");
//                  }
//                });
//                var pos = {
//                  lat: position.coords.latitude,
//                  lng: position.coords.longitude
//                };
//                map.setZoom(16);
//                map.setCenter(pos);
    }


    function showPosition(position) {
        map.setCenter(position.geometry.location);
        map.setZoom(16);
        console.log("Lat: " + position.coords.latitude + "Lon: " + position.coords.longitude);
    }

var styledMapType = new google.maps.StyledMapType(
[
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#ebe3cd"
      }
    ]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#523735"
      }
    ]
  },
  {
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#f5f1e6"
      }
    ]
  },
  {
    "featureType": "administrative",
    "elementType": "geometry",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#c9b2a6"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#dcd2be"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#ae9e90"
      }
    ]
  },
  {
    "featureType": "landscape.natural",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#dfd2ae"
      }
    ]
  },
  {
    "featureType": "poi",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#dfd2ae"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#93817c"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#a5b076"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#447530"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#f5f1e6"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "road.arterial",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#fdfcf8"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#f8c967"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#e9bc62"
      }
    ]
  },
  {
    "featureType": "road.highway.controlled_access",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#e98d58"
      }
    ]
  },
  {
    "featureType": "road.highway.controlled_access",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#db8555"
      }
    ]
  },
  {
    "featureType": "road.local",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#806b63"
      }
    ]
  },
  {
    "featureType": "transit",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "transit.line",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#dfd2ae"
      }
    ]
  },
  {
    "featureType": "transit.line",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#8f7d77"
      }
    ]
  },
  {
    "featureType": "transit.line",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#ebe3cd"
      }
    ]
  },
  {
    "featureType": "transit.station",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#dfd2ae"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#b9d3c2"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#92998d"
      }
    ]
  },
  {name: 'Styled Map'}
]);
</script>



<!--<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3FxKEgf10vNGHSUUYms4rl8cusliiVgM&libraries=geometry,places&callback=initApp">
</script>-->
<!--<script type="text/javascript" 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0edpv6HYuNgDCW-IQ4ivoCQSLrBtM11s&libraries=places"></script>-->

