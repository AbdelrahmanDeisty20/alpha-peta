<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable= [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'code_vervication'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
