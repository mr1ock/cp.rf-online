<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RatingRepository
{
    private $RF_World;

    public function __construct() {
        $this->RF_World = DB::connection('RF_World');
    }

    public function getRatingByOrder($orderBy){
        
        $result = $this->RF_World->table('tbl_base')
                    ->join('tbl_general', 
                        'tbl_general.Serial', 
                        'tbl_base.Serial'
                    )  
                    ->select('Name', 'Lv', 'Dalant',
                        'Race', 'PvpPoint', 'Account'
                    )                              
                    ->where([
                        ['DeleteName', '=', '*'],
                        ['AccountSerial', '<', '100000'],
                        ['Lv', '>', 40]
                    ])
                    ->orderBy($orderBy, 'desc')
                    ->simplePaginate(18);
        return $result;
    }

    public function getRatingByRace($race, $addRace){

        $result = $this->RF_World->table('tbl_base')
                    ->join('tbl_general',
                        'tbl_general.Serial',
                        'tbl_base.Serial'
                    ) 
                    ->select('Name', 'Lv', 'Dalant',
                        'Race', 'PvpPoint', 'Account'
                     )                               
                    ->where([
                        ['Race', '=', $race],
                        ['DeleteName', '=', '*'],
                        ['AccountSerial', '<', '100000'],
                        ['Lv', '>', 40]
                    ])
                    ->orWhere('Race', $addRace)
                    ->orderBy('Lv', 'desc')
                    ->simplePaginate(18);
        return $result;
    }
}
