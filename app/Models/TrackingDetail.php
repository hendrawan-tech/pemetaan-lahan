<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tracking()
    {
        return $this->belongsTo(Tracking::class);
    }

    public function item()
    {
        return $this->hasMany(TrackingItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
