<?php

namespace App\Api\v1\Repositories;

use App\Transaction;
use App\User;
use App\Escort;
use App\Image;
use Illuminate\Http\Request;
use DB;

/**
 *
 */
class TransactionRepository
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

      $transaction = Transaction::create([
        'user_id' => $request->user_id,
        'type' => $request->type,
        'amount' => (int)$request->amount,
        'reference_id' => $request->reference_id,
      ]);

      $escort = Escort::where('id' , $request->escort_id)->first();
      $transaction_type = $request->type;

      switch ($transaction_type) {
        case 'Go Silver':
            $this->updateRank($request->escort_id , "silver");
          break;

        case 'Go Gold':
            $this->updateRank($request->escort_id , "gold");
          break;

        case 'Go Platinum':
              $this->updateRank($request->escort_id , "platinum");
          break;

        default:
          // code...
          break;
      }

      if (!$transaction) {
        DB::rollback();
      }else {
        DB::commit();
        return $transaction;
      }

    }


    public function allTransactions()
    {

        $transactions = Transaction::all();

        return $transactions;

    }

}



 ?>
