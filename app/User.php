<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class User extends Authenticatable implements SluggableInterface
{

    use SluggableTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname',
        'display_name',
        'email',
        'password',
        'terms'
    ];


    protected $sluggable = [
        'build_from' => 'nickname',
        'save_to'    => 'slug',
        'on_update'  => true,
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function image()
    {
        return $this->hasOne('App\Image');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function follows()
    {
        return $this->hasMany('App\Follow');
    }
}
