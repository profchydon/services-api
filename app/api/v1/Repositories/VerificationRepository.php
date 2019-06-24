<?php

namespace App\Api\v1\Repositories;

use App\Verification;
use App\User;
use App\Escort;
use App\Image;
use Illuminate\Http\Request;
use DB;

/**
 *
 */
class VerificationRepository
{

    public function create($request)
    {

      DB::beginTransaction();

      $verification = Verification::create([
        'escort_id' => $request->escort_id,
        'user_id' => $request->user_id,
        'image' => $request->image,
        'status' => "Open",
      ]);

      $escort = Escort::where('id' , $request->escort_id)->first();

      $escort->update([
        'verification_ongoing' => 1
      ]);

      if (!$verification) {
        DB::rollback();
      }else {
        DB::commit();
        return $verification;
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
    public function escortDetailsForVerification($escort_id)
    {
      // Fetch verification with $email from database
      $data['escort'] = $this->getEscort($escort_id);
      $data['user'] = User::whereId($data['escort']->user_id)->first();
      $data['verification'] = $this->getEscortVerification($escort_id);
      $data['images'] = Image::where('escort_id' , $escort_id)->first();

      // return verification
      return $data;

    }

    public function getEscort ($escort_id)
    {
        $escort = Escort::whereId($escort_id)->first();
        return $escort;

    }

    public function getEscortVerification ($escort_id)
    {
        $escort = Verification::where('escort_id' , $escort_id)->first();
        return $escort;

    }

    public function allVerifications()
    {
      // code...
      $allVerifications = Verification::all();

      return $allVerifications;

    }

    public function verifyEscort($request)
    {
        $checkEscortVerification = $this->getEscortVerification($request->escort_id);

        if ($checkEscortVerification !== NULL) {

            $escort = $this->getEscort($request->escort_id);
            $escort->update([
              'verified' => 1
            ]);
            $escort->update([
              'verification_ongoing' => 0
            ]);
            $checkEscortVerification->delete();
        }

        $checkIfVerified = $this->getEscort($request->escort_id);

        if ($checkIfVerified->verified === 1) {

              $data['User'] = User::whereId($checkIfVerified->user_id)->first();
              $data['verified'] = $checkIfVerified->verified;

        }else {

            $data = "Not verified";

        }

        return $data;
    }

    public function checkEmailExist($email)
    {
      return $verification = Verification::whereEmail($email)->first();
    }

    /**
     * Update a Verification code
     *
     * @param string $email
     *
     * @return string $code
     *
     */
    public function updateVerification($email, $code)
    {
        // Verify if provided email exists in database
        $verification = $this->checkEmailExist($email);

        if ($verification == NULL) {

            $verification = "Email address not found";

            return $verification;

        }elseif(!($verification == NULL)) {

            $verification->whereEmail($email)->update(['code' => $code]);

            return $verification;

        }

    }

    public function verifyUser($email, $code)
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

    public function deleteVerifiredRecord($email, $code)
    {
        $deleteDetail = Verification::whereEmail($email)->where('code' , $code)->delete();

        if ($deleteDetail) {

            return true;

        }else {

            return false;

        }
    }

}



 ?>
