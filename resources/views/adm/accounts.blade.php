@extends('layouts.admMaster')


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
                            <a class="link_menu" href="{{  route('admin')  }}">Main</a>
                        </div>
                        <div class="col-md-12">
                          <a href="{{  route('createGm')  }}">CreateGm</a>
                        </div>
                        <div class="col-md-12">
                          <a href="{{  route('pers')  }}">Pers</a>
                        </div>
                        <div class="col-md-12">
                          <a href="{{  route('giveItem')  }}">giveItem</a>
                        </div>
                        <div class="col-md-12">
                            <a href="{{  route('Accounts')  }}">-> Accounts</a>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 main_window">
      @if (Auth::check())
      <form action="getAccountInfo" method="post">
        <table class="table table-sm table-bordered">
            <tbody>
                <tr>
                    
                        @csrf
                        <td><p>#</p></td>
                        <td><input name="name" placeholder="Логин" class="form-control" type="text"></td>
                        <td><button class="btn btn-primary" type="submit">Поиск аккаунта</button></td>
                        <td><input class="btn btn-warning" type="button" onclick="window.location.href = '{{route('Accounts')}}';" value="Найти все аккаунты"/></td>
                    
                </tr>
            </tbody>
        </table>
    </form>
      <table class="table table-bordered table-sm">
           
        <tbody class="rating_users">
            <tr>
                <td>AccountSerial</td>
                <td>Login</td>
                <td>Password</td>
                <td>e-mail</td>
                <td>FG</td>
                <td>act</td>


            </tr>

        @if(isset($info))
            @foreach ($info as $inf) 

                <tr>
                <td>{{$inf->serial}}</td>
                <td>{{$inf->id}}</td>
                <td>{{$inf->password}}</td>
                <td>{{$inf->Email}}</td>
                <td>{{$inf->uilock_pw}}</td>
                <td>
                    <form action="getAccountInfo" method="post">
                        @csrf

                        <input hidden  type="text" name='name' value='{{$inf->id}}'>
                        <button class="btn btn-primary" type="submit">view</button>
                    </form>
                </td>
                    
                </tr>
                
            @endforeach
            
            
        </tbody>
    </table>


    @if(isset($infoPers))

    <br><br><br>
    <div class="alert alert-success d-flex justify-content-center" role="alert">
        <h4>Персонажи на Аккаунте</h4>
    </div>
    <table class="table table-bordered table-sm">
           
        <tbody class="rating_users">
            <tr>
                <td>Serial</td>
                <td>Name</td>
                <td>Account</td>
                <td>Slot</td>
                <td>Race</td>
                <td>Class</td>
                <td>Lv</td>
                <td>DeleteName</td>
                <td>Hiden?(DCK)</td>
                <td>act</td>



            </tr>

        
            @foreach ($infoPers as $infoPerses) 

                <tr>
                <td>{{$infoPerses->serial}}</td>
                <td>{{$infoPerses->Name}}</td>
                <td>{{$infoPerses->Account}}</td>
                <td>{{$infoPerses->Slot}}</td>
                <td>{{$infoPerses->Race}}</td>
                <td>{{$infoPerses->Class}}</td>
                <td>{{$infoPerses->Lv}}</td>
                <td>{{$infoPerses->DeleteName}}</td>
                <td>{{$infoPerses->DCK}}</td>
                <td>
                    <form action="viewPerson" method="POST">
                        @csrf
                        <input hidden  type="text" name='name' value='{{$infoPerses->Name}}'>
                        <button class="btn btn-primary" type="submit">edit</button>
                    </form>
                </td>
               

                    
                </tr>
                
            @endforeach
            
            @else
        @endif
        </tbody>
    </table>
    {{ $info->links() }}
        
    </div>
</div>

@else
{{--  --}}
@endif

@endif

@endsection