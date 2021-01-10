<?php

namespace App\MyFacade;
use Illuminate\Support\Facades\DB;
use App\MyFacade\ItemCaseFacade as ItemCase;
use Illuminate\Support\Facades\Auth;


class SmartPanel {
    
    public function convertInBynary($sourceData) {
        return DB::raw("CONVERT(VARBINARY(MAX), '". $sourceData ."')");
    }

    public function varifyLoginInTbl_Users($login) {

        return DB::table('users')
                    ->select('name')
                    ->where('name', '=', $login)
                    ->get()
                    ->count();   
    }  
    
    public function varifyNameInTbl_Base($name) {

        $RF_World = DB::connection('RF_World');
        return $RF_World->table('tbl_base')
                        ->select('Name')
                        ->where('Name', '=', $name)
                        ->get()
                        ->count();  
    }  

    public function viewAccountSerial($login) {
        $RF_World = DB::connection('RF_World');
        return $RF_World->table('tbl_base')
                        ->where('Account', '=', $login)
                        ->value('AccountSerial');
    }
    
    public function changePassAccount($req) {
        $password = bcrypt($req->input('pass'));

        $idconvert = $this->SmartPanel->convertInBynary($req->input('name'));
        $passConvert = $this->SmartPanel->convertInBynary($req->input('pass'));

        DB::table('users')->where('name',  $req->input('name'))
                    ->update(array('password' => $password ));
                    
        DB::table('tbl_rfaccount')->where('id',  $idconvert)
                    ->update(array('password' => $passConvert ));
    }

    public function changePassSklad($req) {
        $RF_World = DB::connection('RF_World');
        $passConvert = $this->SmartPanel->convertInBynary($req->input('pass'));

        $serial =$this->SmartPanel->viewAccountSerial($req->input('name'));

        $RF_World->table('tbl_AccountTrunk')
                 ->where('AccountSerial',  $serial)
                 ->update(array('TrunkPass' => $passConvert ));
    }

    public function changeFgPassword($req) {
        $idconvert = $this->SmartPanel->convertInBynary($req->input('name'));
        $passConvert = $this->SmartPanel->convertInBynary($req->input('pass'));
       
        DB::table('tbl_UserAccount')->where('id',  $idconvert)
                    ->update(array('uilock_pw' => $passConvert ));
    }

    public function changeCashMoney($req) {
        $billing = DB::connection('sqlsrv_bil');
        $billing->table('tbl_user')
                ->where('UserID',  $req->input('name') )
                ->update(array('Cash' =>  $req->input('cash') ));
    }

    public function createGmAccount($req) {
        $billing = DB::connection('sqlsrv_bil');
        $idconvert = $this->SmartPanel->convertInBynary($req->input('name'));
        $passConvert = $this->SmartPanel->convertInBynary($req->input('pass'));

        DB::table('tbl_StaffAccount')->insert([[
            'ID' => $idconvert, 
            'PW' => $passConvert,
            'Grade' => $req->input('grade'), 
            'SubGrade' => $req->input('subgrade'),
            'Depart' => 'name',
            'RealName' => 'name',
            'birthday' => 'None',
            'ComClass' => 'GM'

        ]]);

        $billing->table('tbl_user')->insert([[
            'UserID' => $req->input('name'),
            'Cash' => 10000
        ]]);

    }

    public function getPersonData($name) {
        $RF_World = DB::connection('RF_World');
        
        return $RF_World->table('tbl_base')
                    ->where('Name', '=', $name)
                    ->join('tbl_general', 'tbl_general.Serial', 'tbl_base.Serial')
                    ->join('tbl_pvporderview', 'tbl_pvporderview.serial', 'tbl_base.Serial')
                    ->select('tbl_base.Serial','Name', 'AccountSerial','Account','Slot',
                            'DeleteName', 'Race', 'Class', 'Lv', 'Dalant', 'Gold',
                            'MaxLevel', 'tbl_general.PvpPoint', 'TotalPlayMin', 
                            'tbl_pvporderview.PvpCash', 'tbl_base.DCK')
                    ->first();
    }

    public function changePersonData($req) {
        $RF_World = DB::connection('RF_World');

        $RF_World->table('tbl_base')
                 ->where('Serial', $req->Serial )
                 ->update(array(
                    'Name' => $req->Name,
                    'AccountSerial' => $req->AccountSerial,
                    'Account' => $req->Account,
                    'Slot' => $req->Slot,
                    'Race' => $req->Race,
                    'Class' => $req->Class,
                    'Lv' => $req->Lv,
                    'Dalant' => $req->Dalant,
                    'Gold' => $req->Gold,
                    'DeleteName' => $req->DeleteName,
                    'DCK' => $req->DCK
        ));
        
        $RF_World->table('tbl_general')
                ->where('Serial', $req->Serial )
                ->update(array(
                    'MaxLevel' => $req->MaxLevel,
                    'PvpPoint' => $req->PvpPoint
        ));

        $RF_World->table('tbl_pvporderview')->where('serial', $req->Serial )
                 ->update(array(
                     'PvpPoint' => $req->PvpPoint,
                     'PvpCash' => $req->PvpCash

        ));
        
        $RF_World->table('tbl_NpcData')->where('Serial', '=', $req->Serial)->delete();
    }

    public function giveItemPerson($req) {
        $RF_World = DB::connection('RF_World');
        $ItemsDB = DB::connection('ItemsDB');

        $itemCode = $req->nItemCode_K;

        $typeItem = substr($itemCode, 0, 2);
        $table = ItemCase::convertIdInNameTable($typeItem);

        $item_number = $ItemsDB->table($table)
                            ->where('item_code', '=', $itemCode)
                            ->value('item_id');
        $slot = 255;                    

        $numberTypeItem = ItemCase::convertIdinNumberType($typeItem);   
        $sqlItemCode = ItemCase::convertSqlCode($item_number, $numberTypeItem, $slot);                 
        

        //Переводим HEX в Dec
        $nItemCode_UConvert = hexdec($req->nItemCode_U);

        $RF_World->table('tbl_ItemCharge')->insert([[
            'nAvatorSerial' => $req->nAvatorSerial, 
            'nItemCode_K' => $sqlItemCode,
            'nItemCode_U' => $nItemCode_UConvert,
            'nItemCode_D' => $req->nItemCode_D,
            'T' => $req->T
        ]]);
    }


    public function viewPersonInAccount($req){
        $RF_World = DB::connection('RF_World');

        $idconvert = $this->SmartPanel->convertInBynary($req->input('name'));

        $arrayData['info'] = DB::table('tbl_rfaccount')
                    ->where('tbl_UserAccount.id', '=', $idconvert)
                    ->join('tbl_UserAccount', 'tbl_UserAccount.id', 'tbl_rfaccount.id')
                    ->select('tbl_UserAccount.id','password', 'Email','uilock_pw', 'serial')
                    ->simplePaginate(18);

        $arrayData['infoPers'] = $RF_World->table('tbl_base')
                            ->where('Account', '=', $req->input('name') )
                            ->select('serial', 'Name', 'Account', 'Slot', 'Race', 'DeleteName', 'Class', 'Lv', 'DCK')
                            ->orderBy('Slot', 'asc')
                            ->get(); 
                            
        return $arrayData;                    

    }
}