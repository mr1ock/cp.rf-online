<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\MyFacade\SmartPanel;
use App\MyFacade\UserPanel;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    private $SmartPanel;
    private $UserPanel;

    public function __construct() {
        $this->middleware('auth');
        $this->SmartPanel = app(SmartPanel::class);
        $this->UserPanel = app(UserPanel::class);
    }

    public function index() {
        $idconvert = $this->SmartPanel->convertInBynary(Auth::user()->name);
        $status =  $this->UserPanel->viewPremiumStatus($idconvert);
        $fg =  $this->UserPanel->viewFG($idconvert);
        $accountData =  $this->UserPanel->getAccountData($idconvert);
        
        return view('mainAccount', [
            'cash' =>  $this->UserPanel->viewCash(Auth::user()->name),
            'accountData' => $accountData,
            'premium_status' => $status,
            'fg' => $fg
        ]);
    }
    
    public function donate() {
        return view('donate', [
            'cash' => $this->UserPanel->viewCash(Auth::user()->name)
        ]);
    }
    
    public function premium() {
        return view('premium', [
            'cash' => $this->UserPanel->viewCash(Auth::user()->name)
        ]);
    }

    public function statistic() {
        return view('statistic', [
            'cash' => $this->UserPanel->viewCash(Auth::user()->name),
            'status' => DB::table('tbl_status_users')->first()
        ]);
    }

    public function edit() {
        return view('editPassword', [
            'cash' => $this->UserPanel->viewCash(Auth::user()->name)
        ]);;
    }

    public function repair() {
        return view('repairPerson', [
            'cash' => $this->UserPanel->viewCash(Auth::user()->name)
        ]);
    }

    public function vote() {
        return view('vote', [
            'cash' => $this->UserPanel->viewCash(Auth::user()->name)
        ]);
    }
    
    //Функция парсит в ручную страницу с голосами и заносит все данные в бд 'tbl_mmotop' >disabled
    public function pars() {

        //Ссылка на страницу для парсинга данных
        $url = "https://mmotop.ru/votes/40615a399d0071248e36cf9c4e1fdf38b4f11e5f.txt?a433a26dba2ddb46beea30902a30fd1a";  

        $str = file_get_contents('https://mmotop.ru/votes/40615a399d0071248e36cf9c4e1fdf38b4f11e5f.txt?a433a26dba2ddb46beea30902a30fd1a');

        //Регулярка id
        preg_match_all('/\b(\d{9})\b/', $str, $resId);

        for($i = 0; $i < count($resId[0]); $i++){
            $id[$i] = $resId[0][$i];
        }
        //Регулярка логин
        preg_match_all('/[^\s]*[a-z](?!\s)[^\s]*/', $str, $resLogin);

        for($i = 0; $i < count($resLogin[0]); $i++){
            $login[$i] = $resLogin[0][$i];
        }
        //Регулярка дата голоса
        preg_match_all('/\d{2}\.\d{2}\.\d{4}\s\d{2}\:\d{2}\:\d{2}/', $str, $resDate);

        for($i = 0; $i < count($resDate[0]); $i++){
            $d = strtotime($resDate[0][$i]);
            $date1 = date("Y-m-d H:i:s", $d);
            $date[$i] = $date1;
        }
            //Очищаем для заполнения
            DB::table('tbl_mmotop')->where('id', '>', 1)->delete();
            //Заполнение таблицы с исходными данными голосов
            for($k = 0; $k < count($id); $k++ ) {
                DB::table('tbl_mmotop')->insert([[
                    'id' => $id[$k], 
                    'name' => $login[$k],
                    'status' => 'false',
                    'vote_date' => $date[$k]
                ]]);
            }
    }

}
