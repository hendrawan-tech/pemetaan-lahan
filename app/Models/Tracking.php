<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function detail()
    {
        return $this->hasMany(TrackingDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
