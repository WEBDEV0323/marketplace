<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Concerns\Flagable;

class User extends Authenticatable
{
    use HasFactory, Notifiable,Flagable;

   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'emailCode',
        'emailVerify',
        'email_verified',
        'email_verification_token',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'name',
        'gender',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
      'active','user_image'
    ];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_NOT_ACTIVE = 'not-active';
    public const FLAG_ACTIVE = 1;
    
    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;

    }
    public function getUserImageAttribute()
    {
        return url('/').'/storage/user/'.$this->id.'/'.$this->image_url;
    }
    public function user_address()
    {
        return $this->hasMany('App\Models\UserAddress','user_id','id');
    }

  public function vendor_request(){
    return $this->hasOne('App\Models\RequestVendor','user_id','id');
  } 
}
