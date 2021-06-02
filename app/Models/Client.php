<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name' , 'email','phone','AccessMethods','note','is_active'
    ];

    // protected $casts = [
    //     'is_active' => 'boolean',
    // ];

    public function getActive(){
        return $this->is_active == 0 ? 'Not activated' : 'Activated ';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

}
