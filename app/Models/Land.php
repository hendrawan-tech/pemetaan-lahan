<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plantType()
    {
        return $this->belongsTo(PlantType::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
