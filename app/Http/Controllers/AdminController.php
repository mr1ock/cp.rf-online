<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index()
    {
        return view('adm\admin');
    }


    public function giveItem()
    {
        return view('adm\giveItem');
    }


    public function createGm()
    {

        return view('adm\createGm');
    }

    public function pers()
    {

        return view('adm\pers');
    }

    public function accounts()
    {


        return view('adm\accounts', [
            'info' => DB::table('tbl_rfaccount')
                ->join('tbl_UserAccount', 'tbl_UserAccount.id', 'tbl_rfaccount.id')
                ->select('tbl_UserAccount.id', 'password', 'Email', 'uilock_pw', 'serial')
                ->simplePaginate(18)

        ]);
    }


    public function getItem()
    {

        $ItemsDB = DB::connection('ItemsDB');
        return view('adm\itemPerson', [
            'itemPerson' => $ItemsDB->table('tbl_case_person')
                ->simplePaginate(8)

        ]);
    }
}
