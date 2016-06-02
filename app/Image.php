<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable =
        [
            'user_id',
            'profile_image',
            'cover_image',
        ];

    public $profile_image_directory = "/laravel_twitter/public/profile_image/";

    public function getProfileImageAttribute($value)
    {
        return $this->profile_image_directory . $value;
    }



    public $cover_image_directory = "/laravel_twitter/public/cover_image/";

    public function getCoverImageAttribute($value)
    {
        return $this->cover_image_directory . $value;
    }
}
