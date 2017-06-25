<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Simple Sidebar - Start Bootstrap Template</title>



        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">-->

        <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
        <style>
            body{
                background-color: teal;
            }
            /*!
             * Start Bootstrap - Simple Sidebar (http://startbootstrap.com/)
             * Copyright 2013-2016 Start Bootstrap
             * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap/blob/gh-pages/LICENSE)
             */
            .hamburger {
                background: transparent;
                border: none;
                display: block;
                height: 32px;
                margin-left: 15px;
                position: fixed;
                top: 20px;
                width: 32px;
                z-index: 999;
            }
            .hamburger:hover {
                outline: none;
            }
            .hamburger:focus {
                outline: none;
            }
            .hamburger:active {
                outline: none;
            }
            .hamburger.is-closed:before {
                -webkit-transform: translate3d(0, 0, 0);
                -webkit-transition: all 0.35s ease-in-out;
                color: #ffffff;
                content: '';
                display: block;
                font-size: 14px;
                line-height: 32px;
                opacity: 0;
                text-align: center;
                width: 100px;
            }
            .hamburger.is-closed:hover before {
                -webkit-transform: translate3d(-100px, 0, 0);
                -webkit-transition: all 0.35s ease-in-out;
                display: block;
                opacity: 1;
            }
            .hamburger.is-closed:hover .hamb-top {
                -webkit-transition: all 0.35s ease-in-out;
                top: 0;
            }
            .hamburger.is-closed:hover .hamb-bottom {
                -webkit-transition: all 0.35s ease-in-out;
                bottom: 0;
            }
            .hamburger.is-closed .hamb-top {
                -webkit-transition: all 0.35s ease-in-out;
                background-color: rgba(255, 255, 255, 0.7);
                top: 5px;
            }
            .hamburger.is-closed .hamb-middle {
                background-color: rgba(255, 255, 255, 0.7);
                margin-top: -2px;
                top: 50%;
            }
            .hamburger.is-closed .hamb-bottom {
                -webkit-transition: all 0.35s ease-in-out;
                background-color: rgba(255, 255, 255, 0.7);
                bottom: 5px;
            }
            .hamburger.is-closed .hamb-top,
            .hamburger.is-closed .hamb-middle,
            .hamburger.is-closed .hamb-bottom,
            .hamburger.is-open .hamb-top,
            .hamburger.is-open .hamb-middle,
            .hamburger.is-open .hamb-bottom {
                height: 4px;
                left: 0;
                position: absolute;
                width: 100%;
            }
            .hamburger.is-open .hamb-top {
                -webkit-transform: rotate(45deg);
                -webkit-transition: -webkit-transform 0.2s cubic-bezier(0.73, 1, 0.28, 0.08);
                background-color: #fff;
                margin-top: -2px;
                top: 50%;
            }
            .hamburger.is-open .hamb-middle {
                background-color: #fff;
                display: none;
            }
            .hamburger.is-open .hamb-bottom {
                -webkit-transform: rotate(-45deg);
                -webkit-transition: -webkit-transform 0.2s cubic-bezier(0.73, 1, 0.28, 0.08);
                background-color: #fff;
                margin-top: -2px;
                top: 50%;
            }
            .hamburger.is-open:before {
                -webkit-transform: translate3d(0, 0, 0);
                -webkit-transition: all 0.35s ease-in-out;
                color: #ffffff;
                content: '';
                display: block;
                font-size: 14px;
                line-height: 32px;
                opacity: 0;
                text-align: center;
                width: 100px;
            }
            .hamburger.is-open:hover before {
                -webkit-transform: translate3d(-100px, 0, 0);
                -webkit-transition: all 0.35s ease-in-out;
                display: block;
                opacity: 1;
            }
            body {
                overflow-x: hidden;
            }

            /* Toggle Styles */

            #wrapper {
                padding-left: 0;
                -webkit-transition: all 0.5s ease;
                -moz-transition: all 0.5s ease;
                -o-transition: all 0.5s ease;
                transition: all 0.5s ease;
            }

            #wrapper.toggled {
                padding-left: 250px;
            }

            #sidebar-wrapper {
                z-index: 1000;
                position: fixed;
                left: 250px;
                width: 0;
                height: 100%;
                margin-left: -250px;
                overflow-y: auto;
                background: #000;
                -webkit-transition: all 0.5s ease;
                -moz-transition: all 0.5s ease;
                -o-transition: all 0.5s ease;
                transition: all 0.5s ease;
            }

            #wrapper.toggled #sidebar-wrapper {
                width: 250px;
            }

            #page-content-wrapper {
                width: 100%;
                position: absolute;
                padding: 15px;
            }

            #wrapper.toggled #page-content-wrapper {
                position: absolute;
                margin-right: -250px;
            }

            /* Sidebar Styles */

            .sidebar-nav {
                position: absolute;
                top: 0;
                width: 250px;
                margin: 0;
                padding: 0;
                list-style: none;
            }

            .sidebar-nav li {
                text-indent: 20px;
                line-height: 40px;
            }

            .sidebar-nav li a {
                display: block;
                text-decoration: none;
                color: #999999;
            }

            .sidebar-nav li a:hover {
                text-decoration: none;
                color: #fff;
                background: rgba(255,255,255,0.2);
            }

            .sidebar-nav li a:active,
            .sidebar-nav li a:focus {
                text-decoration: none;
            }

            .sidebar-nav > .sidebar-brand {
                height: 65px;
                font-size: 18px;
                line-height: 60px;
            }

            .sidebar-nav > .sidebar-brand a {
                color: #999999;
            }

            .sidebar-nav > .sidebar-brand a:hover {
                color: #fff;
                background: none;
            }

            @media(min-width:768px) {
                #wrapper {
                    padding-left: 0;
                }

                #wrapper.toggled {
                    padding-left: 250px;
                }

                #sidebar-wrapper {
                    width: 0;
                }

                #wrapper.toggled #sidebar-wrapper {
                    width: 250px;
                }

                #page-content-wrapper {
                    padding: 20px;
                    position: relative;
                }

                #wrapper.toggled #page-content-wrapper {
                    position: relative;
                    margin-right: 0;
                }
            }

        </style>
    </head>

    <body>

        <div id="wrapper">

            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="#">
                            Start Bootstrap
                        </a>
                    </li>
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li>
                        <a href="#">Shortcuts</a>
                    </li>
                    <li>
                        <a href="#">Overview</a>
                    </li>
                    <li>
                        <a href="#">Events</a>
                    </li>
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <button id="menu-toggle" type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas">
                <span class="hamb-top"></span>
                <span class="hamb-middle"></span>
                <span class="hamb-bottom"></span>
            </button><br>
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1>Simple Sidebar</h1>
                            <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                            <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
                            <a  class="btn btn-default" id="menu-toggle1">Toggle Menu</a>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery library -->
        <script src="https://code.jquery.com/jquery-latest.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Menu Toggle Script -->
        <script>
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
                $("button").toggleClass("is-open");
            });
        </script>

    </body>

</html>