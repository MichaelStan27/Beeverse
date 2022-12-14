<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function receives()
    {
        return $this->hasMany(Transaction::class, 'user_id_sent');
    }

    public function headerHobbies()
    {
        return $this->hasMany(HeaderHobby::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function getBalanceFormatAttribute()
    {
        if (App::isLocale('en')) {
            return number_format($this->balance);
        }
        return number_format($this->balance, 0, null, '.');
    }
}
