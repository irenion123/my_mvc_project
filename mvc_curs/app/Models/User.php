<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'birthday',
        'email',
        'password',
        'salt',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'birthday' => 'datetime',
    ];

    protected $appends = [
        'reserved_books'
    ];

    public function getAuthIdentifierName()
    {
        return 'user_id';
    }

    public function getReservedBooksAttribute()
    {
        $array = DB::select(
            'select book_id from users_have_books where user_id = :id',
            ['id' => $this->user_id]
        );
        return array_column($array, 'book_id');
    }
}
