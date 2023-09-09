<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public function features()
    {
        return $this->belongsToMany(
            Feature::class,
             "plan_feature",
             "plan_id", 
             "feature_id"
            )->withPivot(["feature_value"]);
    }
}
