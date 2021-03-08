<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerReview extends Model
{
    //
    protected $table = 'customerreview';
    protected $fillable = [
        'review_message'
    ];
}
