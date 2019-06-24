<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\Activation;
use App\Api\v1\Repositories\ActivationRepository;
use App\Api\v1\Repositories\UserRepository;

class ActivationController extends Controller
{
    /**
     * The Verification
     *
     * @var object
     */
    private $activation;

    /**
     * The User
     *
     * @var object
     */
    private $user;

    /**
     * Class constructor
     */
    public function __construct(ActivationRepository $activation , UserRepository $user)
    {
        // Inject VeriRepository Class into VerificationController
        $this->activation = $activation;
        $this->user = $user;
    }

    /**
   * Create a  new Verification
   *
   * @param object $request
   *
   * @return JSON
   *
   */
  public function create (Request $request)
  {

    // Generate a random code
    $code = rand(10000 , 99999);

      try {

          // Call the create method of VerificationRepository
          $activation = $this->activation->create($request , $code);

          // Create a custom array as response
          $response = [
              "status" => "success",
              "code" => 200,
              "message" => "Ok",
              "data" => $activation
          ];

          // return the custom in JSON format
          return response()->json($response);

      } catch (\Exception $e) {

        // Create a custom response
        $response = [
            "success" => false,
            "status" => 502,
        ];

        // return the custom in JSON format
        return response()->json($response);

      }

  }

  /**
   * Fetch a Verification
   *
   * @param string $email
   *
   * @return JSON
   *
   */
  public function fetchAActivation($email)
  {

      try {

        // Call the fetchAVerification method of VerificationRepository
        $user = $this->activation->fetchAActivation($email);

        // Create a custom array as response
        $response = [
            "status" => "success",
            "code" => 200,
            "message" => "Ok",
            "data" => $user
        ];

        // return the custom in JSON format
        return response()->json($response);

      } catch (\Exception $e) {

        // Create a custom response
        $response = [
            "success" => false,
            "status" => 502,
        ];

        // return the custom in JSON format
        return response()->json($response);
      }

  }

  /**
   * Update a Verification
   *
   * @param object $request
   *
   * @return JSON
   *
   */
  public function updateActivationCode(Request $request)
  {

    // Generate a random code for verification
    $code = rand(1000 , 9999);
    $code = (int)$code;

    // Call the updateVerification method of VerificationRepository
    $activation = $this->activation->updateActivationCode($request->email, $code);

    if ($activation == "Email address not found") {

        // Create a custom array as response
        $response = [
            "status" => "failed",
            "code" => 409,
            "message" => "Email address not found",
            "data" => []
        ];

    }else {

      // Fetch the updated data from the verification table
      $activation = $this->activation->checkEmailExist($request->email);

      $user = $this->user->fetchAUserUsingEmail($request->email);

      $data['activation'] = $activation;
      $data['user'] = $user;

      // Create a custom array as response
      $response = [
          "status" => "success",
          "code" => 200,
          "message" => "Ok",
          "data" => $data
      ];

    }

    // return the custom in JSON format
    return response()->json($response);

}

  public function activateUser(Request $request)
  {

    $activation = $this->activation->activateUser($request->email, $request->code);

    if ($activation == "Oops!!! Verification code does not match") {

        // Create a custom array as response
        $response = [
            "status" => "failed",
            "code" => 404,
            "message" => "Verification code does not match",
            "data" => NULL
        ];

    }elseif ($activation == "Sorry..No record found attached to this email") {

        // Create a custom array as response
        $response = [
            "status" => "failed",
            "code" => 404,
            "message" => "Sorry..No record found attached to this email",
            "data" => NULL
        ];

    }else {
        $user = $this->user->fetchAUserUsingEmail($request->email);
        $data['activation'] = $activation;
        $data['user'] = $user;

        // Update the active in the user table to 1, to indicate user has been verified
        $updateUserActive = $this->activation->updateUserActive($request->email);

        // Delete the verification details from database since verification is successful
        $deleteVerifiedDetail = $this->activation->deleteActivationRecord($request->email, $request->code);

        // Create a custom array as response
        $response = [
            "status" => "success",
            "code" => 200,
            "message" => "Account successful activated",
            "data" => $data
        ];

    }

    // return the custom in JSON format
    return response()->json($response);

  }

}
