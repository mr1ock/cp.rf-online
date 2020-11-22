<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DonateController extends Controller
{
    //функция пополнения счета
    public function AcceptYandex(Request $request) {

        $billing = DB::connection('sqlsrv_bil');
        $today = Carbon::now()->addHours(3);
    

        $hash = $_POST['notification_type'].
        '&'.$_POST['operation_id'].
        '&'.$_POST['amount'].
        '&'.$_POST['currency'].
        '&'.$_POST['datetime'].
        '&'.$_POST['sender'].
        '&'.$_POST['codepro'].
        '&'.'goBiQuJ290nqnq345+8+MBiF'.
        '&'.$_POST['label'];
        
        //1// faF/dPuJbWzgzmGMntKmQ7VI
        // 410012624645581
         
        //2//  AjFT5SBb9SSX2Zg3IF5+XVQV
        //  4100115690291695
        
        //текущее время + 3 часа(мск)
    
        $sha1 = hash("sha1", $hash);
        
          if($sha1 == $_POST['sha1_hash'] ){
            $cash_result = $billing->table('tbl_user')->where('UserID', '=', $_POST['label'])->value('Cash');
            
            $donate = round($_POST['amount']);

                //вычисляем бонус от суммы
                //добавляем 3% от суммы покупки, что бы уровнять коммиссию
               $donateBonus = ($donate / 100)*3;
               //донат+бонус
               $donate += $donateBonus;
               
            if($donate >= 490 && $donate <=980 ){
               $donateBonus = ($donate / 100)*5;
               $donate += $donateBonus;
            }
            
            if($donate >= 981 && $donate <=2945){
               $donateBonus = ($donate / 100)*10;
               $donate += $donateBonus;
            }
            
            if($donate >= 2940 ){
               $donateBonus = ($donate / 100)*15;
               $donate += $donateBonus;
            }
            
            $cash_result += $donate;
            $cash_result = round($cash_result);
            
            $billing->table('tbl_user')->where('UserID',  $_POST['label'] )->update(array('Cash' =>  $cash_result ));
            
            //Подходит для теста
            $cash_log = round($_POST['amount']);
            DB::table('donlogin')->insert([[
              'name' => $_POST['label'],
              'date' => $today, 
              'cash' => $cash_log
          ]]);
            
            //TEst
           // $billing->table('tbl_user')->where('UserID',  '1' )->update(array('Cash' =>  1 ));
            
        } else {
            exit('error');
        }
    }
}
