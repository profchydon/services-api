<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Escort extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id', 'gender', 'country', 'state', 'city', 'year_of_birth', 'ethnicity', 'bust_size', 'height', 'weight', 'build', 'looks', 'availability', 'smoker',
      'about', 'sex_orientation', 'language', 'verified', 'rank', 'views', 'incall_1hr', 'incall_1dy', 'incall_overnight', 'incall_1wk', 'outcall_1hr', 'outcall_1dy', 'outcall_overnight', 'outcall_1wk', 'verification_ongoing' , 'video_sex' , 'sex_chat' , 'phone_sex', 'nudes'
    ];

}
