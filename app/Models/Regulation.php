<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regulation extends Model
{
    use HasFactory;
    protected $fillable = [
        'file',
        'original_name',
        'category_id',
    ];
    protected $appends=[
        'file_path'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getFilePathAttribute()
    {
        return asset('storage/' . $this->file);
    }
    public function getFileNameWithoutExtensionAttribute()
    {
        return pathinfo($this->file, PATHINFO_FILENAME);
    }
}
