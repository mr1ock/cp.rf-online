<?php

namespace App\Http\Controllers;
use App\Http\Requests\ChangePasswordUserRequest;
use App\Http\Requests\FixPersonRequest;
use App\MyFacade\UserPanel;


class OptionsPersonController extends Controller
{

    private $UserPanel;

    public function __construct() {
        $this->middleware('auth');
        $this->UserPanel = app(UserPanel::class);
    }

    public function changePasswordUser(ChangePasswordUserRequest $req) {
            
        $resultMessage = $this->UserPanel->changePassword($req);
        
        return redirect()->route('editpass')->with('success', $resultMessage);
    }

    public function fixPerson(FixPersonRequest $req) {
        
        $this->UserPanel->fixErrorPerson($req);

        return redirect()->route('repairPerson')->with('success', 'Успешный ремонт персонажа');
    }

}