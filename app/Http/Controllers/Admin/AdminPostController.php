<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\MyFacade\SmartPanel;




class AdminPostController extends Controller {

    private $SmartPanel;

    public function __construct() {
        $this->middleware('auth');
        $this->SmartPanel = app(SmartPanel::class);
    }

    //Изменить пароль пользователя
    public function changePassUser(Request $req) {
        
        $this->validate(request(),[
            'name' => 'required',
            'pass' => 'required'
        ]);
        
        $goodName = $this->SmartPanel->varifyLoginInTbl_Users($req->input('name'));     
        
        if($goodName == 0) {
            return redirect()->route('admin')->with('success', 'Такого логина не существует');
        } else 
            $this->SmartPanel->changePassAccount($req);
        
        return redirect()->route('admin')->with('success', 'Пароль успешно изменен!'); 
    }


    //Изменить пароль склада пользователя
    public function changePassSklad(Request $req) {

        $this->validate(request(),[
            'name' => 'required',
            'pass' => 'required'
        ]);
        $goodName = $this->SmartPanel->varifyLoginInTbl_Users($req->input('name')); 
        
        if($goodName == 0) {
            return redirect()->route('admin')->with('success', 'Такого аккаунта не существует');
        }else  
             $this->SmartPanel->changePassSklad($req);
        
        return redirect()->route('admin')->with('success', 'Пароль от склада изменен успешно!');
    }

    //Изменить ФГ
    public function changeFGpass(Request $req) {

        $this->validate(request(),[
            'name' => 'required',
            'pass' => 'required'
        ]);
        $goodName = $this->SmartPanel->varifyLoginInTbl_Users($req->input('name')); 
        
        if($goodName == 0) {
            return redirect()->route('admin')->with('success', 'Такого аккаунта не существует');
        }else
            $this->SmartPanel->changeFgPassword($req);      

        return redirect()->route('admin')->with('success', 'ФГ пароль изменен успешно!');
    }

    //Изменить кол-во cash монет
    public function changeCashMoney(Request $req) {
        $this->validate(request(),[

            'name' => 'required',
            'cash' => 'required'
        ]);
        $goodName = $this->SmartPanel->varifyLoginInTbl_Users($req->input('name')); 
        
        if($goodName == 0) {
            return redirect()->route('admin')->with('success', 'Такого логина в billinge не существует');
        } else
            $this->SmartPanel->changeCashMoney($req);
        
        
        return redirect()->route('admin')->with('success', 'Cash изменен успешно');
    }



    //Создать GM аккаунт
    public function createGm(Request $req) {
        
        $this->validate(request(),[
            'name' => 'required|min:6|max:12',
            'pass' => 'required|min:8|max:15',
            'grade' => 'required|min:1|max:1',
            'subgrade' => 'required|min:1|max:1'
        ]);
        $this->SmartPanel->createGmAccount($req);
        
        return redirect()->route('createGm')->with('success', 'Gm аккаунт успешно создан');
    }



    // Выводит инфу о персонаже
    public function viewPerson(Request $req) {
       
        if($req->name == null) {
            return redirect()->route('pers')->with('success', 'Введите ник персонажа');
        }
        $this->validate(request(),[
            'name' => 'required'
        ]);
        $goodName = $this->SmartPanel->varifyNameInTbl_Base($req->input('name'));
        
        //проверить если ли такой персонаж, если нету то вернуть на страницу поиска                
        if($goodName == 0) {
            return redirect()->route('pers')->with('success', 'Такого персонажа не существует');
        }    
        
        $personData = $this->SmartPanel->getPersonData($req->input('name'));

        return view('adm\pers', [
            'info' => $personData
        ]);
}


    //Изменить данные персонажа
    public function changePerson(Request $req) {
        $this->SmartPanel->changePersonData($req);

        return redirect()->route('pers')->with('success', 'Данные обновлены');
        
    }

    //Выдать предмет прерсонажу
    public function giveItems(Request $req) {
        $this->SmartPanel->giveItemPerson($req);

        return redirect()->route('giveItem')->with('success', 'Предмет выдан');
    }

    //Выводит инфу о персонажах на аккаунте
    public function getAccountInfo(Request $req) {

        $arrayData = $this->SmartPanel->viewPersonInAccount($req);
       
        return view('adm\accounts', [
            'info' => $arrayData['info'],
            
            'infoPers' => $arrayData['infoPers']
        ]);   
    }


}
