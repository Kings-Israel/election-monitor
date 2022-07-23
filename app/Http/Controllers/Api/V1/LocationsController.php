<?php

namespace App\Http\Controllers\Api\V1;
use App\Result;
use App\Polling;

use Illuminate\Http\Request;
use App\Models\Aspirant\Aspirant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\V1\APIController;

/**
 * To Do Controller.
 */
class LocationsController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchCounty()
    {
        try {
            return $results = DB::select('select county_name, county_code, longitude,latitude FROM county');
            // return $results = DB::select('select p.polling_name, w.ward_name FROM polling AS p INNER JOIN ward AS w ON p.ward_id=w.id INNER JOIN consituency AS c ON p.constituency_id=c.id ORDER BY polling_name;');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        } return response()->json(['message' => 'Sorry, something went wrong!'], 422);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchConstituency()
    {
        try {
            return $results = DB::select('select p.constituency_name, p.const_code, p.longitude, p.latitude,b.county_name   FROM constituency AS p INNER JOIN county AS b ON p.county_id=b.id ORDER BY constituency_name;');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        } return response()->json(['message' => 'Sorry, something went wrong!'], 422);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchWard()
    {
        try {
            return $results = DB::select('select p.ward_name,p.registered,p.percentage,p.estimated, p.population, c.constituency_name, b.county_name  FROM ward AS p INNER JOIN constituency AS c ON p.constituency_id=c.id INNER JOIN county AS b ON c.county_id=b.id ORDER BY ward_name;');
            // return $results = DB::select('select p.polling_name, w.ward_name FROM polling AS p INNER JOIN ward AS w ON p.ward_id=w.id INNER JOIN consituency AS c ON p.constituency_id=c.id ORDER BY polling_name;');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }

     /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchPolling()
    {
        try {
            return $results = DB::select('select p.polling_name,p.longitude,p.latitude,p.id, w.ward_name, c.constituency_name, b.county_name  FROM polling AS p INNER JOIN ward AS w ON p.ward_id=w.id INNER JOIN constituency AS c ON p.constituency_id=c.id INNER JOIN county AS b ON c.county_id=b.id ORDER BY polling_name LIMIT 1500;');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }

     /**
    * @return \Illuminate\Http\JsonResponse
    */
   public function fetchPollingByName($name)
   {

       try {
        $results = DB::select("select p.polling_name,p.longitude,p.latitude,p.id, w.ward_name, c.constituency_name, b.county_name  FROM polling AS p INNER JOIN ward AS w ON p.ward_id=w.id INNER JOIN constituency AS c ON p.constituency_id=c.id INNER JOIN county AS b ON c.county_id=b.id WHERE polling_name='".$name."'");

        if($results){
            $results[0]->aspirants = $this->fetchStationAspirantsResults($results[0]->id);
           return response()->json(['message' => 'Success','data' => $results]);
           } else {
           return response()->json(['message' => 'Not data found']);
           }
       } catch (\Exception $ex) {
           Log::error($ex->getMessage());

           return response()->json(['message' => 'Sorry, something went wrong!'], 422);
       }
   }

   public function fetchStationAspirantsResults($id)
   {
        $station = Polling::with('ward.constituency')->where('id', $id)->first();

        // Get all results that have tha polling station name
        $results = Result::where('polling', $station->polling_name)->get();

        // Get all aspirants in the polling station
        $aspirants = [];
        foreach ($results as $result) {
            array_push($aspirants, [Aspirant::where('uuid', $result->aspirant_uuid)->first()->full_name => Aspirant::where('uuid', $result->aspirant_uuid)->sum('results')]);
        }

        // Make the aspirant list unique
        $aspirants = collect($aspirants)->unique();

        return $aspirants;
   }

}
