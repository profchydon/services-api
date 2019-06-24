<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Api\v1\Repositories\ReviewRepository;
use App\Api\v1\Repositories\UserRepository;

class ReviewController extends Controller
{
    /**
     * The Verification
     *
     * @var object
     */
    private $review;

    /**
     * The User
     *
     * @var object
     */
    private $user;


    /**
     * Class constructor
     */
    public function __construct(ReviewRepository $review)
    {
        // Inject VeriRepository Class into VerificationController
        $this->review = $review;
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
            $review = $this->review->create($request);

            // Create a custom array as response
            $response = [
                "status" => "success",
                "code" => 201,
                "message" => "Review successful created",
                "data" => $review
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
