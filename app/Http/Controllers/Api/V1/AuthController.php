<?php


namespace App\Http\Controllers\Api\V1;

use App\UserCode;
use App\Models\Profile\Profile;
use App\Models\User\User;
use App\Notifications\Activated;
use App\Notifications\Activation;
use App\Notifications\PasswordReset;
use App\Notifications\PasswordResetted;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use Illuminate\Support\Facades\Log;
use Faker\Generator as Faker;
use DB;

/**
 * AuthController.
 */
class AuthController extends APIController
{
    public function accessToken()
    {
        $url = 'https://accounts.jambopay.com/auth/token';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/x-www-form-urlencoded',
            )
        );

        curl_setopt($curl, CURLOPT_POSTFIELDS,
                 http_build_query(array('grant_type' => 'client_credentials', 'client_id' => 'vEG1B8MF7T1UpwSKd37C6vBZ1UpLXY13O4EddzAb4m4=', 'client_secret' => '412d8eed-d6cb-4d0e-9ac3-68cb422c4e6dY0pUraLquF6lliMMivd6vr6qgQY5C3FWN3+4UBj77Wg=')));

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $access_token=json_decode($curl_response);
        curl_close($curl);
        return $access_token;
    }

    public function checkIfUserExists(Request $request) {
        $phone = $request->only('phone');

        $phone = str_replace(' ', '', $phone);

        $user = DB::table('users')->where('phone', $phone)->get();

        if ($user) {
            $token = $this->accessToken();
        try {

            $code = rand(1000, 9999);

            UserCode::updateOrCreate([
                'user_id' => $user[0]->id,
                'code' => $code
            ]);
   	        $message  = 'Your election monitor app OTP is '.$code;
            $phoneOTP = substr($phone['phone'], 4);
            $phoneOTP = '0'.$phoneOTP;
            $phoneOTP = str_replace(' ', '', $phoneOTP);

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://swift.jambopay.co.ke/api/public/send',
            //   CURLOPT_URL => 'https://prsp.jambopay.co.ke/api/api/org/disburseSingleSms/',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
                  "contact" : "'.$phoneOTP.'",
                  "message" : '.$code.',
                  "callback" : "https://....",
                  "sender_name" : "BADILISHA"
            }',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token->access_token.'',
                'Content-Type: application/json'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            Log::info('OTP code has been sent to', ['Phone' => $phoneOTP, 'Code' => $code]);
            return response()->json(['data' => $user, 'otp' => $code]);
        } catch (JWTException $e) {
            Log::error('Error occured while trying to send OTP code to', ['Phone' => $phone]);
            return response()->json(['message' => 'Error occured while trying to send OTP code to'.$receiverNumber]);
        }

        } else {
            Log::warning('An unregistered user tried to login!');
            return response()->json(['message' => 'User is not registered!']);
        }
    }

    public function authenticate(Request $request)
    {
        // $credentials = $request->only('email', 'password');
        // return 'kenya';
        $credentials = request(['email', 'password']);

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                Log::warning('Invalid Credentials! Please try again!');
                return response()->json(['message' => 'Invalid Credentials! Please try again.'], 422);

            }
        } catch (JWTException $e) {
            Log::error('Something went wrong while authenticating.');
            return response()->json(['message' => 'This is something wrong. Please try again!'], 500);
        }

        $user = DB::select('select * from users where id = '.auth()->user()->id);
        DB::table('users')
                ->where('id', auth()->user()->id)
                ->update(['status' => 'online']);


            Log::info('User has successfully loggedin!', ['token' => $token] );
            return response()->json(['message' => 'Success','data' => $user,'token' => $token]);
    }
        /**
     * validate sms
     *
     * @return response()
     */
    public function storeOTP(Request $request)
    {
        $phone = $request->only('phone');

        $phone = str_replace(' ', '', $phone);

        $user = DB::table('users')->where('phone', $phone)->get();

        // return $user;

        $exists = UserCode::where('user_id', $user[0]->id)
                ->where('code', $request->only('otp'))
                ->where('updated_at', '>=', now()->subMinutes(5))
                ->latest('updated_at')
                ->exists();

        if ($exists) {
            // DB::table('users')
            // ->where('id', $user->id)
            // ->update(['status' => 'activated']);
            Log::info('Valid OTP entered by', ['Phone' => $phone]);
            return response()->json(['message' => 'Success' ,'data' => $user]);
        }
        Log::error('Invalid OTP entered by', ['Phone' => $phone]);
        return response()->json(['message' => 'Error' ,'data' => 0]);

    }
    /**
     * resend otp code
     *
     * @return response()
     */
    public function resendOTP($number)
    {
        $user = DB::table('users')->where('phone', $number)->first();

        $code = rand(100000, 999999);

        UserCode::updateOrCreate([
            'user_id' => $user->id,
            'code' => $code
        ]);

        Log::info('OTP has been sent to phone number!', ['Phone' => $phone]);
        return response()->json(['message' => 'We have resent OTP on your mobile number.']);
    }


    public function getAuthUser()
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            Log::warning('User not authenticated');
            return response()->json(['authenticated' => false], 422);
        }

        $user = JWTAuth::parseToken()->authenticate();
        $profile = $user->Profile;
        $social_auth = ($user->password) ? 0 : 1;
        // Log::info('Authenticated user details found');
        return response()->json(compact('user', 'profile', 'social_auth'));
    }

    public function check()
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            // Log::warning('User not authenticated');
            return response(['authenticated' => false]);
        }
        // Log::info('User is authenticated');
        return response(['authenticated' => true]);
    }

    public function logout()
    {
        try {
            $token = JWTAuth::getToken();

            if ($token) {
                DB::table('users')
                    ->where('id', auth()->user()->id)
                    ->update(['status' => 'offline']);

                JWTAuth::invalidate($token);
            }
        } catch (JWTException $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }

        // return view('auth/game');
        Log::info('User '.auth()->user()->id.' has successfully logged out');
        return response()->json(['message' => 'You are successfully logged out!']);
    }

    public function register(Request $request, Faker $faker)
    {
        try {


        str_replace(' ', '', request('phone'));
        $validation = Validator::make($request->all(), [
            'first_name'            => 'required',
            'last_name'             => 'required',
            'phone'                 => 'required|unique:users',
            'gender'                => 'required',
            // 'allocated_area'        => 'required',
            // 'password'              => 'required|min:6',
            // 'password_confirmation' => 'required|same:password',
        ]);

        if ($validation->fails()) {
            return response()->json(['message' => $validation->messages()->first()], 422);
            // Log::error($e->getMessage());
        }

        $user = User::create([
            'email'    => $faker->unique()->safeEmail,
            'status'   => 'activated',
            'password' => bcrypt(request('password')),
        ]);

        $user->activation_token = Str::uuid()->toString();
        $user->phone = str_replace(' ', '', request('phone'));
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->role = request('role');
        $user->gender = request('gender');
        $user->allocated_area = request('allocated_area');
        $user->save();

        Log::info('A user has been registered successfully!');
        return response()->json(['message' => 'You have registered a user successfully!']);
    } catch (JWTException $e){

    }
    }
}
