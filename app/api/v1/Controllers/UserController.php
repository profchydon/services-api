<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Api\V1\Repositories\UserRepository;
use App\Api\V1\Repositories\ActivationRepository;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendActivationMail;


class UserController extends Controller
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
    private $activation;

    /**
     * Class constructor
     */
    public function __construct(UserRepository $user, ActivationRepository $activation)
    {
        // Inject UserRepository Class into UserController
        $this->user = $user;
        $this->activation = $activation;

        $this->middleware('auth', ['except' => ['create' , 'users' , 'fetchAUser']]);

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
    $user = $this->user->create($request);

    if ($user == "Email address already exist" || $user == "Phone number already exist" || $user == "Username already exist") {

        // Create a custom array as response
        $response = [
            "status" => "failed",
            "code" => 409,
            "message" => $user,
            "data" => NULL
        ];

    }else{


      // Generate a random code for verification
          $code = rand(1000 , 9999);
          $code = (int)$code;

          // Send verification code here
          // Code goes Here

          // Save verification code and email to verification table
          $activation = $this->activation->create($request, $code);

          $data['user'] = $user;
          $data['activation'] = $activation;

          Mail::to($user->email)->send(new SendActivationMail($user->email , $activation->code));

          // Create a custom array as response
          $response = [
              "status" => "success",
              "code" => 201,
              "message" => "User created successfully",
              "data" => $data
          ];

    }

    // return the custom in JSON format
    return response()->json($response);

    }

    /**
     * Fetch a User
     *
     * @param int $email
     *
     * @return JSON
     *
     */
    public function fetchAUserUsingEmail($email)
    {

      // Call the fetchAUserUsingEmail method of UserRepository
      $user = $this->user->fetchAUserUsingEmail($email);

      // Create a custom array as response
      $response = [
          "status" => "success",
          "code" => 200,
          "message" => "Ok",
          "data" => $user
      ];

      // return the custom in JSON format
      return response()->json($response);

    }

    /**
     * Fetch all existing Users
     *
     * @return JSON
     */
    public function users ()
    {

      try {

        // Call the users method of UserRepository
        $user = $this->user->users();

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
     * Fetch a User
     *
     * @param int $id
     *
     * @return JSON
     *
     */
    public function fetchAUser($id)
    {

        try {

          // Call the fetchAUser method of UserRepository
          $user = $this->user->fetchAUser($id);

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
     * Update a User
     *
     * @param int $id
     *
     * @param object $request
     *
     * @return JSON
     *
     */
    public function updateUser(Request $request)
    {

      // Call the updateUser method of UserRepository
      $user = $this->user->updateUser($request);

      if ($user == "User details not found") {

          // Create a custom array as response
          $response = [
              "status" => "failed",
              "code" => 404,
              "message" => $user,
              "data" => NULL
          ];

      }elseif ($user == "Email address already exist") {

          // Create a custom array as response
          $response = [
              "status" => "failed",
              "code" => 404,
              "message" => $user,
              "data" => NULL
          ];

      }elseif ($user == "Phone number already exist") {

          // Create a custom array as response
          $response = [
              "status" => "failed",
              "code" => 404,
              "message" => $user,
              "data" => NULL
          ];

      }else {

        // Create a custom array as response
        $response = [
            "status" => "success",
            "code" => 200,
            "message" => "User updated successfully",
            "data" => $user
        ];

      }

      // return the custom in JSON format
      return response()->json($response);

    }

    /**
     * Delete a User
     *
     * @param int $id
     *
     * @param object $request
     *
     * @return JSON
     *
     */
    public function deleteUser(Request $request)
    {

      // Call the updateUser method of UserRepository
      $user = $this->user->deleteUser($request);

      if ($user == "User details not found") {

          // Create a custom array as response
          $response = [
              "status" => "failed",
              "code" => 404,
              "message" => $user,
              "data" => NULL
          ];

      }else {

        // Create a custom array as response
        $response = [
            "status" => "success",
            "code" => 200,
            "message" => "User deleted successfully",
            "data" => $user
        ];

      }

      // return the custom in JSON format
      return response()->json($response);

    }

}
