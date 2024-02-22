<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aboutus extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['about_type_key','image','titile','sub_titile','description','flags'];

    // about_type_keys 
       // banner_images
       // influencer_images
       // testimonial_images
       // industry_data
       // statistics
       //our_story
       //our_mission
       //our_vision
       //our_team
       //key_metrics
}
