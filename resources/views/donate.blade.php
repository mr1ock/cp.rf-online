@extends('layouts.master')


@section('content')
<div class="row">
    <div class="col-md-3 left_menu">
        <div class="row">
            <div class="left_menu_bar">
                <p class="left_menu_title d-flex justify-content-center">
                    Navigation
                </p>
                <div class="left_nav_menu_link ">
                    <div class="row ">
                        <div class="col-md-12">
                          <a class="link_menu" href="/donate">-> Пожертвование</a>
                        </div>
                        <div class="col-md-12">
                            <a href="/premium">Премиум</a>
                        </div>
                        <div class="col-md-12">
                            <a href="/vote">Голосовать</a>
                        </div>
                        <div class="col-md-12">
                            
                        </div>
                        <div class="col-md-12">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 main_window">
      @if (Auth::check())

            <div class="alert alert-primary d-flex justify-content-center" role="alert">
                <h4>Поддержать проект</h4>
            </div>
             
            <div class="tols d-flex justify-content-center">
                
                <div class="content_donate container">
                    <div class="col-md-12">
                        {{-- <p style="color: gray">Название платежа</p>
                        <p >Поддержка проекта</p> --}}
                        <img class="kart" src="{{ asset('img/yandex2.png') }}" >
                        <img class="visa" src="{{ asset('img/visa.png') }}" >
                        <form onsubmit="return submitForm()" method="POST" action="https://yoomoney.ru/quickpay/confirm.xml"> 
                            <input type="hidden" name="receiver" value="4100115690291695"> 
                            <input type="hidden" name="quickpay-form" value="shop"> 
                            <input type="hidden" name="targets" value="Пожертвование от {{ Auth::user()->name}}"> 
                            <label name="yandex"><input class="chect" name="money_type" type="radio" checked value="PC">  Яндекс.Деньги</label>
                            <label name="kart"><input class="chect" name="money_type" type="radio" value="AC">  Картой</label>
                            <input id="moneyType" type="hidden" name="paymentType" value="PC">
                            <input type="hidden" name="successURL" value="cp.rf-ultimatum.ru/login">
                            <input type="hidden" name="label" value="{{ Auth::user()->name}}"> 
                            <input type="text" class="form-control input_plat" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value='50' name="sum" placeholder="Сумма" required>
                            <input class="btn btn-success" onclick="send_money_type()" type="submit" value="Оплатить"> 
                        </form>
                        <hr>
                        <div class="img_plat">
                        {{--                             
                            <img class="yandex" src="{{ asset('img/yandex.png') }}" >
                            <img class="kart" src="{{ asset('img/visa.png') }}" >
                            <img class="kart" src="{{ asset('img/master.png') }}" > --}}
                        </div>
                    </div>   
                        <div class="bonus">
                            <h6>Бонус при оплате:</h6>
                            <h6>От 500р +5%</h6>
                            <h6>От 1000р + 10%</h6>
                            <h6>От 3000р +15%</h6>
                        </div>
                </div>
            </div>
            
        <script>
                    
            let inputMoneyType = document.getElementById('moneyType');
            let rad = document.getElementsByName('money_type');
            function send_money_type() {
                
                    for (var i=0;i<rad.length; i++) {
                        if (rad[i].checked) {
                            inputMoneyType.value = rad[i].value;
                        }
                    }
            }
        </script>
                    
        {{--  --}}
    </div>
</div>


@endif

@endsection