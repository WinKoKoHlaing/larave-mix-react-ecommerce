<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone', 'password','image','address'
    ];
    protected $appends = ['image_url'];
    public function getImageUrlAttribute(){
        return asset('/images/'.$this->image);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cart(){
        return $this->hasMany(ProductCart::class);
    }

    public function order(){
        return $this->hasMany(ProductOrder::class);
    }

    public function review(){
        return $this->hasMany(ProductReview::class);
    }

    public function profile(){
        return $this->belongsTo(Profile::class);
    }
}
