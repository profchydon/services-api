<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Service extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'escort_id', '69 (69 sex position)', 'Anal Rimming (Licking anus)', 'A-Level (Anal sex)', 'BDSM (giving)', 'BDSM (receiving)', 'Being Filmed', 'Body Worship', 'Bondage', 'CIM (Come in mouth)', 'COB (Come on body)', 'COF (Come on face)', 'Couples', 'DFK (Deep french kissing)', 'Dinner Dates', 'Domination', 'Domination (giving)', 'Domination (receiving)', 'Double Penetration', 'Erotic massage',
      'Extraball (Having sex multiple times)', 'Face Sitting', 'Fetish', 'Fisting (giving)', 'Fisting (receiving)', 'Foot Fetish', 'French Kissing', 'Gang Bang', 'GFE (Girlfriend experience)', 'Golden shower', 'Hand Relief', 'Handjob', 'Hardsports (giving)', 'Hardsports (receiving)', 'Humiliation (giving)', 'Humiliation (receiving)', 'Lap dancing', 'LT (Long Time; Usually overnight)', 'Massage', 'MMF 3somes',
      'Modelling', 'O-Level (Oral sex)', 'Oral with condom', 'OWO (Oral without condom)', 'Parties (Mandatory sex parties)', 'Period Play', 'Pregnant', 'Prostrate Massage', 'PSE (Porn Star Experience)', 'Receiving Oral', 'Rimming (giving)', 'Rimming (receiving)', 'Role Play & Fantasy', 'Sex toys', 'Smoking (Fetish)', 'Spanking (giving)', 'Spanking (receiving)', 'Strap on', 'Swallow', 'Swallow (at discretion)',
      'Swinging', 'Tantric Massage', 'Threesome', 'Tie & Tease', 'Travel Companion', 'Uniforms', 'Watersports (giving)', 'Watersports (receiving)', 'Watching football', 'Walking', 'Beach parties', 'Swimming', 'Attending corporate parties', 'Attending political rallies', 'Travelling companion', 'Travelling outside the city', 'Preparing a meal',
    ];

}
