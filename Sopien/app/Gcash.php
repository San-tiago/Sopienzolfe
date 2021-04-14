<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gcash extends Model
{
    //
    protected $table = 'gcash';

    protected $fillable = [
        'gcash_contactnumber','gcash_image'
    ];
}
