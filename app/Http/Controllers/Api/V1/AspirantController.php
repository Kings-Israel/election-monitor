<?php

namespace App\Http\Controllers\Api\V1;

use JWTAuth;
use App\Ward;
use Validator;
use App\Polling;
use App\Constituency;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Aspirant\Aspirant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

/**
 *  Aspirant Controller.
 */
class AspirantController extends Controller
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
        info($request->votes);
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $agent_id = $user->id;
            $agent_name = $user->first_name.' '.$user->last_name;
            $agent_polling = $user->allocated_area;

            $photo = NULL;

            foreach ($request->votes as $key => $value) {
                if (gettype($value) == 'array') {
                    if($request->hasFile('photo') && $request->photo != NULL) {
                        $photo = config('services.app.app_url').'/storage/results/photo/'.pathinfo($request->photo->store('photo', 'results'), PATHINFO_BASENAME);
                    }
                    DB::table('results')->insert([
                        'agent_id' => $agent_id,
                        'agent_name' => $agent_name,
                        'polling' => $agent_polling,
                        'aspirant_uuid' => $value['uuid'],
                        'votes' => $value['results'],
                        'photo' => $photo
                    ]);

                    $cummulative_results = DB::table('results')->where('aspirant_uuid',  $value['uuid'])->sum('votes');

                    DB::update('update aspirants set results = ? where uuid = ?', [ $cummulative_results,  $value['uuid']]);
                }
            }

            Log::info('Aspirant results entered successfully!');
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

    public function uploadPollingStations(Request $request)
    {
        $file = $request->file('file');

      try {
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $row_limit = $sheet->getHighestDataRow();
        $column_limit = $sheet->getHighestDataColumn();
        $row_range = range(2, $row_limit);
        $startcount = 2;

        $data = array();

         foreach($row_range as $row) {
            $pollingStations = Polling::all()->pluck('polling_name');
            if (!$pollingStations->contains($sheet->getCell('D' . $row)->getValue())) {
                $constituency = Constituency::firstOrCreate(
                    [
                        'constituency_name' => $sheet->getCell('A' . $row)->getValue(),

                    ],
                    [
                        'county_id' => 18,
                        'county_code' => 18
                    ]
                );
                $ward = Ward::firstOrCreate(
                    [
                        'ward_name' => $sheet->getCell('B' . $row)->getValue(),
                    ],
                    [
                        'constituency_id' => $constituency->id
                    ]
                );
                Polling::create([
                    'constituency_id' => $constituency->id,
                    'ward_id' => $ward->id,
                    'polling_name' => $sheet->getCell('D' . $row)->getValue(),
                ]);
            }

            $startcount++;
        }

        return response()->json(['message' => 'Data uploaded successfully'], 200);
      } catch (Exception $e) {
         return response()->json(['error' => 'An error occurred', 'data' => $e], 422);
      }
    }
}
