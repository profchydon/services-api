<?php

namespace App\Api\v1\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Api\v1\Repositories\UserRepository;
use App\Api\v1\Repositories\EscortRepository;


class EscortController extends Controller
{

    /**
     * The User
     *
     * @var object
     */
    private $user;

    /**
     * The Verification
     *
     * @var object
     */
    private $escort;

    /**
     * Class constructor
     */
    public function __construct(UserRepository $user, EscortRepository $escort)
    {
        // Inject UserRepository Class into UserController
        $this->user = $user;
        $this->escort = $escort;
        $this->middleware('auth', ['except' => ['create', 'escorts' , 'escortDetails', 'getEscortsForHomepage', 'getPlatinumEscorts' , 'escortDetailsForDashboard']]);

    }

      /**
     * Create a  new User
     *
     * @param object $request
     *
     * @return JSON
     *
     */
    public function create (Request $request)
    {

        // Call the create method of UserRepository
        $escort = $this->escort->create($request);

        // Create a custom array as response
        $response = [
            "status" => "success",
            "code" => 201,
            "message" => "Escort created successfully",
            "data" => $escort
        ];

        // return the custom in JSON format
        return response()->json($response);

    }

    /**
   * Create a  new User
   *
   * @param object $request
   *
   * @return JSON
   *
   */
  public function escorts ()
  {

      // Call the create method of UserRepository
      $escorts = $this->escort->escorts();

      // Create a custom array as response
      $response = [
          "status" => "success",
          "code" => 200,
          "message" => "Ok",
          "data" => $escorts
      ];

      // return the custom in JSON format
      return response()->json($response);

  }


    public function getEscortsForHomepage()
    {
        $escorts = $this->escort->escorts();
        $platinumEscorts = $this->escort->getPlatinumEscorts();

        $data['escorts'] = $escorts;
        $data['platinumEscorts'] = $platinumEscorts;

        // Create a custom array as response
        $response = [
            "status" => "success",
            "code" => 200,
            "message" => "Ok",
            "data" => $data
        ];

        // return the custom in JSON format
        return response()->json($response);

    }


    public function getPlatinumEscorts()
    {

      // Call the create method of UserRepository
      $platinumEscorts = $this->escort->getPlatinumEscorts();

      // Create a custom array as response
      $response = [
          "status" => "success",
          "code" => 200,
          "message" => "Ok",
          "data" => $platinumEscorts
      ];

      // return the custom in JSON format
      return response()->json($response);
    }

    public function escortDetails(Request $request, $escort)
    {

      // Call the create method of UserRepository
      $escortRecords = $this->escort->escortDetails($escort);

      // Create a custom array as response
      $response = [
          "status" => "success",
          "code" => 201,
          "message" => "Ok",
          "data" => $escortRecords
      ];

      // return the custom in JSON format
      return response()->json($response);
    }

    public function escortDetailsForDashboard(Request $request)
    {

      // Call the create method of UserRepository
      $escortRecords = $this->escort->escortDetailsForDashboard($request);

      // Create a custom array as response
      $response = [
          "status" => "success",
          "code" => 200,
          "message" => "Ok",
          "data" => $escortRecords
      ];

      // return the custom in JSON format
      return response()->json($response);
    }

    public function updateEscort(Request $request)
    {

      try {

        // Call the updateTenant method of TenantRepository
        $escort = $this->escort->updateEscort($request);

        // Create a custom array as response
        $response = [
            "status" => "success",
            "code" => 200,
            "message" => "Update was successful",
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




}
