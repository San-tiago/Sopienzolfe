<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiverDetails extends Model
{
    //
    protected $fillable = [
        'fromemail','receivername','receiveraddress','receivercontactnumber',
    ];
}