<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use  HasFactory,Flagable, SoftDeletes;

    protected $appends = [
        'active','news_image_url'
      ];
  
      public const STATUS_ACTIVE = 'active';
      public const STATUS_NOT_ACTIVE = 'not-active';
      public const FLAG_ACTIVE = 1;
  
      public function getActiveAttribute() {
          return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
      }
      public function brand(){
        return $this->hasOne('App\Models\Brand','id','brand_id');
      } 
      public function getNewsImageUrlAttribute()
      {
          return url('/').'/storage/news/'.$this->id.'/'.$this->news_image;
      }
}
