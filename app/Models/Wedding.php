<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function galleryPhotos()
    {
        return $this->hasMany(GalleryPhoto::class);
    }
}
