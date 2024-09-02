<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_fee',
        'donor_tribute',
        'donor_honoree_name',
    ];
}