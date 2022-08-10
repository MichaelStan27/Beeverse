<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_sent()
    {
        return $this->belongsTo(User::class, 'user_id_sent');
    }

    public function avatar()
    {
        return $this->belongsTo(Avatar::class);
    }

    public function getDateAttribute()
    {
        $date = $this->created_at;

        return $date->format('M d, Y');
    }
}
