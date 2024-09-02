<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'member_meal_type',
        'member_meal_duration',
        'member_extends_reason',
        'service_eligibility',
        'dietary',
        'reassessment_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function feedback(){
        return $this->hasMany(Feedback::class);
    }
}