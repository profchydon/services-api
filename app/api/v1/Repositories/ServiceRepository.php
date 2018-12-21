<?php

namespace App\Api\v1\Repositories;

use App\User;
use App\Escort;
use App\Service;
use App\Image;
use Illuminate\Http\Request;
use DB;


class ServiceRepository
{

    /**
   * Create a  new User
   *
   * @param object $request
   *
   * @return object $user
   *
   */
    public function create($request)
    {

      // Begin database transaction
      DB::beginTransaction();

      $service = Service::create([
        'escort_id' => $request->escort_id,
        '69 (69 sex position)' => $request->sixty_nine,
        'Anal Rimming (Licking anus)' => $request->anal_rimming,
        'A-Level (Anal sex)' => $request->a_level_anal,
        'BDSM (giving)' => $request->bdsm_giving,
        'BDSM (receiving)' => $request->bdsm_receiving,
        'Being Filmed' => $request->being_filmed,
        'Body Worship' => $request->body_worship,
        'Bondage' => $request->bondage,
        'CIM (Come in mouth)' => $request->cum_in_mouth,
        'COB (Come on body)' => $request->cum_on_body,
        'COF (Come on face)' => $request->cum_on_face,
        'Couples' => $request->couples,
        'DFK (Deep french kissing)' => $request->deep_french_kissing,
        'Dinner Dates' => $request->dinner_dates,
        'Domination' => $request->domination,
        'Domination (giving)' => $request->domination_giving,
        'Domination (receiving)' => $request->domination_receiving,
        'Double Penetration' => $request->double_penetration,
        'Erotic massage' => $request->erotic_massage,
        'Extraball (sex multiple times)' => $request->extraball,
        'Face Sitting' => $request->face_sitting,
        'Fetish' => $request->fetish,
        'Fisting (giving)' => $request->fisting_giving,
        'Fisting (receiving)' => $request->fisting_receiving,
        'Foot Fetish' => $request->foot_fetish,
        'French Kissing' => $request->french_kissing,
        'Gang Bang' => $request->gang_bang,
        'GFE (Girlfriend experience)' => $request->girl_friend_experience,
        'Golden shower' => $request->golden_shower,
        'Hand Relief' => $request->hand_relief,
        'Handjob' => $request->handjob,
        'Hardsports (giving)' => $request->hardsports_giving,
        'Hardsports (receiving)' => $request->hardsports_receiving,
        'Humiliation (giving)' => $request->humiliation_giving,
        'Humiliation (receiving)' => $request->humiliation_receiving,
        'Lap dancing' => $request->lap_dancing,
        'LT (Long Time; Usually overnight)' => $request->long_time,
        'Massage' => $request->massage,
        'MMF 3somes' => $request->mmf_threesome,
        'Modelling' => $request->modelling,
        'O-Level (Oral sex)' => $request->o_level_oral_sex,
        'Oral with condom' => $request->oral_with_condom,
        'OWO (Oral without condom)' => $request->oral_without_condom,
        'Parties (Mandatory sex parties)' => $request->parties,
        'Period Play' => $request->period_play,
        'Pregnant' => $request->pregnant,
        'Prostrate Massage' => $request->prostrate_massage,
        'PSE (Porn Star Experience)' => $request->porn_star_experience,
        'Receiving Oral' => $request->receiving_oral,
        'Rimming (giving)' => $request->rimming_giving,
        'Rimming (receiving)' => $request->rimming_receiving,
        'Role Play & Fantasy' => $request->role_play,
        'Sex toys' => $request->sex_toys,
        'Smoking (Fetish)' => $request->smoking_fetish,
        'Spanking (giving)' => $request->spanking_giving,
        'Spanking (receiving)' => $request->spanking_receiving,
        'Strap on' => $request->strap_on,
        'Swallow' => $request->swallow,
        'Swallow (at discretion)' => $request->swallow_at_discretion,
        'Swinging' => $request->swinging,
        'Tantric Massage' => $request->tantric_massage,
        'Threesome' => $request->threesome,
        'Tie & Tease' => $request->tie_and_tease,
        'Travel Companion' => $request->travel_companion,
        'Uniforms' => $request->uniforms,
        'Watersports (giving)' => $request->watersports_giving,
        'Watersports (receiving)' => $request->watersports_receiving,
        'Watching football' => $request->watching_football,
        'Walking' => $request->walking,
        'Beach parties' => $request->beach_parties,
        'Swimming' => $request->swimming,
        'Attending corporate parties' => $request->attending_corporate_parties,
        'Attending political rallies' => $request->attending_political_rallies,
        'Travelling companion' => $request->travelling_companion,
        'Travelling outside the city' => $request->travelling_outside_the_city,
        'Preparing a meal' => $request->preparing_a_meal,
      ]);


      if (!$service) {

        // If User isn't created, rollback database to initial state
        DB::rollback();

        return $service = "Oops! Sorry there was an error. Please try again";

      }else {

        // If User is created, commit transaction to the database
        DB::commit();

        return $service;

      }

    }


    /**
     * Create all Properties existing in the database
     *
     * @return object $properties
     *
     */
    public function services()
    {
      // Fetch all properties existing in the database
      $service = Service::first();

      // return list of properties;
      return $service;

    }

    public function updateServices ($request)
    {

        try {

            $escort = Escort::where('id' , $request->escort_id)->first();

            if ($escort !== NULL) {

                 $services = Service::where('escort_id' , $request->escort_id)->first();

                 $services->update([
                   'escort_id' => $request->escort_id,
                   '69 (69 sex position)' => $request->sixty_nine,
                   'Anal Rimming (Licking anus)' => $request->anal_rimming,
                   'A-Level (Anal sex)' => $request->a_level_anal,
                   'BDSM (giving)' => $request->bdsm_giving,
                   'BDSM (receiving)' => $request->bdsm_receiving,
                   'Being Filmed' => $request->being_filmed,
                   'Body Worship' => $request->body_worship,
                   'Bondage' => $request->bondage,
                   'CIM (Come in mouth)' => $request->cum_in_mouth,
                   'COB (Come on body)' => $request->cum_on_body,
                   'COF (Come on face)' => $request->cum_on_face,
                   'Couples' => $request->couples,
                   'DFK (Deep french kissing)' => $request->deep_french_kissing,
                   'Dinner Dates' => $request->dinner_dates,
                   'Domination' => $request->domination,
                   'Domination (giving)' => $request->domination_giving,
                   'Domination (receiving)' => $request->domination_receiving,
                   'Double Penetration' => $request->double_penetration,
                   'Erotic massage' => $request->erotic_massage,
                   'Extraball (sex multiple times)' => $request->extraball,
                   'Face Sitting' => $request->face_sitting,
                   'Fetish' => $request->fetish,
                   'Fisting (giving)' => $request->fisting_giving,
                   'Fisting (receiving)' => $request->fisting_receiving,
                   'Foot Fetish' => $request->foot_fetish,
                   'French Kissing' => $request->french_kissing,
                   'Gang Bang' => $request->gang_bang,
                   'GFE (Girlfriend experience)' => $request->girl_friend_experience,
                   'Golden shower' => $request->golden_shower,
                   'Hand Relief' => $request->hand_relief,
                   'Handjob' => $request->handjob,
                   'Hardsports (giving)' => $request->hardsports_giving,
                   'Hardsports (receiving)' => $request->hardsports_receiving,
                   'Humiliation (giving)' => $request->humiliation_giving,
                   'Humiliation (receiving)' => $request->humiliation_receiving,
                   'Lap dancing' => $request->lap_dancing,
                   'LT (Long Time; Usually overnight)' => $request->long_time,
                   'Massage' => $request->massage,
                   'MMF 3somes' => $request->mmf_threesome,
                   'Modelling' => $request->modelling,
                   'O-Level (Oral sex)' => $request->o_level_oral_sex,
                   'Oral with condom' => $request->oral_with_condom,
                   'OWO (Oral without condom)' => $request->oral_without_condom,
                   'Parties (Mandatory sex parties)' => $request->parties,
                   'Period Play' => $request->period_play,
                   'Pregnant' => $request->pregnant,
                   'Prostrate Massage' => $request->prostrate_massage,
                   'PSE (Porn Star Experience)' => $request->porn_star_experience,
                   'Receiving Oral' => $request->receiving_oral,
                   'Rimming (giving)' => $request->rimming_giving,
                   'Rimming (receiving)' => $request->rimming_receiving,
                   'Role Play & Fantasy' => $request->role_play,
                   'Sex toys' => $request->sex_toys,
                   'Smoking (Fetish)' => $request->smoking_fetish,
                   'Spanking (giving)' => $request->spanking_giving,
                   'Spanking (receiving)' => $request->spanking_receiving,
                   'Strap on' => $request->strap_on,
                   'Swallow' => $request->swallow,
                   'Swallow (at discretion)' => $request->swallow_at_discretion,
                   'Swinging' => $request->swinging,
                   'Tantric Massage' => $request->tantric_massage,
                   'Threesome' => $request->threesome,
                   'Tie & Tease' => $request->tie_and_tease,
                   'Travel Companion' => $request->travel_companion,
                   'Uniforms' => $request->uniforms,
                   'Watersports (giving)' => $request->watersports_giving,
                   'Watersports (receiving)' => $request->watersports_receiving,
                   'Watching football' => $request->watching_football,
                   'Walking' => $request->walking,
                   'Beach parties' => $request->beach_parties,
                   'Swimming' => $request->swimming,
                   'Attending corporate parties' => $request->attending_corporate_parties,
                   'Attending political rallies' => $request->attending_political_rallies,
                   'Travelling companion' => $request->travelling_companion,
                   'Travelling outside the city' => $request->travelling_outside_the_city,
                   'Preparing a meal' => $request->preparing_a_meal,
                 ]);

                return $services;

            }elseif (!$escort) {

                return  $escort = "User details not found";

            }

        } catch (\Exception $e) {

            return "Oops! Sorry there was an error. Please try again";

        }

    }

}
