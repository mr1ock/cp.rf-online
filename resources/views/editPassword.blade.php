﻿@extends('layouts.master')


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
                          <a class="link_menu" href="/home">Main account</a>
                        </div>
                        <div class="col-md-12">
                            <a href="/editpass">-> Reset password</a>
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
      @if (Auth::check())

        <table class="table table-bordered">
          
          <thead>
            {{-- Изменение пароля --}}
            <form action="{{ route('changePasswordUser') }}" method="post">
              @csrf
                <tr>
                  <th scope="col">#1</th>
                  <th scope="col">Изменение пароля</th>
                </tr>

            </thead>
                <tbody>

                  <tr>
                      <td><p  class="profil"><input name="password" placeholder="Пароль" class="form-control"   type="password" ></p></td>
                      <td><p  class="profil"><input name="new_password" placeholder="Новый Пароль" class="form-control"   type="password" ></p></td>
                      <td><button class="btn btn-success" type="submit">Изменить</button></td>
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
    </div>
</div>


@endif

@endsection