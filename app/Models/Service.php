<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_ar',
        'title_en',
        'content_ar',
        'content_en',
        'image',
    ];
    protected $appends = [
        'image_path'
    ];

    public function getTitleAttribute()
    {
        return $this['title_' . app()->getLocale()];
    }
    public function getContentAttribute()
    {
        return $this['content_' . app()->getLocale()];
    }
    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
