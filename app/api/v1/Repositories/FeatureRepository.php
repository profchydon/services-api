<?php

namespace App\Api\V1\Repositories;

use App\Feature;
use App\User;
use App\Escort;
use App\Transaction;
use Illuminate\Http\Request;
use DB;

/**
 *
 */
class FeatureRepository
{

    public function create($request)
    {

      DB::beginTransaction();

      $feature = Feature::create([
        'escort_id' => $request->escort_id,
        'duration' => $request->duration,
        'status' => "Ongoing",
      ]);

      $transaction = Transaction::create([
        'user_id' => $request->user_id,
        'type' => $request->type,
        'amount' => $request->amount,
        'reference_id' => $request->reference_id,
      ]);

      if ( !($transaction) || !($feature) ) {

      }else {
        DB::commit();
        return $feature;
      }

    }

    public function all()
    {
        $features = Feature::where('status' , 'Ongoing')->limit(50)->get();

        if (count($features) > 0) {
          $i = 1;

          foreach ($features as $key => $feature) {

              $escorts[$i] = Escort::where('escorts.id', $feature['escort_id'])->where('verified' , 1)->leftjoin('users', 'users.id', '=', 'escorts.user_id')->select('escorts.id' , 'user_id' , 'rank', 'verified', 'state' , 'city' , 'profile_image', 'name' , 'username')->get();
              $i++;
          }
        }else {
            $escorts = NULL;
        }

        return $escorts;
    }

    public function getAllForPurge() {
        $all = Feature::all();
        return $all;
    }

    public function purgeExpiredFeature($id) {
        $deleteFeature = Feature::whereId($id)->delete();
        return $deleteFeature;
    }

}


 ?>

