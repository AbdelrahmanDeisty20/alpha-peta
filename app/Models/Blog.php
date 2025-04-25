<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
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
        'image_path',
        'date'
    ];
    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }
    public function getTitleAttribute()
    {
        return $this['title_' . app()->getLocale()];
    }
    public function getContentAttribute()
    {
        return $this['content_' . app()->getLocale()];
    }
    public function getDateAttribute()
    {
        \Carbon\Carbon::setLocale(app()->getLocale());
        return \Carbon\Carbon::parse($this->created_at)->translatedFormat('j F Y');
    }
}
