<?php

namespace App\Models\API\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gb_pos_exchange extends Model
{
    use HasFactory;
    protected $fillable = [
        'currency_code',
        'currency',
        'symbol',
        'active',
    ];
}
