<!DOCTYPE html>
<html>
    <title>W3.CSS Template</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>

        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }

        html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
    </style>
    <body>

        <!-- Navbar -->
        <div class="w3-top">
            <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
                <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
                <a href="#" class="w3-bar-item w3-button w3-theme-l1">Link</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Link</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Link</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Link</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Link</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Link</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Link</a>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" style="z-index:3;width:250px;margin-top:43px;" id="mySidebar">
            <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
                <i class="fa fa-remove"></i>
            </a>
            <h4 class="w3-bar-item"><b>Buscar</b></h4>
            <div class="form-group row">
                <div class="col-xs-2">
                    <label for="ex1">col-xs-2</label>
                    <input class="form-control" id="ex1" type="text">
                </div>
            </div>
        </div>

        <!-- Overlay effect when opening sidebar on small screens -->
        <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

        <!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
        <div class="w3-main" style="margin-left:250px;">

            <div class="container" style="height: 500px;">
                @yield('content')
                
                
            </div>

            <!-- END MAIN -->
        </div>
        
        <script>
            function funcion(){
            }   
        </script>
        <script>
            // Get the Sidebar
            var mySidebar = document.getElementById("mySidebar");

            // Get the DIV with overlay effect
            var overlayBg = document.getElementById("myOverlay");

            // Toggle between showing and hiding the sidebar, and add overlay effect
            function w3_open() {
                if (mySidebar.style.display === 'block') {
                    mySidebar.style.display = 'none';
                    overlayBg.style.display = "none";
                } else {
                    mySidebar.style.display = 'block';
                    overlayBg.style.display = "block";
                }
            }

            // Close the sidebar with the close button
            function w3_close() {
                mySidebar.style.display = "none";
                overlayBg.style.display = "none";
            }


            var map;
            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 2,
                    center: new google.maps.LatLng(2.8, -187.3),
                    mapTypeId: 'terrain'
                });
var arrsize  = alertSize();
                document.getElementById("map").style.height = arrsize.height+"px";
                // Create a <script> tag and set the USGS URL as the source.
                var script = document.createElement('script');
                // This example uses a local copy of the GeoJSON stored at
                // http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp
                script.src = 'https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js';
                document.getElementsByTagName('head')[0].appendChild(script);
            }

            // Loop through the results array and place a marker for each
            // set of coordinates.
            window.eqfeed_callback = function (results) {
                for (var i = 0; i < results.features.length; i++) {
                    var coords = results.features[i].geometry.coordinates;
                    var latLng = new google.maps.LatLng(coords[1], coords[0]);
                    var marker = new google.maps.Marker({
                        position: latLng,
                        map: map
                    });
                }
            };


            function alertSize()
            {
                var myWidth = 0, myHeight = 0;
                if (typeof (window.innerWidth) == 'number') {
                    //No-IE 
                    myWidth = window.innerWidth;
                    myHeight = window.innerHeight;
                } else if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
                    //IE 6+ 
                    myWidth = document.documentElement.clientWidth;
                    myHeight = document.documentElement.clientHeight;
                } else if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
                    //IE 4 compatible 
                    myWidth = document.body.clientWidth;
                    myHeight = document.body.clientHeight;
                } else{
                    alert("No encontramos ñaca!!");
                }
                
                var windowProperties = {
                    "width": myWidth,
                    "height": myHeight
                };
                
                return windowProperties;
            }
        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3FxKEgf10vNGHSUUYms4rl8cusliiVgM&callback=initMap">
        </script>
    </body>
</html>
