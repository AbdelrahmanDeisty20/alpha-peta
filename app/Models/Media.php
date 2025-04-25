<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'service_id'
    ];

    protected $appends = [
        'image_path'
    ];
    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
