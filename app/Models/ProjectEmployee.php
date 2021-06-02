<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectEmployee extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id' , 'embloyee_id','type_job',
    ];
    public function employee(){
        return $this->belongsTo(Employee::class,'embloyee_id');
    }
    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }
}
