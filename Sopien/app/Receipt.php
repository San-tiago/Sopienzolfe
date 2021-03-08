<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    //
    protected $table = 'receipts';
    protected $fillable = [
        'customer_id','receipt_name',
    ];
}
