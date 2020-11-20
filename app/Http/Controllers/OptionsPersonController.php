<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyFacade\UserPanel;


class OptionsPersonController extends Controller
{


    private $UserPanel;

    public function __construct() {
        $this->UserPanel = app(UserPanel::class);
    }

    public function changePasswordUser(Request $req) {
            
        $resultMessage = $this->UserPanel->changePassword($req);
        
        return redirect()->route('editpass')->with('success', $resultMessage);
    }

    public function fixPerson(Request $req) {
        
        $this->validate(request(),[
            'name' => 'required'
        ]);
        
        $this->UserPanel->fixErrorPerson($req);

        return redirect()->route('repairPerson')->with('success', 'Успешный ремонт персонажа');
    }

}