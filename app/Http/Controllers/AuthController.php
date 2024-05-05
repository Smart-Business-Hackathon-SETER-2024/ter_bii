<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Client;



class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {

        $credentials = request(['telephone', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    // public function register(RegisterRequest $request)
    // {
    //     $user = new User();
    //     $user->first_name = $request->first_name;
    //     $user->last_name = $request->last_name;
    //     $user->telephone = $request->telephone;
    //     $user->password = Hash::make($request->password);
    //     $user->save();
    //     return response()->json(['Inscription effectuée avec success']);
    // }
    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->telephone = $request->telephone;
        $user->password = Hash::make($request->password);
        $user->save();

        // Générer un OTP aléatoire
        $otp = rand(100000, 999999); // OTP à 6 chiffres

        // Envoyer l'OTP via SMS
        $this->sendOTP($user->telephone, "Votre code OTP est: $otp");

        return response()->json(['Inscription effectuée avec success', 'otp' => $otp]); // Vous pouvez retirer 'otp' du JSON pour la production
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

function sendOTP($phone, $message) {
    $sid = env('TWILIO_SID');
    $token = env('TWILIO_TOKEN');
    $client = new Client($sid, $token);

    try {
        $client->messages->create(
            $phone,
            [
                'from' => env('TWILIO_FROM'),
                'body' => $message
            ]
        );
    } catch (\Exception $e) {
        return false; // Gérer l'exception ou logger l'erreur
    }

    return true;
}

}
