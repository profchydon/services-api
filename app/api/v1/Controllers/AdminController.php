<?php

namespace App\Api\v1\Controllers;

use Illuminate\Http\Request;
use App\Api\v1\Repositories\AdminRepository;
use App\Api\v1\Repositories\VerificationRepository;
use App\Api\v1\Repositories\TransactionRepository;

class AdminController extends Controller
{

    /**
     * The Admin
     *
     * @var object
     */
    private $admin;

    /**
     * The Verification
     *
     * @var object
     */
    private $verification;

    /**
     * The Verification
     *
     * @var object
     */
    private $transaction;

    /**
     * Class constructor
     */
    public function __construct(AdminRepository $admin, VerificationRepository $verification, TransactionRepository $transaction)
    {
        // Inject InterestRepository Class into InterestController
        $this->verification = $verification;
        $this->admin = $admin;
        $this->transaction = $transaction;
        $this->middleware('auth', ['except' => []]);
    }

    public function allVerifications()
    {

      try {

          $allVerifications = $this->verification->allVerifications();

          // Create a custom array as response
          $response = [
              "status" => "success",
              "code" => 200,
              "message" => "Ok",
              "data" => $allVerifications
          ];

          // return the custom in JSON format
          return response()->json($response);

      } catch (\Exception $e) {

          // Create a custom array as response
          $response = [
              "status" => "failed",
              "code" => 404,
              "message" => "Error! Sorry server could not process this request",
              "data" => NULL
          ];

          // return the custom in JSON format
          return response()->json($response);

      }
    }

    public function allTransactions()
    {

      try {

          $allTransactions = $this->transaction->allTransactions();

          // Create a custom array as response
          $response = [
              "status" => "success",
              "code" => 200,
              "message" => "Ok",
              "data" => $allTransactions
          ];

          // return the custom in JSON format
          return response()->json($response);

      } catch (\Exception $e) {

          // Create a custom array as response
          $response = [
              "status" => "failed",
              "code" => 404,
              "message" => "Error! Sorry server could not process this request",
              "data" => NULL
          ];

          // return the custom in JSON format
          return response()->json($response);

      }
    }

    /**
     * Create a  new User
     *
     * @param object $request
     *
     * @return JSON
     *
     */
    public function escortDetailsForVerification (Request $request)
    {

      try {

          $escort = $this->verification->escortDetailsForVerification($request->escort_id);

          // Create a custom array as response
          $response = [
              "status" => "success",
              "code" => 200,
              "message" => "Ok",
              "data" => $escort
          ];

          // return the custom in JSON format
          return response()->json($response);

      } catch (\Exception $e) {

          // Create a custom array as response
          $response = [
              "status" => "failed",
              "code" => 404,
              "message" => "Error! Sorry server could not process this request",
              "data" => NULL
          ];

          // return the custom in JSON format
          return response()->json($response);

      }

    }

    public function verifyEscort(Request $request)
    {

        try {

            $verifyEscort = $this->verification->verifyEscort($request->escort_id);

            // Create a custom array as response
            $response = [
                "status" => "success",
                "code" => 200,
                "message" => "Ok",
                "data" => $verifyEscort
            ];

            // return the custom in JSON format
            return response()->json($response);


        } catch (\Exception $e) {

          // Create a custom array as response
          $response = [
              "status" => "failed",
              "code" => 404,
              "message" => "Error! Sorry server could not process this request",
              "data" => NULL
          ];

          // return the custom in JSON format
          return response()->json($response);

        }


    }

}

?>
