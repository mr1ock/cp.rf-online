<?php

namespace App\MyFacade;
use DB;

class ItemCase {


    private static $type10;
    private static $number10;
    private static $slot10;
    private static $key;
    private static $count;
    private static $modific;
    private static $D;
    private static $U;
    private static $serial;

    public function convertNumberInNameTable($type10){
        $convertNumberInNameTable = [
            
            '-1' => 'tbl_default',
            '0' => 'tbl_code_upper',
            '1' => 'tbl_code_lower',
            '2' => 'tbl_code_gauntlet',
            '3' => 'tbl_code_shoe',
            '4' => 'tbl_code_helmet',
            '6' => 'tbl_code_weapon',
            '7' => 'tbl_code_shield',
            '8' => 'tbl_code_cloak',
            '9' => 'tbl_code_ring',
            '10' => 'tbl_code_amulet',
            '11' => 'tbl_code_bullet',
            '12' => 'tbl_code_maketool',
            '13' => 'tbl_code_potion',
            '14' => 'tbl_code_bag',
            '15' => 'tbl_code_battery',
            '16' => 'tbl_code_ore',
            '18' => 'tbl_code_resource',
            '17' => 'tbl_code_force',
            '19' => 'tbl_code_unitkey',
            '20' => 'tbl_code_booty',
            '21' => 'tbl_code_map',
            '22' => 'tbl_code_town',
            '23' => 'tbl_code_battledungeon',
            '24' => 'tbl_code_animus',
            '25' => 'tbl_code_guardtower',
            '26' => 'tbl_code_trap',
            '27' => 'tbl_code_siegekit',
            '28' => 'tbl_code_ticket',
            '30' => 'tbl_code_recovery',
            '31' => 'tbl_code_box',
            '32' => 'tbl_code_firecracker',
            '33' => 'tbl_code_unmannedminer',
            '34' => 'tbl_code_radar',
            '35' => 'tbl_code_npclink'
           ];

           return $convertNumberInNameTable[$type10];
    }

    public function convertIdinNumberType($idNumber) {
            
        $convertIdinNumberType = [
            '-1' => 'tbl_default',
            'iu' => '00',
            'il' => '01',
            'ig' => '02',
            'is' => '03',
            'ih' => '04',
            'iw' => '06',
            'id' => '07',
            'ik' => '08',
            'ii' => '09',
            'ia' => '10',
            'ib' => '11',
            'im' => '12',
            'ip' => '13',
            'ie' => '14',
            'it' => '15',
            'io' => '16',
            'ir' => '18',
            'ic' => '17',
            'in' => '19',
            'iy' => '20',
            'iz' => '21',
            'iq' => '22',
            'ix' => '23',
            'ij' => '24',
            'gt' => '25',
            'tr' => '26',
            'sk' => '27',
            'ti' => '28',
            're' => '30',
            'bx' => '31',
            'fi' => '32',
            'un' => '33',
            'rd' => '34',
            'lk' => '35'
           ];
           return $convertIdinNumberType[$idNumber];
    }

    public function convertIdInNameTable($typeItem) {
        $convertIdinNameTable = [
            '-1' => 'tbl_default',
            'iu' => 'tbl_code_upper',
            'il' => 'tbl_code_lower',
            'ig' => 'tbl_code_gauntlet',
            'is' => 'tbl_code_shoe',
            'ih' => 'tbl_code_helmet',
            'iw' => 'tbl_code_weapon',
            'id' => 'tbl_code_shield',
            'ik' => 'tbl_code_cloak',
            'ii' => 'tbl_code_ring',
            'ia' => 'tbl_code_amulet',
            'ib' => 'tbl_code_bullet',
            'im' => 'tbl_code_maketool',
            'ip' => 'tbl_code_potion',
            'ie' => 'tbl_code_bag',
            'it' => 'tbl_code_battery',
            'io' => 'tbl_code_ore',
            'ir' => 'tbl_code_resource',
            'ic' => 'tbl_code_force',
            'in' => 'tbl_code_unitkey',
            'iy' => 'tbl_code_booty',
            'iz' => 'tbl_code_map',
            'iq' => 'tbl_code_town',
            'ix' => 'tbl_code_battledungeon',
            'ij' => 'tbl_code_animus',
            'gt' => 'tbl_code_guardtower',
            'tr' => 'tbl_code_trap',
            'sk' => 'tbl_code_siegekit',
            'ti' => 'tbl_code_ticket',
            're' => 'tbl_code_recovery',
            'bx' => 'tbl_code_box',
            'fi' => 'tbl_code_firecracker',
            'un' => 'tbl_code_unmannedminer',
            'rd' => 'tbl_code_radar',
            'lk' => 'tbl_code_npclink'
           ];

           return $convertIdinNameTable[$typeItem];
    }

    public function getItemToPersonCase($serial) {
        $RF_World = DB::connection('RF_World');
        $items = $RF_World->table('tbl_inven')
                            ->where('Serial', '=', $serial)
                            ->get();

        // Преобразует array/stdClass -> array
       $item = json_decode(json_encode($items), true);
        
       return $item;
    }


    public function convertSqlCode($item_number, $numberTypeItem, $slot){
    
        $typeItem16 = dechex($numberTypeItem);
        $slot16 = dechex($slot);
       
        if(strlen($typeItem16) == 1){
            $typeItem16 = 0 . $typeItem16;
        }
        if(strlen($slot16) == 1){
            $slot16 = 0 . $slot16;
        }

        $resultSqlCode = hexdec( dechex($item_number) . $typeItem16 . $slot16);
        return $resultSqlCode;
    }



    public function convertItem($item, $serial) {
        ItemCase::$serial = $serial;

        for($i = 0; $i <= 99; $i++){
            ItemCase::$key  = 'K'. $i;
            ItemCase::$D = 'D'. $i;
            ItemCase::$U = 'U'. $i;
         
        //Перевод sql кода(10 сис) в (16 сис)
        $sum16 = dechex($item[0][ItemCase::$key]);

        if($item[0][ItemCase::$key] >  0 ) {
            ItemCase::$count = 0;
            ItemCase::$modific = '0xfffffff';   
            ItemCase::$number10 = -1;
            ItemCase::$type10 = -1;
            ItemCase::$slot10 = -1;
        }

        if(strlen($sum16) ==  8 ) {

            ItemCase::$count = $item[0][ItemCase::$D];
            ItemCase::$modific = $item[0][ItemCase::$U];
            
                
            $number16 = substr($sum16,0,4);
            ItemCase::$number10 = hexdec($number16);

            $type16 = substr($sum16,4,2);
            ItemCase::$type10 = hexdec($type16);

            $slot16 = substr($sum16,6,2);
            ItemCase::$slot10 = hexdec($slot16);

        }

        if(strlen($sum16) ==  7 ) {
            ItemCase::$count = $item[0][ItemCase::$D];
            ItemCase::$modific = $item[0][ItemCase::$U];
            
                
            $number16 = substr($sum16,0,3);
            ItemCase::$number10 = hexdec($number16);

            $type16 = substr($sum16,3,2);
            ItemCase::$type10 = hexdec($type16);

            $slot16 = substr($sum16,5,2);
            ItemCase::$slot10 = hexdec($slot16);

        }
        if(strlen($sum16) ==  6 ) {
            
            ItemCase::$count = $item[0][ItemCase::$D];
            ItemCase::$modific = $item[0][ItemCase::$U];
            
                
            $number16 = substr($sum16,0,2);
            ItemCase::$number10 = hexdec($number16);

            $type16 = substr($sum16,2,2);
            ItemCase::$type10 = hexdec($type16);

            $slot16 = substr($sum16,4,2);
            ItemCase::$slot10 = hexdec($slot16);

        }
        if(strlen($sum16) ==  5 ) {
            ItemCase::$count = $item[0][ItemCase::$D];
            ItemCase::$modific = $item[0][ItemCase::$U];
            
                
            $number16 = substr($sum16,0,1);
            ItemCase::$number10 = hexdec($number16);

            $type16 = substr($sum16,1,2);
            ItemCase::$type10 = hexdec($type16);

            $slot16 = substr($sum16,3,2);
            ItemCase::$slot10 = hexdec($slot16);
            }
            $itemArray = ItemCase::getItemInfo();
        }
    }



    //Запись предметов в БД
    public function getItemInfo() {
        $ItemsDB = DB::connection('ItemsDB');
        //dd(ItemCase::$type10);

           for($i = -1; $i <= 35; $i++) {
               //проверяем каждую таблицу с переданным типом итема
            if(ItemCase::$type10 == $i){
                //Конвертируем номер в название таблицы для выборки
                $table = ItemCase::convertNumberInNameTable(ItemCase::$type10);
                $itemInfo = $ItemsDB->table($table)
                            ->where('item_id', '=', ItemCase::$number10)
                            ->select('item_code', 'item_name')
                            ->get();
                 
                $itemArray = json_decode(json_encode($itemInfo), true);

                //если не найдет предмет в bd
                if(isset($itemArray[0]['item_name']) == 0 ) {
                    $itemArray[0]['item_code'] = 'default';
                    $itemArray[0]['item_name'] = 'default';
                    
                }
                //записываем предмет в бд
                $ItemsDB->table('tbl_case_person')->insert([[
                    'K' => ItemCase::$key, 
                    'Slot' => ItemCase::$slot10,
                    'Number' => ItemCase::$number10,
                    'Typeitem' => ItemCase::$type10,
                    'ItemCode' => $itemArray[0]['item_code'],
                    'ItemName' => $itemArray[0]['item_name'],
                    'Count' => ItemCase::$count,
                    'Modif' => dechex(ItemCase::$modific),
                    'D' => ItemCase::$D,
                    'U' => ItemCase::$U,
                    'serial' => ItemCase::$serial
                ]]);  
            }
        }
        //удалить пустые слоты
        $ItemsDB->table('tbl_case_person')->where('slot', '=', '-1')->delete();
    }


    
    //Изменить предмет в ячейке
    public function changeItemInCase($req) {
        $ItemsDB = DB::connection('ItemsDB');
        $RF_World = DB::connection('RF_World');

        $itemCode = $req->ItemCode;
        $typeItem = substr($itemCode, 0, 2);

        $table = ItemCase::convertIdInNameTable($typeItem);

                $item_number = $ItemsDB->table($table)
                            ->where('item_code', '=', $itemCode)
                            ->value('item_id');
                           
           $numberTypeItem = ItemCase::convertIdinNumberType($typeItem);
           $slot = $req->Slot;

           $sqlItemCode = ItemCase::convertSqlCode($item_number, $numberTypeItem, $slot);
           
            //Переводим заточку HEX в Dec
            $convertU = hexdec($req->Modif);

            $RF_World->table('tbl_inven')->where('serial', '=', $req->serial)
                                         ->update(array( $req->K =>  $sqlItemCode,
                                                        $req->D => $req->Count,
                                                        $req->U =>  $convertU ));

            //после изменения удаляем данные таблицы                                            
            $ItemsDB->table('tbl_case_person')->delete();

            //Получить все предметы пользователя из сумки (serial передаем параметром)
            $item = ItemCase::getItemToPersonCase($req->input('serial'));
    
            //получаем данные по каждой ячейке в сумке
            ItemCase::convertItem($item, $req->input('serial'));


        }

        


        
}