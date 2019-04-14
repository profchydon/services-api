<?php

namespace App\Api\v1\Repositories;

use App\User;
use App\Escort;
use App\Service;
use App\Image;
use App\Video;
use App\Transaction;
use App\Review;
use App\Feature;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;


class EscortRepository
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

    $checKEscortExist = Escort::where('user_id' , $request->user_id)->get();

    if (count($checKEscortExist) === 0) {

        $escort = Escort::create([
            'user_id' => $request->user_id,
            'gender' => $request->gender,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'year_of_birth' => $request->year_of_birth,
            'ethnicity' => $request->ethnicity,
            'bust_size' => $request->bust_size,
            'height' => $request->height,
            'weight' => $request->weight,
            'build' => $request->build,
            'looks' => $request->looks,
            'availability' => $request->availability,
            'smoker' => $request->smoker,
            'about' => $request->about,
            'sex_orientation' => $request->sex_orientation,
            'language' => $request->language,
            'rank' => "regular",
            'views' => $request->views,
            'incall_1hr' => $request->incall_1hr,
            'incall_1dy' => $request->incall_1dy,
            'incall_overnight' => $request->incall_overnight,
            'incall_1wk' => $request->incall_1wk,
            'outcall_1hr' => $request->outcall_1hr,
            'outcall_1dy' => $request->outcall_1dy,
            'outcall_overnight' => $request->outcall_overnight,
            'outcall_1wk' => $request->outcall_1wk,
            'video_sex' => $request->video_sex,
            'sex_chat' => $request->sex_chat,
            'phone_sex' => $request->phone_sex,
            'nudes' => $request->nudes,
        ]);

        if (!$escort) {

          // If User isn't created, rollback database to initial state
          DB::rollback();

          return $escort = "Oops! Sorry there was an error. Please try again";

        }else {

          // If User is created, commit transaction to the database
          DB::commit();

          return $escort;

        }


    }else {


    }



  }

  /**
   * Fetch all records of a tenant
   *
   * @param object $request
   *
   * @return array $data
   *
   */
    public function escortDetails($escort)
    {
        // Fetch the user with email
        $user = User::where('username', $escort)->first();

        if (!$user) {

            $data = "User does not exist";

        }else {

            // Fetch the cotenant details
            $escort = Escort::where('user_id', $user->id)->first();

            $views = $escort->views + 1;

            $escort->update(['views' => $views]);

            // Fetch the cotenant's accept details
            $services = Service::where('escort_id' , $escort->id)->first();

            // Fetch the cotenant's transaction details
            $images = Image::where('escort_id' , $escort->id)->orWhere('user_id' , $user->id)->first();

            // Fetch the cotenant's transaction details
            $videos = Video::where('escort_id' , $escort->id)->orWhere('user_id' , $user->id)->first();

            // Fetch the cotenant's visit details
            $features = Feature::where('escort_id' , $escort->id)->get();

            // Fetch the cotenant's interest details
            $review = Review::where('escort_id' , $escort->id)->get();

            $transaction = Transaction::where('user_id' , $user->id)->get();

            $data['user'] = $user;
            $data['escort'] = $escort;
            $data['services'] = $services;
            $data['images'] = $images;
            $data['videos'] = $videos;
            $data['features'] = $features;
            $data['review'] = $review;
            $data['transaction'] = $transaction;

        }

        return $data;
    }

    /**
     * Fetch all records of a tenant
     *
     * @param object $request
     *
     * @return array $data
     *
     */
      public function escortDetailsForDashboard($request)
      {
          // Fetch the user with email
          $user = User::where('api_key', $request->header('Authorization'))->first();

          if (!$user) {

              $data = "User does not exist";

          }else {

              // Fetch the cotenant details
              $escort = Escort::where('user_id', $user->id)->first();

              if (!($escort) == NULL) {

                // Fetch the cotenant's accept details
                $services = Service::where('escort_id' , $escort->id)->first();

                $servicesFields = Schema::getColumnListing('services');

                // Fetch the cotenant's transaction details
                $images = Image::where('escort_id' , $escort->id)->orWhere('user_id' , $user->id)->first();

                $transactions = Transaction::where('user_id' , $user->id)->latest()->get();

                // Fetch the cotenant's visit details
                $features = Feature::where('escort_id' , $escort->id)->get();

                // Fetch the cotenant's transaction details
                $videos = Video::where('escort_id' , $escort->id)->orWhere('user_id' , $user->id)->first();

                $data['user'] = $user;
                $data['escort'] = $escort;
                $data['services'] = $services;
                $data['images'] = $images;
                $data['videos'] = $videos;
                $data['transaction'] = $transactions;
                $data['features'] = $features;
                $data['servicesFields'] = $servicesFields;

              }else {

                $data['user'] = $user;
                $data['escort'] = NULL;
                $data['services'] = NULL;
                $data['images'] = NULL;
                $data['transaction'] = NULL;

              }

          }

          return $data;
      }

     /**
     * Fetch all records of a tenant
     *
     * @param object $request
     *
     * @return array $data
     *
     */
      public function escortDetailsForFeed($escort)
      {

        $user = User::whereId($escort->user_id)->first(['name' , 'username']);

        $data['user'] = $user;
        $data['escort'] = $escort;

        return $data;
      }

      /**
     * Fetch all records of a tenant
     *
     * @param object $request
     *
     * @return array $data
     *
     */
      public function escorts()
      {
          // Fetch the user with email
          $escorts = Escort::where('verified' , 1)->limit(12)->get(['id' , 'user_id' , 'rank', 'verified', 'state' , 'city' , 'profile_image']);

          $count = 1;

          if (count($escorts) === 0) {

              return $data = "No escort available right now";

          }else {

              foreach ($escorts as $key => $escort) {

                  $data[$count] = $this->escortDetailsForFeed($escort);
                  $count++;
              }

              return $data;

          }


      }

      /**
     * Fetch all records of a tenant
     *
     * @param object $request
     *
     * @return array $data
     *
     */
      public function all()
      {
          // Fetch the user with email
          $escorts = Escort::where('verified' , 1)->get(['id' , 'user_id' , 'rank', 'verified', 'state' , 'city' , 'profile_image']);

          $count = 1;

          if (count($escorts) === 0) {

              return $data = "No escort available right now";

          }else {

              foreach ($escorts as $key => $escort) {

                  $data[$count] = $this->escortDetailsForFeed($escort);
                  $count++;
              }

              return $data;

          }


      }

      /**
     * Fetch all records of a tenant
     *
     * @param object $request
     *
     * @return array $data
     *
     */
      public function allEscortsByRank($rank)
      {
          // Fetch the user with email
          $escorts = Escort::where('verified' , 1)->where('rank' , $rank)->get(['id' , 'user_id' , 'rank', 'verified', 'state' , 'city' , 'profile_image']);

          $count = 1;

          if (count($escorts) === 0) {

              return $data = "No escort available right now";

          }else {

              foreach ($escorts as $key => $escort) {

                  $data[$count] = $this->escortDetailsForFeed($escort);
                  $count++;
              }

              return $data;

          }


      }


      public function getEscortsByGender($gender)
      {
          // Fetch the user with email
          $escorts = Escort::where('verified' , 1)->where('gender' , $gender)->get(['id' , 'user_id' , 'rank', 'verified', 'state' , 'city' , 'profile_image']);

          $count = 1;

          if (count($escorts) === 0) {

              return $data = "No escort available right now";

          }else {

              foreach ($escorts as $key => $escort) {

                  $data[$count] = $this->escortDetailsForFeed($escort);
                  $count++;
              }

              return $data;

          }


      }

      public function getEscortsBySearch($field, $value)
      {
          // Fetch the user with email
          $escorts = Escort::where('verified' , 1)->where($field , 'like' , $value)->get(['id' , 'user_id' , 'rank', 'verified', 'state' , 'city' , 'profile_image']);

          $count = 1;

          if (count($escorts) === 0) {

              return $data = "No escort available right now";

          }else {

              foreach ($escorts as $key => $escort) {

                  $data[$count] = $this->escortDetailsForFeed($escort);
                  $count++;
              }

              return $data;

          }


      }

      /**
     * Fetch all records of a VIP escort
     *
     * @param object $request
     *
     * @return array $data
     *
     */
      public function getPlatinumEscorts()
      {
          // Fetch the user with email
          $escorts = Escort::where('verified' , 1)->where('rank' , 'platinum')->limit(18)->get(['id' , 'user_id' , 'rank', 'state' , 'city' , 'profile_image', 'verified']);

          $count = 1;

          if (count($escorts) === 0) {

              return $data = "No platinum escort available right now";

          }else {

            foreach ($escorts as $key => $escort) {

                $data[$count] = $this->escortDetailsForFeed($escort);
                $count++;

            }

            return $data;

          }

      }

      public function getSilverEscorts()
      {
          // Fetch the user with email
          $escorts = Escort::where('verified' , 1)->where('rank' , 'silver')->limit(12)->get(['id' , 'user_id' , 'rank', 'state' , 'city' , 'profile_image', 'verified']);

          $count = 1;

          if (count($escorts) === 0) {

              return $data = "No silver escort available right now";

          }else {

            foreach ($escorts as $key => $escort) {

                $data[$count] = $this->escortDetailsForFeed($escort);
                $count++;

            }

            return $data;

          }

      }

      public function getGoldEscorts()
      {
          // Fetch the user with email
          $escorts = Escort::where('verified' , 1)->where('rank' , 'gold')->limit(12)->get(['id' , 'user_id' , 'rank', 'state' , 'city' , 'profile_image', 'verified']);

          $count = 1;

          if (count($escorts) === 0) {

              return $data = "No gold escort available right now";

          }else {

            foreach ($escorts as $key => $escort) {

                $data[$count] = $this->escortDetailsForFeed($escort);
                $count++;

            }

            return $data;

          }

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
    public function updateEscort($request)
    {

        // Fetch tenant with $id from database
        $user = User::where('api_key' , $request->header('Authorization'))->first();

        if ($user) {

            $escort = Escort::where('user_id' , $user->id)->first();

            // Update tenant details
            $escort->update($request->all());

            return $escort;

        }elseif (!$user) {

          return  $escort = "User details not found";

        }

    }

}
