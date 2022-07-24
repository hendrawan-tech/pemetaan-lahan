<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function land()
    {
        return $this->belongsTo(Land::class);
    }
    public function plantType()
    {
        return $this->belongsTo(PlantType::class);
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function item()
    {
        return $this->hasMany(Product::class);
    }
}
