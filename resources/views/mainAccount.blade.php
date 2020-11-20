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
                                <a class="link_menu" href="/home">-> Main account</a>
                            </div>
                            <div class="col-md-12">
                                <a href="/editpass">Reset password</a>
                            </div>
                            <div class="col-md-12">
                                <a href="/repairPerson">Repair person</a>
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
        <table class="table table-bordered">
           
            <tbody>

                <tr>
                    <td>Тип аккаунта:</td>
                    <td>{{  $premium_status  }}  </td>
                </tr>
                
                <tr>
                    <td>Login:</td>
                    <td>{{ Auth::user()->name }}</td>
                </tr>

                <tr>
                    <td>E-Mail:</td>
                    <td>{{ Auth::user()->email}}</td>
                </tr>

                <tr>
                    <td>Дата регистрации:</td>
                        @if(isset($accountData->createtime))
                            <td> 
                                <?php $createtime = date('Y.m.d H:m:s', strtotime($accountData->createtime));?>
                                {{ $createtime }}
                            </td>
                        @else   
                            <td>Появится после первого входа в игру</td>  
                        @endif
                </tr>

                <tr>
                    <td>Последний Вход:</td>
                        @if(isset($accountData->lastlogintime))
                            <td>
                                <?php $lastlogintime = date('Y.m.d H:m:s', strtotime($accountData->lastlogintime));?>
                                {{ $lastlogintime }}
                            </td>
                        @else   
                            <td>Появится после первого входа в игру</td> 
                        @endif
                </tr>

                <tr>
                    <td>Пароль FG:</td>
                        @if(isset($fg))
                            <td>{{$fg}}</td>
                        @else   
                            <td>Появится после первого входа в игру</td> 
                        @endif
                </tr>
                
            </tbody>
        </table>
    </div>
</div>

@endsection