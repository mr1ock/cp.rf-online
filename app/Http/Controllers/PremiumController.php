<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\MyFacade\UserPanel;
use App\MyFacade\SmartPanel;



class PremiumController extends Controller
{

    private $SmartPanel;
    private $UserPanel;

    public function __construct() {
        $this->SmartPanel = app(SmartPanel::class);
        $this->UserPanel = app(UserPanel::class);
    }

    public function buyPremiumAccount(Request $request) {
        $idconvert = $this->SmartPanel->convertInBynary(Auth::user()->name);
        $endDate = $this->UserPanel->veiwPremiumEndDate($idconvert);
        $today = Carbon::now()->addHours(3);

        if($today <= $endDate ){
            return redirect()->route('premium')->with('err', 'Вы уже имеете премиум подписку!' .' Активность до: '. $endDate);
        }
        $status = $this->UserPanel->connectionPremium($request, $idconvert);

        return redirect()->route('premium')->with($status['type'], $status['message']);
    }

}