<?php

namespace App\Api\v1\Repositories;

use App\Feature;
use App\User;
use App\Escort;
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

      $verification = Feature::create([
        'escort_id' => $request->escort_id,
        'duration' => $request->duration,
        'status' => "Ongoing",
      ]);

      if (!$verification) {
        DB::rollback();
      }else {
        DB::commit();
        return $verification;
      }

    }

}



 ?>
