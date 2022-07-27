<?php

namespace App\Http\Controllers\Api\V1;

use JWTAuth;
use Validator;
use App\Result;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Models\Aspirant\Aspirant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\API\V1\APIController;

/**
 * User Controller.
 */
class UserController extends APIController
{
    /**
     * $avatar_path.
     *
     * @var string
     */
    protected $avatar_path = 'images/users/';

    /**
     * $repositery UserRepositery.
     *
     * @var object
     */
    protected $repositery;

    /**
     * @param UserRepository $repositery
     */
    public function __construct(UserRepository $repositery)
    {
        $this->repositery = $repositery;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            // return $this->repositery->getAllUsers($request);
            return $user = DB::select('select * from users');
            // return  $user = User;

        } catch (\Exception $ex) {
            // Log::error($ex->getMessage());

            return response()->json($ex->getMessage());
        }
    }

        /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $user = User::whereId($id)->first();

            if (!$user) {
                return response()->json(['message' => 'Could not find user!'], 422);
            }

            return $user;
        } catch (\Exception $ex) {
            // Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $validation = Validator::make($request->all(), [
                'first_name'    => 'required|min:2',
                'last_name'     => 'required|min:2',
            ]);

            if ($validation->fails()) {
                return response()->json(['message' => $validation->messages()->first()], 422);
            }

            $user = User::whereId($id)->first();
            $phone = str_replace(' ', '', request('phone'));
            $user->first_name = request('first_name');
            $user->last_name = request('last_name');
            $user->gender = request('gender');
            $user->phone = $phone;
            $user->role = request('role');
            $user->allocated_area = request('allocated_area');
            $user->save();

            if ($user->save()) {
                DB::commit();
                $responseArr = [
                    'message' => 'Your profile has been updated!',
                    'user'    => $user,
                ];
            } else {
                DB::rollback();
                $responseArr = [
                    'message' => 'Something went wrong!',
                ];
            }

            return response()->json($responseArr);
        } catch (\Exception $ex) {
            DB::rollback();
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
        DB::beginTransaction();

        try {
            if (env('IS_DEMO')) {
                return response()->json(['message' => 'You are not allowed to perform this action in this mode.'], 422);
            }

            $user = User::find($id);

            if (!$user) {
                return response()->json(['message' => 'Couldnot find user!'], 422);
            }

            if ($user->avatar && \File::exists($this->avatar_path.$user->avatar)) {
                \File::delete($this->avatar_path.$user->avatar);
            }

            if ($user->delete()) {

                DB::commit();
                $responseArr = [
                    'message' => 'User has been deleted successfully!',
                ];
            } else {
                DB::rollback();
                $responseArr = [
                    'message' => 'Something went wrong!',
                ];
            }

            return response()->json(['success', 'message' => $responseArr]);
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function dashboard()
    {
        try {
            $users_count = User::count();
            $aspirants_count = Aspirant::count();

            $total_results = DB::table("results")->get()->sum("votes");
            $pollings = DB::table('polling')->count();

            $results = Result::with('aspirant')->orderBy('vote_entered_at', 'DESC')->get();

            // $recent_incomplete_aspirants = Aspirant::whereStatus(0)->orderBy('due_date', 'desc')->limit(5)->get();
            // return $user = 'Kenya';
            return response()->json(compact('users_count', 'aspirants_count', 'total_results', 'pollings', 'results'));
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }
     /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function results()
    {
        try {

            $results = DB::table("results")->get();

            // $recent_incomplete_aspirants = Aspirant::whereStatus(0)->orderBy('due_date', 'desc')->limit(5)->get();
            // return $user = 'Kenya';
            return response()->json(compact('results'));
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }
     /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function CountyProgress(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $county_progress = User::find($user->id);
            $progress = $request->only('prog');
            $county_progress->county_prog = $progress['prog'];
            $county_progress->save();
            return response()->json(['message' => 'County progress updated!']);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }

    public function getCountyProgress()
    {
        $progress = User::sum('county_prog');

        return response()->json(['message' => '', 'data' => $progress], 200);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ConstituencyProgress(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $constituency_progress = User::find($user->id);
            $progress = $request->only('prog');
            $constituency_progress->const_prog = $progress['prog'];
            $constituency_progress->save();
            return response()->json(['message' => 'Constituency progress updated!']);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }

    public function getConstituencyProgress()
    {
        $progress = User::sum('const_prog');

        return response()->json(['message' => '', 'data' => $progress], 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function NationalProgress(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $national_progress = User::find($user->id);
            $progress = $request->only('prog');
            $national_progress->national_prog = $progress['prog'];
            $national_progress->save();
            return response()->json(['message' => 'National progress updated!']);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }

    public function getNationalProgress()
    {
        $progress = User::sum('national_prog');

        return response()->json(['message' => '', 'data' => $progress], 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function WardProgress(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $ward_progress = User::find($user->id);
            $progress = $request->only('prog');
            $ward_progress->ward_prog = $progress['prog'];
            $ward_progress->save();
            return response()->json(['message' => 'Ward progress updated!']);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['message' => 'Sorry, something went wrong!'], 422);
        }
    }

    public function getWardProgress()
    {
        $progress = User::sum('ward_prog');

        return response()->json(['message' => '', 'data' => $progress], 200);
    }

}
