<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name' , 'requirements_name','start_date','end_date','description',
        'files' , 'price','client_id','is_active',
    ];
    

    public function client (){
        return $this->belongsTo(Client::class,'client_id');
    }
    public function embloyees(){
        return $this->belongsToMany(Employee::class,'project_embloyees');
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
    
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
