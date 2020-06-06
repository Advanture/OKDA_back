<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('sanctum');
    }

    public function login(Request $request)
    {
        if($request->header('Authorization')){
            return response()->json([
                'message' => 'Вы уже авторизированны!'
            ],403);
        }

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {

            $authUser = auth()->user();

            $token = $authUser->createToken($authUser->email)->plainTextToken;

            return response()->json([
                'message' => 'Вы успешно вошли в свой аккаунт.',
                'token' => $token,
            ], 200);
        }

        return response()->json([
            'message' => 'Ошибка авторизации.'
        ], 422);
    }

    public function logout(Request $request)
    {
        if(!$request->header('Authorization'))
            return response()->json([
                'message' => 'Отсутсвует токен!'
            ]);

        $authUser = auth()->user();
        $token = hash('sha256', str_replace('Bearer ', '', $request->header('Authorization')));

        $authUser->tokens()->where('token', $token)->delete();

        return response()->json([
            'message' => 'Вы успешно вышли из своего аккаунта.'
        ], 200);
    }
}
