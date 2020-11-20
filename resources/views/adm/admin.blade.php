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
                                <a class="link_menu" href="{{  route('admin')  }}">-> Main</a>
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

                <tr>
                  <td>#1</td>
                  <td>Изменение пароля игрока</td>
                </tr>
                <form action="/changePassUser" method="post">
                    @csrf
                  <tr>
                      <td><p class="profil"><input name="name" placeholder="Логин" class="form-control" type="text" ></p></td>
                      <td><p class="profil"><input name="pass" placeholder="Новый пароль" class="form-control" type="text" ></p></td>
                      <td><button class="btn btn-success" type="submit">Изменить</button></td>
                  </tr>
                </form>

              <tr>
                <td>#2</td>
                <td>Изменение пароля от склада</td>
              </tr>
              <form action="/changePassSklad" method="post">
                  @csrf
                <tr>
                    <td><p class="profil"><input name="name" placeholder="Логин" class="form-control" type="text" ></p></td>
                    <td><p class="profil"><input name="pass" placeholder="Новый пароль" class="form-control" type="text" ></p></td>
                    <td><button class="btn btn-success" type="submit">Изменить</button></td>
                </tr>
              </form>

              <tr>
                <td>#3</td>
                <td>Выдать Cash</td>
              </tr>
              <form action="/changeCashMoney" method="post">
                  @csrf
                <tr>
                    <td><p class="profil"><input name="name" placeholder="Логин" class="form-control" type="text" ></p></td>
                    <td><p class="profil"><input name="cash" placeholder="Новое кол-во" class="form-control" type="text" ></p></td>
                    <td><button class="btn btn-success" type="submit">Изменить</button></td>
                </tr>
              </form>

              <tr>
                <td>#4</td>
                <td>Изменить ФГ</td>
              </tr>
              <form action="/changeFGpass" method="post">
                  @csrf
                <tr>
                    <td><p class="profil"><input name="name" placeholder="Логин" class="form-control" type="text" ></p></td>
                    <td><p class="profil"><input name="pass" placeholder="Новый ФГ пароль" class="form-control" type="text" ></p></td>
                    <td><button class="btn btn-success" type="submit">Изменить</button></td>
                </tr>
              </form>

              
            
                
                
            </tbody>
        </table>

          @include('layouts.errors')

          @if(session('success'))
              <div class="alert alert-success d-flex justify-content-center" role="alert">
                      {{  session('success')  }}
              </div> 
          @endif
    </div>
</div>

@endsection