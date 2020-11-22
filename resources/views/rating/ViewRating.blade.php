@extends('layouts.master')


@section('content')
<div class="row">
    <div class="col-md-3 left_menu">
        <div class="row">
            <div class="left_menu_bar">
                <p class="left_menu_title d-flex justify-content-center">
                    Навигация
                </p>
                <div class="left_nav_menu_link ">
                    <div class="row ">
                        <div class="col-md-12">
                            <a class="{{ request()->is('rating/PvpPoint') ? 'checked_type' : null }}"
                                href="/rating/PvpPoint">Рейтинг по ОС</a>
                        </div>
                        <div class="col-md-12">
                            <a class="{{ request()->is('rating/bel') ? 'checked_type' : null }}"
                                href="/rating/bel">Рейтинг расы Беллато</a>
                        </div>
                        <div class="col-md-12">
                            <a class="{{ request()->is('rating/kora') ? 'checked_type' : null }}"
                                href="/rating/kora">Рейтинг расы Кора</a>
                        </div>
                        <div class="col-md-12">
                            <a class="{{ request()->is('rating/akr') ? 'checked_type' : null }}"
                                href="/rating/akr">Рейтинг расы Акретия</a>
                        </div>
                        <div class="col-md-12">
                            <a class="{{ request()->is('rating/Dalant') ? 'checked_type' : null }}"
                                href="/rating/Dalant">Рейтинг по Далантам</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 main_window">
        @if (Auth::check())
        <table class="table table-bordered table-sm">

            <tbody class="rating_users">
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td class="{{ request()->is('rating/bel', 'rating/kora', 'rating/akr') ? 'checked_type' : null }}">Lv</td>
                    <td class="{{ request()->is('rating/Dalant') ? 'checked_type' : null }}">Dalant</td>
                    <td>Race</td>
                    <td class="{{ request()->is('rating/PvpPoint') ? 'checked_type' : null }}">OC</td>
                </tr>
                @foreach ($raiting as $rai)
                <tr>
                    {{-- если начинается на !(GM) или на *(удаленный персонаж) --}}
                    @if(strpos($rai->Account, '!' ) === 0 || strpos($rai->Name, '*' ) === 0 )
                        <?php continue ?>
                    @else

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td class="name" id='{{$rai->Name}}'>
                        {{ $rai->Name }}
                    </td>
                    @endif

                    <td>{{  $rai->Lv  }} </td>

                    <td>{{  $rai->Dalant  }} </td>

                    <td>
                        @if($rai->Race == 0 || $rai->Race == 1 )
                            Bellato
                        @endif
                        @if($rai->Race == 4)
                            Accretia
                        @endif
                        @if($rai->Race == 2 || $rai->Race == 3 )
                            Cora
                        @endif
                    </td>
                    <td>{{  (int)$rai->PvpPoint  }} </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $raiting->links() }}
    </div>
</div>
@endif
@endsection