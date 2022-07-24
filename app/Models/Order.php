<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function massage()
    {
        return $this->hasMany(MessageOrder::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
