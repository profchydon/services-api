<?php

namespace App\Api\V1\Repositories;

use App\User;
use App\Video;
use Illuminate\Http\Request;
use DB;


class VideoRepository
{

    /**
   * Create a  new User
   *
   * @param object $request
   *
   * @return object $user
   *
   */
    public function create($request)
    {

      // Begin database transaction
      DB::beginTransaction();

      $escortVideosExist = Video::where('escort_id',$request->escort_id)->orWhere('user_id' , $request->user_id)->get();

      if (count($escortVideosExist) == 0) {

        $video = Video::create([
            'user_id' => $request->user_id,
            'escort_id' => $request->escort_id,
            'video_1' => $request->video_1,
            'video_2' => $request->video_2,
            'video_3' => $request->video_3,
            'video_4' => $request->video_4,
            'video_5' => $request->video_5,
            'video_6' => $request->video_6,
            'video_7' => $request->video_7,
            'video_8' => $request->video_8,
            'video_9' => $request->video_9,
            'video_10' => $request->video_10,

        ]);

      }else {


      }


      if (!$video) {

        // If User isn't created, rollback database to initial state
        DB::rollback();

        return $video = "Oops! Sorry there was an error. Please try again";

      }else {

        // If User is created, commit transaction to the database
        DB::commit();

        return $video;

      }

    }


    /**
     * Create all Properties existing in the database
     *
     * @return object $properties
     *
     */
    public function videos()
    {
      // Fetch all properties existing in the database
      $video = Video::first();

      // return list of properties;
      return $video;

    }


    /**
   * Update a Tenant
   *
   * @param int $id
   * @param object $request
   *
   * @return object $tenant
   *
   */
  public function update($request)
  {

      // Fetch tenant with $id from database
      $escortVideo = Video::where('escort_id' , $request->escort_id)->first();

      if ($escortVideo) {

          // Update tenant details
          $escortVideo->update($request->all());

          return $escortVideo;

      }elseif (!$escortVideo) {

        return  $escortVideo = "User details not found";

      }

  }
}
