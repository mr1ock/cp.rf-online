<?php

namespace App\MyFacade;

use App\Repositories\RatingRepository;

class Rating {
    private $ratingRepository;

    public function __construct(RatingRepository $ratingRepository)
    {
        $this->ratingRepository = $ratingRepository;
    }

    public function getRating($typeRequest) {
        $raceArray = [
            'bel' => [0, 1],
            'kora' => [2, 3],
            'akr' => [4, 4]
        ];
    
        if ($typeRequest == 'PvpPoint' || $typeRequest == 'Dalant') {
            $resultRating = $this->ratingRepository->getRatingByOrder($typeRequest);
        } else {
            $resultRating = $this->ratingRepository
                ->getRatingByRace($raceArray[$typeRequest][0], $raceArray[$typeRequest][1]);
        }
        return $resultRating;
    }
    

}