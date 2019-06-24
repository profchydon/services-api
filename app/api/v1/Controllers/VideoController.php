<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Escort;
use App\Api\V1\Repositories\VideoRepository;
use App\Api\V1\Repositories\EscortRepository;


class VideoController extends Controller
{

    /**
     * The User
     *
     * @var object
     */
    private $video;


    /**
     * Class constructor
     */
    public function __construct(VideoRepository $video)
    {
        // Inject UserRepository Class into UserController
        $this->video = $video;
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
        $video = $this->video->create($request);

        // Create a custom array as response
        $response = [
            "status" => "success",
            "code" => 201,
            "message" => "videos created successfully",
            "data" => $video
        ];

        // return the custom in JSON format
        return response()->json($response);

    }

    /**
     * Fetch all existing Properties
     *
     * @return JSON
     */
    public function videos ()
    {

      $videos = $this->video->videos();

      // Create a custom array as response
      $response = [
          "status" => "success",
          "code" => 200,
          "message" => "Ok",
          "data" => $videos
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
      $video = $this->video->update($request);

      // Create a custom array as response
      $response = [
          "status" => "success",
          "code" => 201,
          "message" => "Video updated successfully",
          "data" => $video
      ];

      // return the custom in JSON format
      return response()->json($response);

  }


}
