<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\Api\V1\Repositories\SubscriptionRepository;
use App\Api\V1\Repositories\TransactionRepository;
use App\Api\V1\Repositories\UserRepository;

class SubscriptionController extends Controller
{
    /**
     * The Verification
     *
     * @var object
     */
    private $subscription;
    private $transaction;

    /**
     * The User
     *
     * @var object
     */
    private $user;


    /**
     * Class constructor
     */
    public function __construct(SubscriptionRepository $subscription, TransactionRepository $transaction)
    {
        // Inject VeriRepository Class into VerificationController
        $this->subscription = $subscription;
        $this->transaction = $transaction;
        $this->middleware('auth', ['except' => []]);

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

        try {

            // Call the create method of VerificationRepository
            $subscription = $this->subscription->create($request);
            $transaction = $this->transaction->create($request);

            // Create a custom array as response
            $response = [
                "status" => "success",
                "code" => 201,
                "message" => "Subscription successfully created",
                "data" => $subscription
            ];

            // return the custom in JSON format
            return response()->json($response);

        } catch (\Exception $e) {

          // Create a custom array as response
          $response = [
              "status" => "failed",
              "code" => 404,
              "message" => "Error! Sorry server could not process this request",
              "data" => "NULL"
          ];

          // return the custom in JSON format
          return response()->json($response);

        }

    }

}

?>
