<?php

namespace App\Api\V1\Repositories;

use App\Escort;
use App\User;
use App\Verification;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

/**
 *
 */
class AdminRepository
{

  /**
 * Create a  new Admin
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

    // Create User
    $user = User::create([
      'email' => strtolower($request->email),
      'password' => Hash::make($request->password),
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'gender' => $request->gender,
      'phone_number' => $request->phone_number,
      'user_group' => "admin",
      'active' => 0
    ]);

    if (!$user) {

      // If User isn't created, rollback database to initial state
      DB::rollback();

      return $user;

    }else {

      // If User is created, commit transaction to the database
      DB::commit();

      return $user;

    }

  }



    // Check if api key belongs to an admin
    public function isAdmin($api_key)
    {
      // Fetch user with the api_key provided
      $isAdmin = User::where('api_key', $api_key)->first();

      if ($isAdmin->user_type == "admin") {

          // If user has admin privileges
          return true;

      }else {

        // If user does not have admin privileges
        return false;

      }

    }


    public function dashboard()
    {

        $allPendingVerifications = Verification::where('status' , 'Open')->leftjoin('users', 'users.id', '=', 'verifications.user_id')->select('verifications.*' , 'users.id as main_user_id' , 'users.name as name' , 'users.user_type as user_type', 'users.phone as phone')->get();

        return $allPendingVerifications;

    }

    public function verifyEscortTrue($verification_id, $escort_id)
    {
          $verification = Verification::whereId($verification_id)->where('escort_id' , $escort_id)->first();

          if ($verification == NULL) {
              return $verification;
          }else {

              Escort::whereId($escort_id)->update([
                'verified' => 1,
                'verification_ongoing' => 0
              ]);

              $verification->delete();

              return $verification;
          }

    }


}

?>
