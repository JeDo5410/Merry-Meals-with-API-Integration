<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'menu_title',
        'menu_description',
        'menu_image',
        'menu_allergens',
        'menu_nutritions',
        'ingredients',
        'safety_training',
        'expiry_date',
        'separate_storage',
    ];

    public function partners(){
        return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }
}
