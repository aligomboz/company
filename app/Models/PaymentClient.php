<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentClient extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id' , 'client_id','batch_price','payments','rest_of_batch',
    ];

    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }
}
