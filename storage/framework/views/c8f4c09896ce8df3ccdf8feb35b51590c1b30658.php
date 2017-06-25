<!DOCTYPE html>
<html>
    <head>
        <title>Que bondi Web</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="stylesheet" href="<?php echo e(URL::asset('css/sidebar.css')); ?>">
        
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
            
            <!--<section class="main">-->

                <!--<div class="col-sm-5 col-md-4 col-lg-3">-->
                    <div id="sidebar-wrapper">
                        <div class="container-fluid">
                            <?php echo $__env->make('components/comollego_form_boostrap', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>
                <!--</div>-->
                <button id="menu-toggle" type="button" class="hamburger is-open animated fadeInLeft" data-toggle="offcanvas">
                    <span class="hamb-top"></span>
                    <span class="hamb-middle"></span>
                    <span class="hamb-bottom"></span>
                </button>


                <div id="page-content-wrapper" class="sinpadding">
                    <div id="map"></div>
                </div>
                <?php echo $__env->make('components/map', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!--</section>-->
        </div>
        

            
            
<script>       
            $(document).ready(function () 
            {
                    $("#menu-toggle").click(function (e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
                    $("button").toggleClass("is-open");
                    $("button").toggleClass("is-closed");
                });
            });




            
        </script>
        
        <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0edpv6HYuNgDCW-IQ4ivoCQSLrBtM11s&libraries=places"></script>-->

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
