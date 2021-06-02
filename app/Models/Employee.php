<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'name' , 'email','phone','start_job','end_job',
        'contract' , 'sallary','description','is_active'
    ];

    public function projects(){
        return $this->belongsToMany(Project::class,'project_embloyees');
    }

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
