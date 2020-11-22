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
                                <a href="{{  route('pers')  }}">-> Pers</a>
                            </div>
                            <div class="col-md-12">
                                <a href="{{  route('giveItem')  }}">giveItem</a>
                            </div>
                            <div class="col-md-12">
                                <a href="{{  route('Accounts')  }}">Accounts</a>
                            </div>
                            <div class="col-md-12"> 
                        </div>
                    </div>                
                </div> 
            </div>
        </div>
    </div>
    <div class="col-md-8 main_window">
     
    <form action="/viewPerson" method="post">
        <table class="table table-sm table-bordered">
            <tbody>
                <tr>
                    
                        @csrf
                        <td><p>#</p></td>
                        <td><input name="name" placeholder="Ник персонажа" class="form-control" type="text"></td>
                        <td><button class="btn btn-primary" type="submit">Загрузить инфо</button></td>
                    
                </tr>
            </tbody>
        </table>
    </form>
        @if (isset($info->Name))
                <form action="/changePerson" method="post">
                    @csrf 
                <table class="table table-sm table-bordered">
                    <tbody>
                        <tr>
                            <td>Serial</td>
                            <td>Name</td>
                            <td>AccountSerial</td>
                            <td>Account</td>

                        </tr>
                        <tr>
                            <td><input name="Serial" placeholder="Serial" class="form-control" type="text" value="{{$info->Serial}}"></td>
                            <td><input name="Name" placeholder="Name" class="form-control" type="text" value="{{$info->Name}}"></td>
                            <td><input name="AccountSerial" placeholder="AccountSerial" class="form-control" type="text" value="{{$info->AccountSerial}}"></td>
                            <td><input name="Account" placeholder="Account" class="form-control" type="text" value="{{$info->Account}}"></td>

                        </tr>
                        <tr>
                            <td>Slot</td>
                            <td>DeleteName</td>
                            <td>Hiden?(DCK)</td>
                            <td>Class</td>
                        </tr>
                        <tr>
                            <td><input name="Slot" placeholder="Slot" class="form-control" type="text" value="{{$info->Slot}}"></td>
                            <td><input name="DeleteName" placeholder="DeleteName" class="form-control" type="text" value="{{$info->DeleteName}}"></td>
                            <td><input name="DCK" placeholder="Скрыт?" class="form-control" type="text" value="{{$info->DCK}}"></td>

                            <td><input name="Class" placeholder="Class" class="form-control" type="text" value="{{$info->Class}}"></td>
                        </tr>

                        <tr>
                            <td>Lv</td>
                            <td>Dalant</td>
                            <td>Platina</td>
                            <td>MaxLevel</td>
                        </tr>
                        <tr>
                            <td><input name="Lv" placeholder="Lv" class="form-control" type="text" value="{{$info->Lv}}"></td>
                            <td><input name="Dalant" placeholder="Dalant" class="form-control" type="text" value="{{$info->Dalant}}"></td>
                            <td><input name="Gold" placeholder="Gold" class="form-control" type="text" value="{{$info->Gold}}"></td>
                            <td><input name="MaxLevel" placeholder="MaxLevel" class="form-control" type="text" value="{{$info->MaxLevel}}"></td>
                        </tr>
                        <tr>
                            <td>OC</td>
                            <td>TotalPlayMin</td>
                            <td>PvpPoint</td>
                            <td>Race</td>

                        </tr>
                        <tr>
                            <td><input name="PvpPoint" placeholder="OC" class="form-control" type="text" value="{{(int)$info->PvpPoint}}"></td>
                            <td><input name="TotalPlayMin" placeholder="TotalPlayMin" class="form-control" type="text" value="{{(int)$info->TotalPlayMin}}"></td>
                            <td><input name="PvpCash" placeholder="PvpCash" class="form-control" type="text" value="{{(int)$info->PvpCash}}"></td>
                            <td><input name="Race" placeholder="Race" class="form-control" type="text" value="{{$info->Race}}"></td>

                        </tr>

                    </tbody>
                </table>
                <button class="btn btn-success" type="submit">Изменить</button>
    </form>


    
                <form action="/item" method="post">
      
                    @csrf
                    <td><p>#</p></td>
                    <td><input hidden name="serial" type="text" value="{{$info->Serial}}"></td>
                    <td><button class="btn btn-primary" type="submit">view items</button></td>
                      
                </form>
            </div>
        
        

    


    @else
            
    @endif

        @include('layouts.errors')

        @if(session('success'))
            <div class="alert alert-success d-flex justify-content-center" role="alert">
                    {{  session('success')  }}
            </div> 
        @endif

    </div>
</div>

@endsection