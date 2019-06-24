<?php

namespace App\Api\V1\Repositories;

use App\Activation;
use App\User;
use Illuminate\Http\Request;
use DB;

/**
 *
 */
class ActivationRepository
{

    public function create($request, $code)
    {

      DB::beginTransaction();
      $activation = Activation::create([
        'code' => $code,
        'email' => $request->email,
      ]);

      if (!$activation) {

        DB::rollback();

      }else {

        DB::commit();

        return $activation;

      }

    }

    /**
     * Fetch a Verification
     *
     * @param string $email
     *
     * @return object $verification
     *
     */
    public function fetchAActivation($email)
    {
      // Fetch verification with $email from database
      $activation = Activation::findOrfail($email);

      // return verification
      return $activation;

    }

    public function checkEmailExist($email)
    {
      return $activation = Activation::whereEmail($email)->first();
    }

    /**
     * Update a Verification code
     *
     * @param string $email
     *
     * @return string $code
     *
     */
    public function updateActivationCode($email, $code)
    {
        // Verify if provided email exists in database
        $activation = $this->checkEmailExist($email);

        if ($activation == NULL) {

            $activation = "Email address not found";

            return $activation;

        }elseif(!($activation == NULL)) {

            $activation->whereEmail($email)->update(['code' => $code]);

            return $activation;

        }

    }

    public function ActivateUser($email, $code)
    {

        // Verify if provided email exists in database
        $checkIfEmailExists = $this->checkEmailExist($email);

        if ($checkIfEmailExists == NULL) {

            // If $checkIfEmailExists is NULL, then user email is not in the database
            $checkIfEmailExists = "Sorry..No record found attached to this email";

            return $checkIfEmailExists;

        }elseif (!($checkIfEmailExists->code == $code)) {

            // If verification code does not match then return
            $checkIfEmailExists = "Oops!!! Verification code does not match";

            return $checkIfEmailExists;

          }elseif( !($checkIfEmailExists == NULL) && $checkIfEmailExists->code == $code ) {

              // If email exists, verify that the codes are same
              $checkIfEmailExists = $checkIfEmailExists;

              return $checkIfEmailExists;

          }


    }

    public function updateUserActive($email)
    {

      $updateUserActive = User::where('email', $email)->update(['active' => 1]);

      if ($updateUserActive) {

          return true;

      }else {

          return false;

      }

    }

    public function deleteActivationRecord($email, $code)
    {
        $deleteDetail = Activation::whereEmail($email)->where('code' , $code)->delete();

        if ($deleteDetail) {

            return true;

        }else {

            return false;

        }
    }

}

?>
