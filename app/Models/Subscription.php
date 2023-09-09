<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $casts=[
        "expires_at"=>"datetime",
    ];

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

   

}
