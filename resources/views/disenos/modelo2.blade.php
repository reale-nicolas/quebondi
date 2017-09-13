<!DOCTYPE html>
<html>
    <title>Que Bondi Salta</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    

    <!--    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
    <link rel="stylesheet" href="{{ URL::asset('css/w3.css') }}">
    
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=RobotoDraft' type='text/css'>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--<link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">-->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    
    
    <style>
        html,body,h1,h2,h3,h4,h5 {font-family: "RobotoDraft", "Roboto", sans-serif;}
        .w3-bar-block .w3-bar-item{padding:16px}
    </style>
    <script 
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3FxKEgf10vNGHSUUYms4rl8cusliiVgM&libraries=geometry,places">
    </script><!--
    -->
    <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">-->
    
    <!-- jQuery library -->
    <!--<script src="https://code.jquery.com/jquery-latest.js"></script>-->
    <!--<script src="{{ URL::asset('js/jquery-latest.js') }}"></script>-->
    <script src="{{ URL::asset('js/jquery-3.2.1.min.js') }}"></script>
    <!--<script src="{{ URL::asset('js/jquery-migrate-1.4.1.min.js') }}"></script>-->
    <!--<script src="{{ URL::asset('js/jquery-migrate-3.0.0.min.js') }}"></script>-->
    
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>-->
    
    <!-- Scripts propios -->
    <script src="{{ URL::asset('js/spin.min.js') }}"></script>
    <script src="{{ URL::asset('js/scripts.js') }}"></script>
    <script src="{{ URL::asset('js/ajaxCalls.js') }}"></script>
    <script src="{{ URL::asset('js/callbackFunctions.js') }}"></script>
    <!--<script src="{{ URL::asset('js/ContextMenu.js') }}"></script>-->
    
    
    <style type="text/css">
        .loader {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }    
    </style>
    <body onload="initializeApplication()">

        <!-- Side Navigation -->
        <nav class="w3-sidebar w3-bar-block w3-collapse w3-white w3-animate-left w3-card-2" 
             style="z-index:3;width:320px;" id="mySidebar">
            <!---------------------------------------------------->
            <div class="w3-bar-item w3-border-bottom w3-large w3-center">
                <img src="{{ URL::asset('images/logoSALTA.JPG') }}" style="width:50%;" 
                     onclick="document.getElementById('id01').style.display='block'"">
            </div>
            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-hide-large w3-large" 
               onclick="w3_close()" title="Close Sidemenu" style="border-top:2px solid;">Close 
                <i class="fa fa-remove"></i>
            </a>
            
            
            <!---------------OPCION ¿COMO LLEGO?------------------------------------->
            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-red w3-button w3-hover-black w3-left-align" 
               onclick="showHideMenuOption('divComoLLegoForm', new Array('divRecorridosLineaList','divConfiguracion'));"  style="border-top:2px solid;">¿Cómo llego?
            </a>
            <div id="divComoLLegoForm" class="w3-show w3-animate-left">
                <div class="w3-container">
                    @include('components/comollego_form_w3')
                </div>
                
            </div>
            
            
            <!---------------OPCION RECORRIDOS X LINEA------------------------------------->
            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-dark-grey w3-button w3-hover-black w3-left-align" 
               onclick="showHideMenuOption('divRecorridosLineaList', new Array('divComoLLegoForm','divConfiguracion'))" style="border-top:2px solid;">Recorridos x linea
                
            </a>
            <div id="divRecorridosLineaList" class="w3-hide w3-animate-left">
                <div class="w3-center w3-padding-16"><div class="loader" style="display: inline-block"></div></div>
<!--                <a href="#" class="w3-bar-item w3-button"><i class="fa fa-bus w3-margin-right"></i>Corredor 1</a>
                <div>
                    <ul class="w3-ul w3-right" style="width:90%">
                        <li class="w3-padding-16" style="cursor: pointer;" onclick="getLines()">
                            <span class="w3-button w3-white w3-right" style="padding: 0px;">
                                <input type="checkbox" onchange="getLines()"></input>
                            </span>
                            <img src="{{ URL::asset('images/1a.png') }}" class="w3-left w3-margin-right" style="width:30px">
                            <span class="">Corredor 1A</span><br>
                        </li>
                        <li class="w3-padding-16">
                            <span class="w3-button w3-white w3-right" style="padding: 0px;">
                                <input type="checkbox"></input>
                            </span>
                            <img src="{{ URL::asset('images/1b.png') }}" class="w3-left w3-margin-right" style="width:30px">
                            <span class="">Corredor 1B</span><br>
                        </li>
                        <li class="w3-padding-16">
                            <span class="w3-button w3-white w3-right" style="padding: 0px;">
                                <input type="checkbox"></input>
                            </span>
                            <img src="{{ URL::asset('images/1c.png') }}" class="w3-left w3-margin-right" style="width:30px">
                            <span class="">Corredor 1C</span><br>
                        </li>
                    </ul>
                </div>-->
<!--                <a href="#" class="w3-bar-item w3-button"><i class="fa fa-bus w3-margin-right"></i>Corredor 2</a>
                <a href="#" class="w3-bar-item w3-button"><i class="fa fa-bus w3-margin-right"></i>Corredor 3</a>
                <a href="#" class="w3-bar-item w3-button"><i class="fa fa-bus w3-margin-right"></i>Corredor 4</a>
                <a href="#" class="w3-bar-item w3-button"><i class="fa fa-bus w3-margin-right"></i>Corredor 5</a>
                <a href="#" class="w3-bar-item w3-button"><i class="fa fa-bus w3-margin-right"></i>Corredor 6</a>
                <a href="#" class="w3-bar-item w3-button"><i class="fa fa-bus w3-margin-right"></i>Corredor 7</a>
                <a href="#" class="w3-bar-item w3-button"><i class="fa fa-bus w3-margin-right"></i>Corredor 8</a>-->
            </div>
            
            
            <!---------------OPCION CONFIGURACION------------------------------------>
            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-dark-grey w3-button w3-hover-black w3-left-align" 
               onclick="showHideMenuOption('divConfiguracion', new Array('divComoLLegoForm', 'divRecorridosLineaList'))" style="border-top:2px solid;">Configuración
            </a>
            <div id="divConfiguracion" class="w3-hide w3-animate-left">
                <a href="#" class="w3-bar-item w3-button"
                   ><i class="fa fa-globe w3-margin-right"></i>Idioma
                </a>
            </div>
            
            
            <!---------------OPCION CONTACTENOS------------------------------------->
            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-dark-grey w3-button w3-hover-black w3-left-align" 
               onclick="showHideMenuOption(null, new Array('divComoLLegoForm', 'divRecorridosLineaList')); document.getElementById('divContactenosForm').style.display = 'block'" style="border-top:2px solid;">Contactenos
            </a>
        </nav>

        <!-- Overlay effect when opening the side navigation on small screens -->
        <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Close Sidemenu" id="myOverlay"></div>

        <!-- Page content -->
        <div class="w3-main" style="margin-left:320px;">
            <i id="btnDisplayMenu" class="fa fa-bars w3-red w3-button  w3-hide-large w3-xlarge " 
               style="display: block; position: fixed; z-index: 999" onclick="w3_open()"></i>
            <!--<a href="javascript:void(0)" class="w3-hide-large w3-red w3-button w3-right  w3-margin-right" onclick="document.getElementById('id01').style.display = 'block'"><i class="fa fa-pencil"></i></a>-->

            <!--<div class="person">-->
            <div id="map" style="position: static">@include('components/map')</div>
                
            <!--</div>-->
        </div>
        
        
        
        <!-- Modal that pops up when you click on "New Message" -->
        <div id="divContactenosForm" class="w3-modal" style="z-index:4">
            <div class="w3-modal-content w3-animate-zoom">
                <div class="w3-container w3-padding w3-red">
                    <span onclick="document.getElementById('divContactenosForm').style.display = 'none'"
                          class="w3-button w3-red w3-right w3-xxlarge"><i class="fa fa-remove"></i></span>
                    <h2>Send Mail</h2>
                </div>
                <div class="w3-panel">
                    <label>Subject</label>
                    <input class="w3-input w3-border w3-margin-bottom" type="text">
                    <input class="w3-input w3-border w3-margin-bottom" style="height:150px" placeholder="What's on your mind?">
                    <div class="w3-section">
                        <a class="w3-button w3-red" onclick="document.getElementById('divContactenosForm').style.display = 'none'">Cancel  <i class="fa fa-remove"></i></a>
                        <a class="w3-button w3-light-grey w3-right" onclick="document.getElementById('divContactenosForm').style.display = 'none'">Send  <i class="fa fa-paper-plane"></i></a> 
                    </div>    
                </div>
            </div>
        </div>
        
        
        <div id="id01" class="w3-display-container w3-modal w3-animate-opacity">
            <div class="w3-modal-content">
                <div class="w3-light-grey">
                    <div id="myBar" class="w3-container  w3-blue w3-center" style="width:0%">0%</div>
                </div>
            </div>
        </div>
        
        
        <script>
            
        $(document).ready(function() {
            $("ul li a").parent().hide().parent().show();

//            var tokenValue = $("meta[name='csrf-token']").attr('content');
//
//            $.ajaxSetup({
//                headers: {'X-CSRF-Token': tokenValue}
//            });
        });


    
            function w3_open() {
                document.getElementById("btnDisplayMenu").style.display = "none";
                document.getElementById("mySidebar").style.display = "block";
                document.getElementById("myOverlay").style.display = "block";
            }
            function w3_close() {
                document.getElementById("btnDisplayMenu").style.display = "block";
                document.getElementById("mySidebar").style.display = "none";
                document.getElementById("myOverlay").style.display = "none";
            }

            function showHideMenuOption(idElementToShow, arrIdElementToHide) 
            {
                if (idElementToShow !== null) 
                {
                    var x = document.getElementById(idElementToShow);

                    if (x.className.indexOf("w3-show") === -1) 
                    {
                        x.className += " w3-show";
                    } 
                    if (x.className.indexOf("w3-hide") > -1) 
                    {
                        x.className = x.className.replace("w3-hide", "");
                    }
                }
                if (arrIdElementToHide !== null) 
                {
                    arrIdElementToHide.forEach(function(element ) {
                        var x = document.getElementById(element);
                        if (x.className.indexOf("w3-show") > -1) 
                        {
                            x.className = x.className.replace("w3-show", "");
                        } 
                        if (x.className.indexOf("w3-hide") === -1) 
                        {
                             x.className += " w3-hide";
                        }
                    });
                }
            }
           
        </script>
    </body>
</html> 
