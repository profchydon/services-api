<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Api\v1\Repositories\TransactionRepository;
use App\Api\v1\Repositories\UserRepository;

class TransactionController extends Controller
{
    /**
     * The Verification
     *
     * @var object
     */
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
    public function __construct(TransactionRepository $transaction)
    {
        // Inject VeriRepository Class into VerificationController
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

        // var_dump($request->reference_id);
        // die();

        try {

            // Call the create method of VerificationRepository
            $transaction = $this->transaction->create($request);

            // Create a custom array as response
            $response = [
                "status" => "success",
                "code" => 201,
                "message" => "Transaction successful created",
                "data" => $transaction
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
