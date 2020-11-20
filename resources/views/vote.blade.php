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
                            <a class="link_menu" href="/donate">Пожертвование</a>
                          </div>
                          <div class="col-md-12">
                              <a href="/premium">Премиум</a>
                          </div>
                          <div class="col-md-12">
                              <a href="/vote">->  Голосовать</a>
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
        <h5>MMOTOP</h5>
     </div>
     
    
    
    

        <table class="table table-bordered">
            <thead>
            {{-- Изменение пароля --}}
            <form action="/vote" method="post">
              @csrf
                <tr>
                  <th scope="col">Награда 5 cash</th>
                  <th scope="col">Голосовать(ссылка)</th>
                </tr>

            </thead>
              
                <tbody>
                  <tr>

                    <td>
                        Голоса обновляются раз в 60 минут
                    </td>

                    <td>
                        <input type="hidden" name="name" id="name" value="{{ Auth::user()->name }}">
                        <button class="btn btn-success" type="submit">Проверить голос</button>
                    </td>

                  </tr>
                    
            </form>
            @include('layouts.errors')

            @if(session('success'))
                  <div  class="alert alert-success d-flex justify-content-center" role="alert">
                            {{  session('success')  }}
                  </div> 
              @endif
              
                </tbody>
        </table>
        <p class="warning d-flex justify-content-center">! При голосовании указывайте логин аккаунта, а не ник персонажа</p>
    </div>
</div>


@endif

@endsection