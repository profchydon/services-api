<?php

namespace App\Api\V1\Repositories;

use App\User;
use App\Escort;
use App\Subscription;
use Illuminate\Http\Request;
use DB;

/**
 *
 */
class SubscriptionRepository
{

    public function updateRank($escort_id , $rank)
    {
      $escort = Escort::where('id' , $escort_id)->first();
      $escort->update([
        'rank' => $rank
      ]);
    }

    public function create($request)
    {

      DB::beginTransaction();

      $subscription = Subscription::create([
        'user_id' => $request->user_id,
        'type' => $request->type,
        'duration' => $request->duration
      ]);

      $escort = Escort::where('user_id' , $request->user_id)->first();
      $subscription_type = $request->type;

      switch ($subscription_type) {
        case 'Go Silver':
            $this->updateRank($escort->id , "silver");
          break;

        case 'Go Gold':
            $this->updateRank($escort->id , "gold");
          break;

        case 'Go Platinum':
            $this->updateRank($escort->id , "platinum");
          break;

        default:
            $this->updateRank($escort->id , "regular");
          break;
      }

      if (!$subscription) {
        DB::rollback();
      }else {
        DB::commit();
        return $subscription;
      }

    }


    public function allSubscriptions()
    {

        $subscriptions = Subscription::all();

        return $subscriptions;

    }

}



 ?>
