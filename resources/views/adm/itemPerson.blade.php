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
                {{-- <form action="/item" method="get">
                    @csrf  --}}
                <table class="table table-sm table-bordered">
                    <tbody>
                            

                        <tr>
                            <td>Slot</td>
                            <td>ItemName</td>
                            <td>ItemCode</td>
                            <td>Modif</td>
                            <td>Count</td>
                            <td>edit</td>

                        </tr>
                        @foreach ($itemPerson as $item)

                        <tr>
                            <form action="/editItemInCase" method="post">
                                <td>{{$item->Slot}}</td>
                                <td>{{$item->ItemName}}</td>
                                <td><input class="form-control" name="ItemCode" type="text" value="{{$item->ItemCode}}"></td>
                                <td><input class="form-control" type="text" name="Modif" value="0x{{$item->Modif}}"></td>
                                <td><input class="form-control" type="text" name="Count" value="{{$item->Count}}"></td>
                                <td>
                                    @csrf
                                    <input hidden type="text" name="K" value="{{ $item->K }}">
                                    <input hidden type="text" name="D" value="{{ $item->D }}">
                                    <input hidden type="text" name="U" value="{{ $item->U }}">
                                    <input hidden type="text" name="Slot" value="{{ $item->Slot }}">
                                    <input hidden type="text" name="TypeItem" value="{{ $item->TypeItem }}">
                                    <input hidden type="text" name="Number" value="{{ $item->Number }}">
                                    <input hidden type="text" name="serial" value="{{ $item->serial }}">
                                    <button class="btn btn-success" type="submit"></button>
                                </td>
                            </form>    


                        </tr>
                        @endforeach
                       
                    </tbody>
                </table>
                {{ $itemPerson->links() }}
                {{-- <button class="btn btn-success" type="submit">Изменить</button> --}}
            </div>
        
        
    {{-- </form> --}}

            

        @include('layouts.errors')

        @if(session('success'))
            <div class="alert alert-success d-flex justify-content-center" role="alert">
                    {{  session('success')  }}
            </div> 
        @endif

    </div>
</div>

@endsection