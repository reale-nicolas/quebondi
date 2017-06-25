

<script>
    var map;
    var arrMarker = [];
    var arrAutocomplete = [];
    var arrInput = [];
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };


    function initializeApplication()
    {
        initializeMap();
//   
//             initializeAutocompleteInput();
        setTimeout(intializeRecorridosList, 2500);
        
    }
    
    
    function initializeMap()
    {
        var mapTypeIds = [];
        mapTypeIds.push("GoogleRoadMaps");
    
        //Iniciamos un nuevo mapa
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: new google.maps.LatLng(-24.7931342, -65.4303173),
            streetViewControl: false,
            mapTypeControl: true,
            mapTypeId: "GoogleRoadMaps",
            mapTypeControlOptions: {
                mapTypeIds: mapTypeIds,
                position: google.maps.ControlPosition.TOP_RIGHT
            }
        });

        map.mapTypes.set("GoogleRoadMaps", new google.maps.ImageMapType({
            getTileUrl: function (coord, zoom) {

                return "http://localhost/mapas_ciudades/salta/" + zoom + "/" + coord.x + "/" + coord.y + ".png";
            },
            tileSize: new google.maps.Size(256, 256),
            name: "GoogleRoadMaps",
            maxZoom: 17
        }));
    
        //Seteamos el rectangulo del mapa que se cargara al momento del inicio.
        //        var bounds = new google.maps.LatLngBounds(
        //                new google.maps.LatLng(-24.578060, -65.684399),
        //                new google.maps.LatLng(-25.171035, -65.266363)
        //                );
        //        map.fitBounds(bounds);
    }
    
    
    
    function initializeAutocompleteInput()
    {
        arrInput['origen'] = document.getElementById('origen-input');
        arrInput['destino'] = document.getElementById('destino-input');
        var options = {
            types: ['address'],
            componentRestrictions: {country: 'ar'}
        };

        //event fired when user selects direction from list direction.
        //Here we have to make a marker into maps showing the point selected by user.
        arrAutocomplete['origen'] = new google.maps.places.Autocomplete(arrInput['origen'], options);
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


    function intializeRecorridosList()
    {
        $.ajax(
            {
                type: "GET",
                url: "{{ URL::asset('resources/getlines.json') }}",
                cache: false
            }).done(function(JSONResult) {
                cargarOpcionesMenuRecorridosXLinea(JSONResult);
            });
            
//         var url = "http://quebondi.app/resources/getlines.json";  
//         var solicitud = new XMLHttpRequest();
//         
//         solicitud.addEventListener('load', mostrar, false);
//         solicitud.open("GET", url, true);  
//         solicitud.send(null); 
    }
    
    function cargarOpcionesMenuRecorridosXLinea(jsonResult)
    {
        console.log(jsonResult);
        console.log(jsonResult.lines);
        var divElementMenuContent = document.getElementById("divRecorridosLineaList");
        divElementMenuContent.innerHTML = '';
            
        for (var i = 0; i < jsonResult.lines.length; i++) 
        {
            var corredor = jsonResult.lines[i];
            var corredorName = corredor.name;
            
            console.log("Corredor: "+corredorName + corredor );
            
            var aElement = document.createElement("a");
            aElement.setAttribute("id", "a-corredor-"+corredorName);
            aElement.setAttribute("href", "#");
            aElement.setAttribute("class","w3-bar-item w3-button");
            aElement.setAttribute("onclick","showHideMenuOption('div-corredor-"+corredorName+"',null)");
            
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
                var imgElement      = document.createElement("img");
                imgElement.setAttribute("class","w3-left w3-margin-right");
                imgElement.setAttribute("style","width:30px");
                imgElement.setAttribute("src","{{ URL::asset('images/') }}/"+corredorName+ramalName+".png");
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
                    <img src="{{ URL::asset('images/saeta_1a.png') }}" class="w3-left w3-margin-right" style="width:30px">
                    <span class="">Corredor 1A</span><br>
                </li>
                <li class="w3-padding-16">
                    <span class="w3-button w3-white w3-right" style="padding: 0px;">
                        <input type="checkbox"></input>
                    </span>
                    <img src="{{ URL::asset('images/saeta_1b.png') }}" class="w3-left w3-margin-right" style="width:30px">
                    <span class="">Corredor 1B</span><br>
                </li>
                <li class="w3-padding-16">
                    <span class="w3-button w3-white w3-right" style="padding: 0px;">
                        <input type="checkbox"></input>
                    </span>
                    <img src="{{ URL::asset('images/saeta_1c.png') }}" class="w3-left w3-margin-right" style="width:30px">
                    <span class="">Corredor 1C</span><br>
                </li>
            </ul>
        </div>
        */
        
        //cajadatos.innerHTML=e.target.responseText; 
    } 
    
    function selectRamalMenuItems(corredorName, ramalName)
    {
        var checkbox = document.getElementById("li-corredor-"+corredorName+"-ramal-"+ramalName).getElementsByTagName('input')[0];
        
        if (checkbox.checked)
        {
            checkbox.checked = false;
        }
        else
        {
            checkbox.checked = true;
        }
        
    }
    
    function addMarker(place)
    {
        var marker = new google.maps.Marker(
                {
                    map: map
                });

        marker.setIcon(/** @type {google.maps.Icon} */(
                {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));

        marker.setPosition(place.geometry.location);
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
        if (place.geometry.viewport)
        {
            map.fitBounds(place.geometry.viewport);
        } else
        {
            map.setCenter(place.geometry.location);
            map.setZoom(16);
        }


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
        document.getElementById(tipoDireccion + "-latitud").value = place.geometry.location.lat();
        document.getElementById(tipoDireccion + "-longitud").value = place.geometry.location.lng();



        arrMarker[tipoDireccion] = addMarker(place);

        console.log(JSON.stringify(place));
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
        document.getElementById("map").style.height = (arrScreenDimension.height - $('#header').height()) + "px";
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

</script>

<script async defer
        src="{{ URL::asset('js/maps.googleapis.js') }}?key=AIzaSyB3FxKEgf10vNGHSUUYms4rl8cusliiVgM&libraries=geometry,places">
</script>

<!--<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3FxKEgf10vNGHSUUYms4rl8cusliiVgM&libraries=geometry,places&callback=initApp">
</script>-->
<!--<script type="text/javascript" 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0edpv6HYuNgDCW-IQ4ivoCQSLrBtM11s&libraries=places"></script>-->

