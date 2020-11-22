<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\MyFacade\UserPanel;
use App\MyFacade\Rating;

class RatingController extends Controller
{
    private $UserPanel;
    private $Rating;

    public function __construct()
    {
        $this->middleware('auth');
        $this->UserPanel = app(UserPanel::class);
        $this->Rating = app(Rating::class);
    }

    public function rating($typeRequest)
    {
        $resultRating = $this->Rating->getRating($typeRequest);
        return view('rating/ViewRating', [
            'cash' => $this->UserPanel->viewCash(Auth::user()->name),
            'raiting' => $resultRating
        ]);
    }
}
