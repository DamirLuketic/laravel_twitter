<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable =
        [
            'user_id',
            'text',
            'approved'
        ];

    protected function user()
    {
        return $this->belongsTo('App\User');
    }
}
