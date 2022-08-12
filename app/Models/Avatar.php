<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Avatar extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function getNameAttribute()
    {
        return strtok($this->image, '.');
    }

    public function getPriceFormatAttribute()
    {
        if (App::isLocale('en')) {
            return number_format($this->attributes['price']);
        }
        return number_format($this->attributes['price'], 0, null, '.');
    }
}
