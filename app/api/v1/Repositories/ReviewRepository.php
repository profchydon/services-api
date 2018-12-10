<?php

namespace App\Api\v1\Repositories;

use App\Review;
use App\User;
use App\Escort;
use Illuminate\Http\Request;
use DB;

/**
 *
 */
class ReviewRepository
{

    public function create($request)
    {

      DB::beginTransaction();

      $review = Review::create([
        'reviewer' => $request->reviewer,
        'user_id' => $request->user_id,
        'escort_id' => $request->escort_id,
        'message' => $request->message,
      ]);

      if (!$review) {
        DB::rollback();
      }else {
        DB::commit();
        return $review;
      }

    }


    public function allTransactions()
    {

        $transactions = Transaction::all();

        return $transactions;

    }

}



 ?>
