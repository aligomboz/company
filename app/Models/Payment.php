<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_cash','remaining_for_batch', 'project_id','employee_id',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }
}
