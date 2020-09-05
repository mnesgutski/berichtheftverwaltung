<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //TODO: @MAIki https://laracasts.com/discuss/channels/laravel/how-to-give-user-login-option-in-laravel-socialite-azure

    /**
     * Logs user in if User exists. Creates User if User doesnt exist
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        /** $validator = Validator::make($request->all(), [
         *    'username' => 'required',
         *    'password' => 'required'
         *]);
         **/
        //@TODO:MAIK Fix Validation

        // if ($validator->fails()) {
        //     $response['error_message'] = 'Username or Password incorrect. Password has to be at least 6 characters long.';
        //     return response()->json($response);
        // }

        $user = User::where('username', '=', $request->username)->first();

        $credentials = ['username' => $request->username, 'password' => $request->password];
        $response = [
            'error' => true,
            'error_message' => null,
            'data' => [
                'login' => false,
                'pw' => false,
                'username' => '',
                'registered' => false,
            ]
        ];

        if ($user !== null) {
            if (Auth::attempt($credentials)) {
                $response = [
                    'error' => false,
                    'error_message' => null,
                    'data' => [
                        'login' => true,
                        'pw' => true,
                        'username' => $user->username,
                    ]
                ];
                return response()->json($response);
            }
            $response['error'] = false;
            return response()->json($response);
        }
        return $this->createUser($request, $credentials);
    }

    /**
     * creates User
     * @param Request $request
     * @param $credentials "Username and Password"
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUser(Request $request, $credentials)
    {
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $user->save();
        Auth::attempt($credentials);

        $response['error'] = false;
        $response['error_message'] = null;
        $response['data']['login'] = true;
        $response['data']['pw'] = true;
        $response['data']['username'] = $user->username;
        $response['data']['registered'] = true;
        return response()->json($response);
    }

    public function logout()
    {
        $response = [
            'error' => false,
            'error_message' => null,
            'data' => []
        ];

        if (Auth::check()) {
            Auth::logout();
            $response['data'] = ['logout' => true];
            return redirect()->route('login');
        }
        $response['error'] = true;
        $response['error_message'] = "Something went wrong.";
        return response()->json($response);
    }

}
