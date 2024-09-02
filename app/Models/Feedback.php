<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'order_id',
        'member_id',
        'rating',
        'comments',
        'feedback_date',
    ];

    protected $cast = [
        'feedback_date' => 'datetime',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function member(){
        return $this->belongsTo(Member::class);
    }
}
