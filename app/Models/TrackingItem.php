<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function detail()
    {
        return $this->belongsTo(TrackingDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
