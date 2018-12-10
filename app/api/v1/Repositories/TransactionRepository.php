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

    public function create($request)
    {

      DB::beginTransaction();

      $transaction = Transaction::create([
        'user_id' => $request->user_id,
        'type' => $request->type,
        'amount' => $request->amount,
      ]);

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
