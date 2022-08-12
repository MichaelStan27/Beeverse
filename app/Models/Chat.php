<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function getTimeCreatedAttribute()
    {
        $date = $this->created_at;

        return $date->format('H:i A');
    }

    public function getDateCreatedAttribute()
    {
        $date = $this->created_at;

        return $date->format('M d, Y');
    }

    public function getDateCompareAttribute()
    {
        $date = $this->created_at;

        return $date->format('Y-m-d');
    }
}
