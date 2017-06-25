<!DOCTYPE html>
<html>
    <head>
        <title>Que bondi Web</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="stylesheet" href="{{ URL::asset('css/sidebar.css') }}">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://code.jquery.com/jquery-latest.js"></script>
        
        
        <style type="text/css">
            .body {
                background: rgba(239,197,202,1);
                background: -moz-linear-gradient(left, rgba(239,197,202,1) 0%, rgba(210,75,90,1) 0%, rgba(224,143,153,1) 16%, rgba(241,142,153,1) 100%);
                background: -webkit-gradient(left top, right top, color-stop(0%, rgba(239,197,202,1)), color-stop(0%, rgba(210,75,90,1)), color-stop(16%, rgba(224,143,153,1)), color-stop(100%, rgba(241,142,153,1)));
                background: -webkit-linear-gradient(left, rgba(239,197,202,1) 0%, rgba(210,75,90,1) 0%, rgba(224,143,153,1) 16%, rgba(241,142,153,1) 100%);
                background: -o-linear-gradient(left, rgba(239,197,202,1) 0%, rgba(210,75,90,1) 0%, rgba(224,143,153,1) 16%, rgba(241,142,153,1) 100%);
                background: -ms-linear-gradient(left, rgba(239,197,202,1) 0%, rgba(210,75,90,1) 0%, rgba(224,143,153,1) 16%, rgba(241,142,153,1) 100%);
                background: linear-gradient(to right, rgba(239,197,202,1) 0%, rgba(210,75,90,1) 0%, rgba(224,143,153,1) 16%, rgba(241,142,153,1) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#efc5ca', endColorstr='#f18e99', GradientType=1 );
            }
            body {
                background-color: #EDEFF2;
            }

            .sinpadding [class*="col-"] {
                padding: 0;
            }
            .margin-bottom-5px  {
                margin-bottom: 5px;
            }
        </style>
    </head>
    <body>
        
<!--            <header id="header">
                <div class="container-fluid col-lg-offset-9 text-right">
                    <h3>Que Bondi Salta</h3>
                </div>
            </header>-->
        <div id="wrapper" class="toggled">
            <button id="menu-toggle" type="button" class="hamburger is-open animated fadeInLeft" data-toggle="offcanvas">
                    <span class="hamb-top"></span>
                    <span class="hamb-middle"></span>
                    <span class="hamb-bottom"></span>
                </button>
            <!--<section class="main">-->

                <!--<div class="col-sm-5 col-md-4 col-lg-3">-->
                    <div id="sidebar-wrapper">
                        <div class="container-fluid">
                            <br>
                            @include('components/comollego_form')
                        </div>
                    </div>
                <!--</div>-->
                
                <div id="page-content-wrapper" class="sinpadding">
                    <!--<div class="col-xs-12 col-md-8 col-lg-9">-->
                        <div id="map"></div>
                    <!--</div>-->
                </div>

            <!--</section>-->
        </div>
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


            function initApp()
            {
                //Iniciamos un nuevo mapa
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 14,
                    center: new google.maps.LatLng(-24.7931342, -65.4303173),
                    streetViewControl: false,
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                        position: google.maps.ControlPosition.TOP_RIGHT
                    }
                });

                //Seteamos el rectangulo del mapa que se cargara al momento del inicio.
                var bounds = new google.maps.LatLngBounds(
                        new google.maps.LatLng(-24.578060, -65.684399),
                        new google.maps.LatLng(-25.171035, -65.266363)
                        );
                map.fitBounds(bounds);


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
                    onPlaceListItemSelected(arrAutocomplete['origen'], "origen");
                });


                arrAutocomplete['destino'] = new google.maps.places.Autocomplete(arrInput['destino'], options);
                google.maps.event.addListener(arrAutocomplete['destino'], 'place_changed', function ()
                {
                    onPlaceListItemSelected(arrAutocomplete['destino'], "destino");
                });
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
            
            
            function onPlaceListItemSelected(inputAddress, tipoDireccion)
            {
                var place = inputAddress.getPlace();
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
                }
                else
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
                $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
                $("button").toggleClass("is-open");
                $("button").toggleClass("is-closed");
            });
                $("#origen-input").focus();
                getLocation();
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
                        } 
                        
                        else if ($(this).attr("id") === "distancia-input")
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
                if ($("#"+tipoDireccion+"-input").val() === "")
                {
                    //Las latitudes coinciden
                    $("#"+tipoDireccion+"-input").parent().removeClass("has-error");
                    $("#"+tipoDireccion+"-input").parent().removeClass("has-success");
                    $("#"+tipoDireccion+"-input").next().removeClass("glyphicon-warning-sign");
                    $("#"+tipoDireccion+"-input").next().removeClass("glyphicon-ok");
                    $("#"+tipoDireccion+"-input").next().addClass("hide");
                    return;
                } else {
                    $.getJSON("http://maps.google.com/maps/api/geocode/json?address=" + $("#"+tipoDireccion+"-input").val(), function (data)
                    {
                        if (data.status === "OK") {
                            var valueInput = Number(document.getElementById(tipoDireccion+"-latitud").value);

                            console.log(Number(data.results[0].geometry.location.lat.toFixed(3)));
                            console.log(Number(valueInput.toFixed(3)));

                            if (Number(data.results[0].geometry.location.lat.toFixed(3)) === Number(valueInput.toFixed(3)))
                            {
                                //Las latitudes coinciden
                                $("#"+tipoDireccion+"-input").parent().removeClass("has-error");
                                $("#"+tipoDireccion+"-input").parent().addClass("has-success");
                                $("#"+tipoDireccion+"-input").next().removeClass("glyphicon-warning-sign");
                                $("#"+tipoDireccion+"-input").next().addClass("glyphicon-ok");
                                $("#"+tipoDireccion+"-input").next().removeClass("hide");
                            } else {
                                //Las latitudes no coinciden
                                $("#"+tipoDireccion+"-input").parent().removeClass("has-success");
                                $("#"+tipoDireccion+"-input").parent().addClass("has-error");
                                $("#"+tipoDireccion+"-input").next().removeClass("glyphicon-ok");
                                $("#"+tipoDireccion+"-input").next().addClass("glyphicon-warning-sign");
                                $("#"+tipoDireccion+"-input").next().removeClass("hide");
                            }
                        } else {
                            //No hubo resultados en el JSON
                            $("#"+tipoDireccion+"-input").parent().removeClass("has-success");
                            $("#"+tipoDireccion+"-input").parent().addClass("has-error");
                            $("#"+tipoDireccion+"-input").next().removeClass("glyphicon-ok");
                            $("#"+tipoDireccion+"-input").next().addClass("glyphicon-warning-sign");
                            $("#"+tipoDireccion+"-input").next().removeClass("hide");
                        }

                    });
                }
            }

            function investAdsress() 
            {
                var valoresAux = [];
                
                for (var component in componentForm)
                {
                    valoresAux["origen-" + component]                       = document.getElementById("origen-" + component).value;
                    document.getElementById("origen-" + component).value    = document.getElementById("destino-" + component).value;
                    document.getElementById("destino-" + component).value   = valoresAux["origen-" + component];
                }
                valoresAux["origen-latitud"]                        = document.getElementById("origen-latitud").value;
                valoresAux["origen-longitud"]                       = document.getElementById("origen-longitud").value;
                
                document.getElementById("origen-latitud").value     = document.getElementById("destino-latitud").value;
                document.getElementById("origen-longitud").value    = document.getElementById("destino-longitud").value;
                
                document.getElementById("destino-latitud").value    = valoresAux["origen-latitud"];
                document.getElementById("destino-longitud").value   = valoresAux["origen-longitud"];
                
                valoresAux["destino-input"]    = document.getElementById("destino-input").value;
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
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
            }
            
            function showPosition(position) {
                console.log("Lat: "+position.coords.latitude + "Lon: " + position.coords.longitude); 
            }
        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3FxKEgf10vNGHSUUYms4rl8cusliiVgM&libraries=geometry,places&callback=initApp">
        </script>
        <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0edpv6HYuNgDCW-IQ4ivoCQSLrBtM11s&libraries=places"></script>-->

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
