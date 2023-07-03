<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'pin',
        'is_reserved'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->using(Reservation::class);
    }

    public function usersThatLiked()
    {
         return $this->belongsToMany(User::class)->using(Favorite::class);
    }
}
