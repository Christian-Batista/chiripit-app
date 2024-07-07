<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory,
    SoftDeletes;

    protected $fillable = [
        'user_id',
        'user_type_id',
        'profile_picture',
        'location',
        'phone_number',
        'bio',
        'availability',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userType()
    {
        return $this->belongsTo(User::class);
    }
}
