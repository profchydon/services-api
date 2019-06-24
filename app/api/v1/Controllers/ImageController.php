<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Api\V1\Repositories\ImageRepository;
use App\Api\V1\Repositories\EscortRepository;


class ImageController extends Controller
{

    /**
     * The User
     *
     * @var object
     */
    private $image;


    /**
     * Class constructor
     */
    public function __construct(ImageRepository $image)
    {
        // Inject UserRepository Class into UserController
        $this->image = $image;
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
        $image = $this->image->create($request);

        // Create a custom array as response
        $response = [
            "status" => "success",
            "code" => 201,
            "message" => "Images created successfully",
            "data" => $image
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
  public function update (Request $request)
  {

      // Call the create method of UserRepository
      $image = $this->image->update($request);

      // Create a custom array as response
      $response = [
          "status" => "success",
          "code" => 201,
          "message" => "Images updated successfully",
          "data" => $image
      ];

      // return the custom in JSON format
      return response()->json($response);

  }

    /**
     * Fetch all existing Properties
     *
     * @return JSON
     */
    public function images ()
    {

      $images = $this->image->images();

      // Create a custom array as response
      $response = [
          "status" => "success",
          "code" => 200,
          "message" => "Ok",
          "data" => $images
      ];

      // return the custom in JSON format
      return response()->json($response);

    }


}
