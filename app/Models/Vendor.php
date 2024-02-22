<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Concerns\Flagable;

class Vendor extends Authenticatable
{
    use Notifiable,Flagable;
    protected $appends = [
        'active','vendor_image'
      ];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_NOT_ACTIVE = 'not-active';
    public const FLAG_ACTIVE = 1;

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;

    }

    protected $guard = 'vendor';

    protected $fillable = [
        'first_name','last_name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function getVendorImageAttribute()
    {
        return url('/').'/storage/vendor/'.$this->id.'/'.$this->image_url;
    }

}
