<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'member_id',
        'menu_id',
        'user_id',
        'volunteer_id',
        'member_name',
        'member_address',
        'deliver_menu_name',
        'deliver_menu_type',
        'partner_restaurant_name',
        'partner_address',
        'volunteer_name',
        'start_deliver_time',
        'delivery_status',
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

    public function volunteers()
    {
        return $this->belongsTo(Volunteer::class, 'user_id', 'id');
    }
}