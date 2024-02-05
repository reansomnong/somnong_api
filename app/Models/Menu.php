<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public function subMenu()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function Menu(){
        return $this->hasmany('Menu');
    }


    protected $fillable = [
        'icon',
        'pageName',
        'title',
        'parent_id',
        'ignore',
        'active',
        'ordering',
    ];
}
