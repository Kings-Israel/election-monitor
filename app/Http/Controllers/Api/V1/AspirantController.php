<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Support\Facades\Log;
use App\Models\Aspirant\Aspirant;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
/**
 *  Aspirant Controller.
 */
class AspirantController extends APIController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {

            return $aspirants = DB::select('select * from aspirants');

        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'full_name'       => 'required',
                'political_party' => 'required',
                'electoral_area' => 'required',
                'electoral_position' => 'required',
            ]);

            if ($validation->fails()) {
                return response()->json(['message' => $validation->messages()->first()], 422);
            }

        

            $user = JWTAuth::parseToken()->authenticate();
            $aspirant = new Aspirant();
            $aspirant->fill(request()->all());
            $aspirant->uuid = Str::uuid()->toString();
            // $aspirant->user_id = $user->id;
            $aspirant->save();
            Log::info('Aspirant added successfully!', ['aspirant' => $aspirant]);
            return response()->json(['message' => 'Aspirant added!', 'data' => $aspirant]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        try {
            $aspirant = Aspirant::find($id);

            if (!$aspirant) {
                return response()->json(['message' => 'Could not find aspirant!'], 422);
            }

            $aspirant->delete();
            Log::info('Aspirant deleted!', ['id' => $id]);
            return response()->json(['message' => 'Aspirant deleted!']);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $aspirant = Aspirant::whereUuid($id)->first();

            if (!$aspirant) {
                return response()->json(['message' => 'Could not find aspirant!'], 422);
            }

            Log::info('Aspirant displayed!', ['aspirant' => $aspirant]);
            return $aspirant;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $aspirant = Aspirant::whereUuid($id)->first();

            if (!$aspirant) {
                return response()->json(['message' => 'Could not find aspirant!']);
            }

            $validation = Validator::make($request->all(), [
                'full_name'       => 'required',
                'political_party' => 'required',
                'electoral_area' => 'required',
                'electoral_position' => 'required',
            ]);

            if ($validation->fails()) {
                return response()->json(['message' => $validation->messages()->first()], 422);
            }

            $aspirant->full_name = request('full_name');
            $aspirant->political_party = request('political_party');
            $aspirant->electoral_position = request('electoral_position');
            $aspirant->electoral_area = request('electoral_area');
            $aspirant->save();

            Log::info('Aspirant was updated successfully!', ['data' => $aspirant]);

            return response()->json(['message' => 'Aspirant updated!', 'data' => $aspirant]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function enterResults($electoral_area)
    {
        try {
            
            $aspirants = DB::select("select * from aspirants where electoral_area='".$electoral_area."'");
            return response()->json(['message' => 'Aspirants fetched', 'data' => $aspirants]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeResults(Request $request)
    {
        try {
            $index = $request->only('index');
            $index = $index['index'];

            $aspirant_uuid = $request->only('uuid');
            $aspirant_uuid = $aspirant_uuid ['uuid'];

            $results = $request->only('results');
            $results = $results['results'][$index];

            $user = JWTAuth::parseToken()->authenticate();
            $agent_id = $user->id;
            $agent_name = $user->first_name.' '.$user->last_name;
            $agent_polling = $user->allocated_area;

            $values = array('aspirant_uuid' => $aspirant_uuid,'agent_id' => $agent_id, 'agent_name' => $agent_name,  'polling'=> $agent_polling, 'votes' => $results);
            DB::table('results')->insert($values);

            $cummulative_results = DB::table('results')->where('aspirant_uuid',  $aspirant_uuid)->sum('votes');

            DB::update('update aspirants set results = ? where uuid = ?', [ $cummulative_results,  $aspirant_uuid]);

            

            Log::info('Aspirant results entered successfully!', ['values' => $values]);
            return response()->json(['message' => 'Result entered successfully!']);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }
       /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function voteStatus(Request $request)
    {
        try {
            
            $user = JWTAuth::parseToken()->authenticate();
            $agent_id = $user->id;

            // return $agent_id;
            // Log::info('Vote status!', ['votes' => $votes]);
            return $votes = DB::select("select aspirant_uuid, votes from results where agent_id='".$agent_id."'");
            
            
            // return response()->json(['message' => 'Result entered successfully!', 'data' => $votes]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }
}
