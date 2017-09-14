<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AuthRequest;
use App\Http\Requests\User\RegistrationRequest;
use App\Models\User;
use App\Providers\ResponseServiceProvider;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * @param AuthRequest $request
     * @return mixed
     */
    public function authenticate(AuthRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $token = JWTAuth::attempt($credentials);

        if (!$token) {
            return response()->error(
                'Invalid credentials',
                ResponseServiceProvider::HTTP_RESPONSE_UNAUTHORIZED
            );
        }

        /**
         * @var User $user
         */
        $user = Auth::user();

        return response()->success($user)
            ->header('Access-Control-Expose-Headers', 'Authorization')
            ->header('Authorization', 'Bearer ' . $token);
    }

    /**
     * @param RegistrationRequest $request
     * @return mixed
     */
    public function register(RegistrationRequest $request)
    {
        $newUser = new User([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);
        $newUser->email = $request->email;
        $newUser->password = bcrypt($request->password);
        $newUser->save();

        $token = JWTAuth::fromUser($newUser);

        return response()->success($newUser)
            ->header('Access-Control-Expose-Headers', 'Authorization')
            ->header('Authorization', 'Bearer ' . $token);
    }

}