<?php

namespace App\Api\v1\Repositories;

use App\User;
use App\Escort;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;


class UserRepository
{

  public function generateUuid()
  {
      return $uuid = Uuid::uuid5(Uuid::NAMESPACE_DNS, str_random(5));
  }

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

    try {

          // Check if phone number exist
          $usernameExist = User::where('username' , $request->username)->first();

          // Check if email exist
          $emailExist = User::whereEmail($request->email)->first();

          // Check if phone number exist
          $phoneNumberExist = User::where('phone' , $request->phone)->first();


          if ($emailExist) {

              $user = "Email address already exist";
              return $user;

          }elseif ($usernameExist) {

              $user = "Username already exist";
              return $user;

          }elseif ($phoneNumberExist) {

              $user = "Phone number already exist";
              return $user;

          }elseif (!$emailExist && !$phoneNumberExist) {

              // Begin database transaction
              DB::beginTransaction();

              // Create User
              $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => strtolower($request->email),
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'user_type' => $request->user_type,
                'remember_token' => "",
              ]);

              if (!$user) {

                // If User isn't created, rollback database to initial state
                DB::rollback();

                return $user = "Oops! Sorry there was an error. Please try again";

              }else {

                // If User is created, commit transaction to the database
                DB::commit();

                return $user;

              }

          }

      } catch (\Exception $e) {

          return "Oops! Sorry there was an error. Please try again";

      }

  }

  public function emailExist($email)
  {
      $emailExist = User::whereEmail($email)->first();

      if (count($emailExist) == 0) {
          return false;
      }elseif (count($emailExist) != 0) {
          return true;
      }
  }

  public function phoneNumberExist($phone)
  {
      $phoneNumberExist = User::where('phone' , $phone)->first();

      if (count($phoneNumberExist) == 0) {
          return false;
      }elseif (count($phoneNumberExist) != 0) {
          return true;
      }
  }

  /**
     * Fetch a User using email
     *
     * @param int $email
     *
     * @return object $user
     *
     */
    public function fetchAUserUsingEmail($email)
    {

        try {

          // Fetch user with email from database
          return $user = User::whereEmail($email)->first();

        } catch (\Exception $e) {

            return "Oops! Sorry there was an error. Please try again";

        }

    }

    /**
   * Fetch a User
   *
   * @param int $id
   *
   * @return object $user
   *
   */
  public function fetchAUser($id)
  {

      try {

        // Fetch user with $id from database
        $user = User::findOrfail($id);

        // return user
        return $user;

      } catch (\Exception $e) {

          return "Oops! Sorry there was an error. Please try again";

      }

  }

  /**
   * Fetch all Users existing in the database
   *
   * @return object $users
   *
   */
  public function users()
  {

      try {

          // Fetch all users existing in the database
          $users = User::all();

          // return list of users;
          return $users;

      } catch (\Exception $e) {

          return "Oops! Sorry there was an error. Please try again";

      }


  }

  /**
     * Update a User
     *
     * @param int $id
     *
     * @param object $request
     *
     * @return object $user
     *
     */
    public function updateUser ($request)
    {


        try {

            // Fetch User with email and api_key from database
            $user = User::where('api_key' , $request->header('Authorization'))->first();

            if ($user) {

                $emailExist = $this->emailExist($request->email);
                $phoneNumberExist = $this->phoneNumberExist($request->phone);

                if ($emailExist && ($user->api_key != $request->header('Authorization')) ) {

                    $user = "Email address already exist";

                }elseif ($phoneNumberExist && ($user->api_key != $request->header('Authorization')) ) {

                    $user = "Phone number already exist";

                }else {

                  // Update user details
                  $user->update($request->all());

                }

                return $user;

            }elseif (!$user) {

                return  $user = "User details not found";

            }

        } catch (\Exception $e) {

            return "Oops! Sorry there was an error. Please try again";

        }

    }

    /**
       * Update a User
       *
       * @param int $id
       *
       * @param object $request
       *
       * @return object $user
       *
       */
      public function deleteUser ($request)
      {

          try {

              // Fetch User with email and api_key from database
              $user = User::where('api_key' , $request->header('Authorization'))->first();

              if ($user) {

                  // Update user details
                  $user->delete();

                  return $user;

              }elseif (!$user) {

                  return  $user = "User details not found";

              }

          } catch (\Exception $e) {

              return "Oops! Sorry there was an error. Please try again";

          }

      }

}
