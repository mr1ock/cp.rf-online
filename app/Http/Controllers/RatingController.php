<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\RatingRepository;
use App\MyFacade\UserPanel;

class RatingController extends Controller
{
    private $ratingRepository;
    private $UserPanel;

    public function __construct(RatingRepository $ratingRepository) {
        $this->middleware('auth');
        $this->ratingRepository = $ratingRepository;
        $this->UserPanel = app(UserPanel::class);
    }

    
    public function rating() {
        $resultRating = $this->ratingRepository->getRatingByOrder('PvpPoint');
        
        return view('rating', [
            'cash' => $this->UserPanel->viewCash(Auth::user()->name),
            'raiting' => $resultRating
        ]);
    }


    public function ratingBel() {
        $resultRating = $this->ratingRepository->getRatingByRace(0, 1);
        
        return view('ratingBel', [
            'cash' => $this->UserPanel->viewCash(Auth::user()->name),
            'raiting' => $resultRating
        ]);
    }

    public function ratingKora() {
        $resultRating = $this->ratingRepository->getRatingByRace(2, 3);
        
        return view('ratingKora', [
            'cash' => $this->UserPanel->viewCash(Auth::user()->name),
            'raiting' => $resultRating
        ]);
    }

    public function ratingAkr() {
        
        $resultRating = $this->ratingRepository->getRatingByRace(4);
        
        return view('ratingAkr', [
            'cash' => $this->UserPanel->viewCash(Auth::user()->name),
            'raiting' => $resultRating
        ]);
    }

    public function ratingDalant() {

        $resultRating = $this->ratingRepository->getRatingByOrder('Dalant');
        
        return view('ratingDalant', [
            'cash' => $this->UserPanel->viewCash(Auth::user()->name),
            'raiting' => $resultRating
        ]);
    }
}
