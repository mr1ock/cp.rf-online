<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyFacade\SmartPanel;
use Illuminate\Support\Facades\DB;
use App\MyFacade\ItemCase;

class PostItemController extends Controller{

    private $ItemCase;
    private $ItemsDB;

    public function __construct(){
        $this->ItemCase = app(ItemCase::class);
        $this->ItemsDB = DB::connection('ItemsDB');
    }

    public function getItem(Request $req) {

        $this->ItemsDB->table('tbl_case_person')->delete();

        //Получить все предметы пользователя из сумки (serial передаем параметром)
        $item = $this->ItemCase->getItemToPersonCase($req->input('serial'));

        //получаем данные по каждой ячейке в сумке 
        $this->ItemCase->convertItem($item, $req->input('serial'));
        
        return view('adm\itemPerson', [
            'itemPerson' => $this->ItemsDB->table('tbl_case_person')
            //->orderBy('slot', 'desc')
            ->simplePaginate(8)
        ]);
    }


    public function editItemInCase(Request $req){

        $this->ItemCase->changeItemInCase($req);

        return view('adm\itemPerson', [
            'itemPerson' => $this->ItemsDB->table('tbl_case_person')
            //->orderBy('slot', 'desc')
            ->simplePaginate(8)
        ]);
    }



}
