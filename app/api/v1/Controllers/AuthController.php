<?php

namespace App\Api\V1\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Api\V1\Repositories\AuthRepository;



class AuthController extends Controller
{

  /**
   * The Authentication
   *
   * @var object
   */
  private $auth;


  /**
   * Class constructor
   */
  public function __construct(AuthRepository $auth)
  {
      // Inject AuthRepository Class into AuthController
      $this->auth = $auth;
      // $this->middleware('auth', ['except' => ['login' , 'passwordReset' , 'changePassword']]);

  }


  public function login(Request $request)
  {

      // Call the create method of UserRepository
      $auth = $this->auth->login($request);


      if ($auth === "Incorrect login details") {

          // Create a custom array as response
          $response = [
              "status" => "failed",
              "code" => 404,
              "message" => $auth,
              "data" => NULL
          ];

      }elseif ($auth['message'] === "User's account has not been activated") {

          // Create a custom array as response
          $response = [
              "status" => "failed",
              "code" => 200,
              "message" => $auth['message'],
              "data" => $auth['email']
          ];

      }else {

        $data['user'] = $auth['user'];
        $data['escort'] = $auth['escort'];
        $data['services'] = $auth['services'];
        $data['images'] = $auth['images'];
        $data['transactions'] = $auth['transactions'];;

          // Create a custom array as response
          $response = [
              "status" => "success",
              "code" => 200,
              "message" => $auth['message'],
              "data" => $data
          ];

      }

      // return the custom in JSON format
      return response()->json($response);

  }

  public function passwordReset(Request $request)
  {
    try {

        $password = $this->auth->passwordReset($request->email);

        // Create a custom array as response
        $response = [
            "success" => true,
            "status" => $password['status'],
            "data" => $password['message']
        ];

    } catch (\Exception $e) {

        // Create a custom response
        $response = [
            "success" => false,
            "status" => 502,
            "data" => "Sorry! Something went wrong"
        ];

    }

    // return the custom in JSON format
    return response()->json($response);

  }

  public function changePassword()
  {

    if (isset($_GET['email']) && isset($_GET['code'])) {

        $data['email'] = $_GET['email'];
        $data['code'] = $_GET['code'];

        $changePassword = $this->auth->changePassword($data);

    }else {



    }


  }


}
