<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    use HasFactory,HasUuids;
    // public $incrementing=false;
    // protected $keyType="string";

    // protected static function booted()
    // {
    //     parent::booted();
    //     static::creating(function(Stream $stream){
    //         $stream->id=Str::uuid();
    //     });
    // }
}
