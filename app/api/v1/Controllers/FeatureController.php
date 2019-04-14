<?php

namespace App\Api\v1\Controllers;

use Illuminate\Http\Request;
use App\Feature;
use App\User;
use App\Escort;
use App\Api\v1\Repositories\FeatureRepository;

class FeatureController extends Controller
{
    /**
     * The Verification
     *
     * @var object
     */
    private $feature;

    /**
     * The User
     *
     * @var object
     */
    private $user;


    /**
     * Class constructor
     */
    public function __construct(FeatureRepository $feature)
    {
        // Inject VeriRepository Class into VerificationController
        $this->feature = $feature;
        $this->middleware('auth', ['except' => ['all']]);
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
            $feature = $this->feature->create($request);

            // Create a custom array as response
            $response = [
                "status" => "success",
                "code" => 201,
                "message" => "Feature successfully created",
                "data" => $feature
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
    public function all ()
    {

        try {

            $features = $this->feature->all();

            // Create a custom array as response
            $response = [
                "status" => "success",
                "code" => 200,
                "message" => "Ok",
                "data" => $features
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
