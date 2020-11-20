@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center cart-body">
        <div class="col-md-8">
            
            <div class="card">    
                <div class="card-body">
                    <h1 style="margin-left: 35%; font-size:28px;margin-bottom: 35px;">Авторизация</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Логин') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" name='name' required>

                                
                                    <span class="invalid-feedback" role="alert">
                                        <strong>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error}}</li>    
                                            @endforeach
                                        </strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Вход') }}
                                </button>
                                <button onclick='document.location.href = "/register"';  class="btn btn-primary">
                                    {{ __('Зарегистрироваться') }}
                                </button>
                                
                                <strong>@include('layouts.errors')</strong>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
