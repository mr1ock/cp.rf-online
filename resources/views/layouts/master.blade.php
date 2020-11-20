<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный Кабинет</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/kelly.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/material.js"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
</head>
<body>
    <div class="container">
        <div class="main">
            <!-- side bar -->
            <div class="row side_bar_fon">
                <div class="col-md-6 side_bar">
                   <div class="row">
                       <div class="col-md menu_btn">
                           <div class="row">
                               <div class="col-md-12">
                                   <a class="link_menu cursor1" href="/home">
                                        <div class="d-flex justify-content-center">
                                            <div class="icon_1"></div>
                                        </div>
                                        <p class="btn_title d-flex justify-content-center">Account</p>
                                   </a>
                               </div>
                           </div>
                           
                       </div>
                       <div class="col-md menu_btn">
                            <div class="row">
                               <div class="col-md-12">
                                   <a class="link_menu cursor2" href="/donate">
                                        <div class="d-flex justify-content-center">
                                            <div class="icon_2"></div>
                                        </div>
                                        <p class="btn_title d-flex justify-content-center">Shop</p>
                                   </a>
                               </div>
                           </div>
                       </div>
                       <div class="col-md menu_btn">
                            <div class="row">
                               <div class="col-md-12">
                                   <a class="link_menu cursor3" href="/statistic">
                                        <div class="d-flex justify-content-center">
                                            <div class="icon_3"></div>
                                        </div>
                                        <p class="btn_title d-flex justify-content-center">Statistic</p>
                                   </a>
                               </div>
                           </div>   
                       </div>
                       <div class="col-md menu_btn">
                            <div class="row">
                               <div class="col-md-12">
                                   <a class="link_menu cursor4" href="/rating">
                                        <div class="d-flex justify-content-center">
                                            <div class="icon_4"></div>
                                        </div>
                                        <p class="btn_title d-flex justify-content-center">Rating</p>
                                   </a>
                               </div>
                           </div>
                       </div>
                   </div>
                </div>
                <div class="col-md-5 balance">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="d-flex justify-content-center">
                                        <img class="img_icon_logo" src="{{ asset('img/robot.png') }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12 status_bar">
                                            <p class="font_status">{{ Auth::user()->name }}</p>
                                            <a href="/logout" ><div class="icon_exit"></div></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="/donate"><img class="img_icon_money"  src="{{ asset('img/money2.png') }}"></a>
                                        <p class="money">{{  $cash  }}</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- main -->
            @yield('content') 

        </div>
    </div>
</body>
</html>