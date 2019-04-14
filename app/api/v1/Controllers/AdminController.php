<?php

namespace App\Api\v1\Controllers;

use Illuminate\Http\Request;
use App\Api\v1\Repositories\AdminRepository;
use App\Api\v1\Repositories\VerificationRepository;
use App\Api\v1\Repositories\TransactionRepository;
use App\Api\v1\Repositories\FeatureRepository;
use Carbon\Carbon;

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
    public function __construct(AdminRepository $admin, VerificationRepository $verification, TransactionRepository $transaction, FeatureRepository $feature)
    {
        // Inject InterestRepository Class into InterestController
        $this->verification = $verification;
        $this->admin = $admin;
        $this->transaction = $transaction;
        $this->feature = $feature;
        $this->middleware('auth', ['except' => ['purgeExpiredSubscription']]);
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

    /**
     *
     * @param object $request
     *
     * @return JSON
     *
     */
    public function purgeExpiredSubscription ()
    {

        try {

            $features = $this->feature->getAllForPurge();

            foreach ($features as $key => $feature) {
              $now = Carbon::now();
              $date = Carbon::parse($feature['created_at']);
              $difference = $now->diffInDays($date);
              if ($difference > $feature['duration']) {
                $features = $this->feature->purgeExpiredFeature($feature['id']);

                if ($features) {
                  // code...
                }else {
                  // Send email to notify that cron job failed
                }
              }
            }


        } catch (\Exception $e) {

          
        }

    }

}

?>
