<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function vote() {

         //Ссылка на страницу для парсинга данных
         $url = "https://mmotop.ru/votes/40615a399d0071248e36cf9c4e1fdf38b4f11e5f.txt?a433a26dba2ddb46beea30902a30fd1a";  

        //Спарсили инфу в эту переменную
        $str = file_get_contents($url);
    
        //Регулярка id
        preg_match_all('/\b(\d{9})\b/', $str, $resId);

        //если страница для парсинга не найдена или нет в ней записей(пустой массив)
        $voteError = 'Ошибка обработки голосов';
        if (isset($resId)) {
            return redirect()->route('vote')->with('success', $voteError );
        }
    
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
            $d = strtotime($resDate[0][$i]); // формируем из строки в дату
            $date1 = date("Y-m-d H:i:s", $d); // задаем формат даты
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
        
            
              
        //Текущая дата
        $today = Carbon::now()->addHours(3);
    
        $voteStatus = 'Ваш голос не найден';

        $input = Auth::user()->name;
        //$input = 'Katod'; 
        $billing = DB::connection('sqlsrv_bil');
        $cash = $billing->table('tbl_user')->where('UserID', '=', $input )->value('Cash');  //Получить кеш пользователя    
    
        //выбрать все с таблицы
        $idBd = DB::table('tbl_mmotop')->get();  
            //dd($idBd);
    
                //Все что выбрали проходим циклом
              foreach ($idBd as $name) {
                  //Если логин из таблицы совпадет с логином пользователя
                  if($name->name == $input  ){
                      //Узнать есть ли такой id, который уже голосовал
                    $goodid = DB::table('tbl_mmotop_good')
                        ->select('id')
                        ->where('id', '=', $name->id)
                        ->get()
                        ->count();
                       // dd($goodid);
                        //Если такой id уже был(голосовал) -> очистить этот голос из таблицы голосов
                        if($goodid != 0){
                            
                            DB::table('tbl_mmotop')->where('id', '=', $name->id)->delete();
                        }
                        //Если такого id нет в таблицы уже голосовавших
                        //Тогда записать данные голоса в таблицу результатов
                        else {
                            DB::table('tbl_mmotop_good')->insert([[
                                'id' => $name->id, 
                                'name' => $name->name,
                                'vote_date' => $name->vote_date,
                                'success_vote_date' => $today,
                                'status' => 'true'
                            ]]);
                            //И удалить из исходной таблицы
                            DB::table('tbl_mmotop')->where('id', '=', $name->id)->delete();
                            $voteStatus = 'Держи монетку '. $name->name;
                            //Наградить пользователя за голоса
                            $cash+= 5;
                            $billing->table('tbl_user')->where('UserID',  $input )->update(array('Cash' =>  $cash ));
                        }
                    } 
              }   
              
              return redirect()->route('vote')->with('success', $voteStatus );

    }
}
