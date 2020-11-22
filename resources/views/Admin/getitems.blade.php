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
     
        <table class="table table-bordered table-sm">
           
            <tbody class="rating_users">
                <tr>
                    <td>item</td>
                    
                </tr>
    
            
                @foreach ($items as $item) 
    
                    <tr>
                        <td>{{$item->K0}}</td>
                        <td>{{$item->D0}}</td>
                        <td>{{$item->U0}}</td>
                        
                   </tr>
                    
                @endforeach

        @include('layouts.errors')

        @if(session('success'))
            <div class="alert alert-success d-flex justify-content-center" role="alert">
                    {{  session('success')  }}
            </div> 
        @endif

    </div>
</div>

@endsection