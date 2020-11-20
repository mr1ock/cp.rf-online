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
                          <a class="link_menu" href="/donate">Пожертвования</a>
                        </div>
                        <div class="col-md-12">
                            <a href="/premium">-> Премиум</a>
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
        <h5>Премиум подписка</h5>
     </div>
     
    @if(session('err'))
        <div class="alert alert-danger d-flex justify-content-center" role="alert">
                 {{  session('err')  }}
        </div> 
    @endif
    
    @if(session('success'))
        <div class="alert alert-success d-flex justify-content-center" role="alert">
                 {{  session('success')  }}
        </div> 
    @endif
    
    
    <div class="container blok_prem">
        <div class="row">
            <div class="col prem">
                 
                 <div class="form">
                     <form  action="{{ route('buyPremium') }}" method="POST">
                    @csrf
                   
                    <input name="type" type="hidden" value="1">
                    <div class="alert alert-success d-flex justify-content-center" role="alert">
                            <h6>Премиум на 15 дней(180 монет)</h6>
                            <button class='btn btn-primary btn-prem' type="submit">Купить</button>
                    </div> 
                </form>
                 </div>
                
            </div>
            <div class="col prem">
               
                <form action="{{ route('buyPremium') }}" method="POST">
                    @csrf
                    
                    <input name="type" type="hidden" value="2">
                    <div class="alert alert-success d-flex justify-content-center" role="alert">
                            <h6>Премиум на 30 дней(300 монет)</h6>
                            <button class='btn btn-primary btn-prem' type="submit">Купить</button>
                    </div>
                </form>
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