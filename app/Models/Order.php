<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'member_id',
        'menu_id',
        'user_id',
        'member_name',
        'member_address',
        'partner_address',
        'member_phone',
        'order_menu_image',
        'order_menu_name',
        'order_menu_type',
        'order_menu_restaurant',
        'menu_plan',
        'order_cooking_status',
        'order_received_status',
        'start_cooking_time',
    ];

    public function partners()
    {
        return $this->belongsTo(Partner::class, 'user_id', 'id');
    }

    public function members()
    {
        return $this->belongsTo(Member::class, 'user_id', 'id');
    }

    public function menus()
    {
        return $this->belongsTo(Menu::class, 'user_id', 'id');
    }
}