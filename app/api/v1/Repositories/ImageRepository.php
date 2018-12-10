<?php

namespace App\Api\v1\Repositories;

use App\User;
use App\Image;
use Illuminate\Http\Request;
use DB;


class ImageRepository
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

      $escortImagesExist = Image::where('escort_id',$request->escort_id)->orWhere('user_id' , $request->user_id)->get();

      if (count($escortImagesExist) == 0) {

        $image = Image::create([
            'user_id' => $request->user_id,
            'escort_id' => $request->escort_id,
            'image_1' => $request->image_1,
            'image_2' => $request->image_2,
            'image_3' => $request->image_3,
            'image_4' => $request->image_4,
            'image_5' => $request->image_5,
            'image_6' => $request->image_6,
            'image_7' => $request->image_7,
            'image_8' => $request->image_8,
            'image_9' => $request->image_9,
            'image_10' => $request->image_10,
        ]);

      }else {


      }

      if (!$image) {

        // If User isn't created, rollback database to initial state
        DB::rollback();

        return $image = "Oops! Sorry there was an error. Please try again";

      }else {

        // If User is created, commit transaction to the database
        DB::commit();

        return $image;

      }

    }


    /**
     * Create all Properties existing in the database
     *
     * @return object $properties
     *
     */
    public function images()
    {
      // Fetch all properties existing in the database
      $image = Image::all();

      // return list of properties;
      return $image;

    }

}
