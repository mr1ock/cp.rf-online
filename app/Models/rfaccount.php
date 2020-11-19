<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rfaccount extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'tbl_rfaccount';
    protected $primaryKey = 'uid';

    /*
        public $incrementing = false;   
        protected $guarded = [];
    */

    /*protected $fillable = [
        'id',
        'password',
        'accounttype',
        'birthdate',
        'Email'
      ];*/

}
