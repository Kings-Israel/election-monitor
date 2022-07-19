<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;

/**
 * To Do Controller.
 */
class LocationsController extends APIController
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
            // return $results = DB::select('select p.polling_name, w.ward_name FROM polling AS p INNER JOIN ward AS w ON p.ward_id=w.id INNER JOIN consituency AS c ON p.constituency_id=c.id ORDER BY polling_name;');
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
        //    return $request['allocated_area'];
       
        // $allocated_area = 'ABAQDERA PRIMARY SCHOOL';
        // $allocated_area = $name;

        // return $allocated_area;
        

           $results = DB::select("select p.polling_name,p.longitude,p.latitude,p.id, w.ward_name, c.constituency_name, b.county_name  FROM polling AS p INNER JOIN ward AS w ON p.ward_id=w.id INNER JOIN constituency AS c ON p.constituency_id=c.id INNER JOIN county AS b ON c.county_id=b.id WHERE polling_name='".$name."'");
        //    $results = DB::select("select id FROM polling WHERE polling_name='".$name."'");
        
        if($results){
           return response()->json(['message' => 'Success','data' => $results]);
           } else {
           return response()->json(['message' => 'Not data found']);
           }
       } catch (\Exception $ex) {
           Log::error($ex->getMessage());

           return response()->json(['message' => 'Sorry, something went wrong!'], 422);
       }
   }

}
