<?php

namespace App\MyFacade;
use Illuminate\Support\Facades\Auth;
use App\MyFacade\SmartPanel;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\rfaccount;


class UserPanel {

    private $tbl_rfaccount;
    private $SmartPanel;
    private $billing;
    private $RF_World;

    public function __construct() {
        $this->tbl_rfaccount = app(rfaccount::class);
        $this->SmartPanel = app(SmartPanel::class);
        $this->billing = DB::connection('sqlsrv_bil');
        $this->RF_World = DB::connection('RF_World');
    }

    public function viewCash($person) {
        $this->billing = DB::connection('sqlsrv_bil');
        return $this->billing->table('tbl_user')->where('UserID', '=', $person )->value('Cash');
    }

    public function viewFG($idconvert) {
       return DB::table('tbl_UserAccount')->where('id', '=', $idconvert)->value('uilock_pw');
    }

    public function getAccountData($idconvert) {
       return DB::table('tbl_UserAccount')->where('ID', '=', $idconvert)->first();
    }

    public function viewPremiumStatus($idconvert) {

        $premium_date = $this->billing->table('tbl_personal_billing')->where('ID', '=', $idconvert )->value('EndDate');
        $billing_type = $this->billing->table('tbl_personal_billing')->where('ID', '=', $idconvert )->value('BillingType');

        if($premium_date >= (Carbon::now()->addHours(3)) && ($billing_type == 2)){
            $endprem_date = date('Y.m.d H:m:s', strtotime($premium_date));
            $status = 'premium до-> ' . $endprem_date; 
        }else {
            $status = 'standart';
        }
        return $status;
    }

    public function veiwPremiumEndDate($idconvert){
        return $this->billing->table('tbl_personal_billing')->where('ID', '=', $idconvert )->value('EndDate');
    }

    public function connectionPremium($request, $idconvert) {

        $today15 = Carbon::now()->addDays(15)->addHours(3);
        $cash_result = $this->UserPanel->viewCash(Auth::user()->name);

        //Если реквест с премом на 15 дней
        if ($request->input('type') == 1) {
            
            if($cash_result >= 180) {
            $cash_result -= 180;
            $this->billing->table('tbl_user')->where('UserID',  (Auth::user()->name))
                    ->update(array('Cash' =>  $cash_result ));
               
            $this->billing->table('tbl_personal_billing')->where('ID',  $idconvert)
                    ->update(array(
                        'BillingType' => 2,
                        'EndDate' => $today15
                    ));
                $status['type'] = 'success';
                $status['message'] = 'Успешное подкоючение';
            }else {
                $status['type'] = 'err';
                $status['message'] = 'У Вас недостаточно монет!';
            }
        }    
        
        $today30 = Carbon::now()->addDays(30)->addHours(3);
        //Если реквест с премом на 30 дней
        if ($request->input('type') == 2) {
        
            if($cash_result >= 300) {
            $cash_result -= 300;
            $this->billing->table('tbl_user')->where('UserID',  (Auth::user()->name))
                    ->update(array('Cash' =>  $cash_result ));
               
            $this->billing->table('tbl_personal_billing')->where('ID',  $idconvert)
                    ->update(array(
                        'BillingType' => 2,
                        'EndDate' => $today30
                    ));
                $status['type'] = 'success';
                $status['message'] = 'Успешное подкоючение';
            }else {
                $status['type'] = 'err';
                $status['message'] = 'У Вас недостаточно монет!';
            }
        }
        return $status;
    }

    public function changePassword($req){

        $oldPassword = $req->input('password');
        $newPassword = $req->input('new_password');

        $idconvert = $this->SmartPanel->convertInBynary(Auth::user()->name);
        $passConvert = $this->SmartPanel->convertInBynary($newPassword);
        
        if(Hash::check($oldPassword, Auth::user()->password)) {

            $req->user()->update([
                'password' => Hash::make($newPassword)
            ]);
                    
            $this->tbl_rfaccount->where('id',  $idconvert)->update([
                'password' => $passConvert 
            ]);

            $resultMessage = 'Пароль успешно изменен!'; 
        }else {
            $resultMessage = 'Неверный пароль!';
        }
        return $resultMessage;
    }

    public function fixErrorPerson($req) {
        $serial = $this->RF_World->table('tbl_base')->where('Name', '=', ($req->input('name')))->value('Serial');
        
        $this->RF_World->table('tbl_NpcData')->where('Serial', '=', $serial)->delete();
    }
}