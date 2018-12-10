<?php

namespace App\Api\v1\Repositories;

use App\User;
use App\Escort;
use App\Service;
use App\Image;
use App\Video;
use App\Transaction;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Verification;

/**
 *
 */
class AuthRepository
{

  /**
  * Login User
  *
  *@param $request
  *
  * @return \Illuminate\Http\Response
  */
  public function login($request)
  {


        $user = User::where('username', $request->username)->first();

        if (!($user === NULL)) {

          // Check if passwords are equal
          $password = Hash::check($request->password, $user->password);

        }

        if ($user == NULL) {

            // If email or password provided does not match
            $user = "Incorrect login details";

            return $user;

        }elseif(!$password){

            // If email or password provided does not match

            $user = "Incorrect login details";

            return $user;

        }elseif (!$this->isUserActive($request)) {

            $user['email'] = $user->email;
            $user['message'] = "User's account has not been activated";

            return $user;

        }elseif(!($user === NULL) && $password) {

            // Get the current date
            $date = Carbon::now();

            // Create a random key as api_key for the User
            $hash = Hash::make($date);
            $apikey = str_random(100);

            // Update api_key in the user table for the particular user
            User::where('username', $request->username)->update(['api_key' => $apikey]);

            //
            $user = User::where('username', $request->username)->first();
            $escort = Escort::where('user_id', $user->id)->first();

            if (!($escort === NULL)) {

              // Fetch the cotenant's accept details
              $services = Service::where('escort_id' , $escort->id)->first();

              // Fetch the cotenant's transaction details
              $images = Image::where('escort_id' , $escort->id)->orWhere('user_id' , $user->id)->first();

              // Fetch the cotenant's transaction details
              $videos = Video::where('escort_id' , $escort->id)->orWhere('user_id' , $user->id)->first();

              $transactions = Transaction::where('user_id' , $user->id)->get();


              $data['user'] = $user;
              $data['escort'] = $escort;
              $data['services'] = $services;
              $data['images'] = $images;
              $data['videos'] = $videos;
              $data['transactions'] = $transactions;
              $data['message'] = "Ok";
              return $data;

            }else {

              $data['user'] = $user;
              $data['escort'] = NULL;
              $data['services'] = NULL;
              $data['images'] = NULL;
              $data['videos'] = NULL;
              $data['transactions'] = NULL;
              $data['message'] = "Ok";
              return $data;

            }
        }
  }

  public function isUserActive($request)
  {

      $user = User::where('username', $request->username)->first();

      return $user->active ? true : false;

  }

  public function passwordReset($email)
  {

      $emailExist = User::whereEmail($email)->first();

      if (!$emailExist) {

          // If email or password provided does not match
          $passwordReset['message'] = "Email address provided does not exist";
          $passwordReset['status'] = '401';
      }

      if ($emailExist) {

            $code = str_random(7);

            User::whereEmail($email)->update(['remember_token' => $code]);

            $subject = 'Password reset';

            $body = "Hi,
            Click on the link below to reset your password
            http://localhost:8000/api/v1/auth/password_reset?email=$email&code=$code
            ";

            $sendMail = mail($email, $subject, $body , 'noreply@cotenant.com');

            if ($sendMail) {

                $passwordReset['message'] = "A link for password has been sent to your email address.";
                $passwordReset['status'] = '200';

            }

      }

      return $passwordReset;

  }

  //
  // public function changePassword($data)
  // {
  //
  //     User::where('email', $data['email'])->where('password_reset' , $data['code'])->update(['password' => ]);
  //
  // }

}

?>
