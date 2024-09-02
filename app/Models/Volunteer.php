<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'volunteer_vaccination',
        'volunteer_duration',
        'volunteer_available',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // public function setAvailableAttribute($value)
    // {
    //     $this->attributes['volunteer_available'] = json_encode($value);
    // }

    // public function getAvailableAttribute($value)
    // {
    //     $this->attributes['volunteer_available'] = json_decode($value);
    // }
}