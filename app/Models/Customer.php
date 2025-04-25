<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'image'
    ];
    public function getNameAttribute()
    {
        return $this['name_' . app()->getLocale()];
    }
    public function getDescriptionAttribute()
    {
        return $this['description_' . app()->getLocale()];
    }
    protected $appends=[
        'image_path'
    ];
    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
