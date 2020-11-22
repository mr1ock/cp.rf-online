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
                                <a href="{{  route('giveItem')  }}">->  giveItem</a>
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
     
        <table class="table table-sm table-bordered">
            <tbody>

                <div class="alert alert-success d-flex justify-content-center" role="alert">
                    <h4>Выдать предмет</h4>
                </div>
                <form action="/giveItems" method="post">
                    @csrf
                    <tr>
                        <td><p class="profil"><input name="nAvatorSerial" placeholder="Serial" class="form-control" type="text"></p></td>
                        <td><p class="profil"><input name="nItemCode_K" placeholder="itemCode(SQL-type)" class="form-control" type="text"></p></td>
                        <td><p class="profil"><input name="nItemCode_U" placeholder="Заточка HEX-type" class="form-control" type="text" value="0xfffffff"></p></td>
                        <td><p class="profil"><input name="nItemCode_D" placeholder="Кол-во" class="form-control" type="text"></p></td>
                        <td><p class="profil"><input name="T" placeholder="Время жизни предмета" class="form-control" type="text" value="111111"></p></td>
                      
                    </tr>
                    
                

                
                
            </tbody>
        </table>
            <button class="btn btn-success" type="submit">Выдать</button>
        </form>

        @include('layouts.errors')

        @if(session('success'))
            <div class="alert alert-success d-flex justify-content-center" role="alert">
                    {{  session('success')  }}
            </div> 
        @endif

    </div>
</div>

@endsection