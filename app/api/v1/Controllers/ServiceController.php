<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Escort;
use App\Api\V1\Repositories\ServiceRepository;
use App\Api\V1\Repositories\EscortRepository;


class ServiceController extends Controller
{

    /**
     * The User
     *
     * @var object
     */
    private $service;


    /**
     * Class constructor
     */
    public function __construct(ServiceRepository $service)
    {
        // Inject UserRepository Class into UserController
        $this->service = $service;
        $this->middleware('auth', ['except' => []]);

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
        $service = $this->service->create($request);

        // Create a custom array as response
        $response = [
            "status" => "success",
            "code" => 201,
            "message" => "Services created successfully",
            "data" => $service
        ];

        // return the custom in JSON format
        return response()->json($response);

    }

    /**
     * Fetch all existing Properties
     *
     * @return JSON
     */
    public function services ()
    {

      $services = $this->service->services();

      // Create a custom array as response
      $response = [
          "status" => "success",
          "code" => 200,
          "message" => "Ok",
          "data" => $services
      ];

      // return the custom in JSON format
      return response()->json($response);

    }


    /**
     * Update a User
     *
     * @param int $id
     *
     * @param object $request
     *
     * @return JSON
     *
     */
    public function updateServices(Request $request)
    {

      // Call the updateUser method of UserRepository
      $service = $this->service->updateServices($request);

      if ($service == "User details not found") {

          // Create a custom array as response
          $response = [
              "status" => "failed",
              "code" => 404,
              "message" => $service,
              "data" => NULL
          ];

      }else {

        // Create a custom array as response
        $response = [
            "status" => "success",
            "code" => 200,
            "message" => "Services updated successfully",
            "data" => $service
        ];

      }

      // return the custom in JSON format
      return response()->json($response);
    }

}
