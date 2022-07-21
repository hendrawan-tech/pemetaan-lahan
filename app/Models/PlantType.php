<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function land()
    {
        return $this->hasMany(Land::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
