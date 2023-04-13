<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UpdateUserRequest;
use App\Http\Resources\V1\UserResource;
use App\Mail\AuthCodeEmail;
use App\Models\AuthCode;
use App\Models\User;
use App\Models\UserCoins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function sendAuthCode(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);
        $email = $validatedData['email'];

        DB::transaction(function () use($email) {
            // create user if not exists
            $user = User::where('email', $email)->first();

            if (!$user) {
                $user = User::create([
                    'email' => $email,
                ]);

                UserCoins::create([
                    'user_id' => $user->id,
                    'amount' => 50,
                ]);
            }

            // remove existing auth code
            $authCode = AuthCode::where('email', $email)->first();
            if ($authCode) {
                $authCode->delete();
            }

            // create and send auth code
            $code = $this->generateCode(6);

            $expirationTime = now()->addMinutes(50);

            $authCode = new AuthCode;
            $authCode->email = $email;
            $authCode->code = $code;
            $authCode->expiration_time = $expirationTime;
            $authCode->save();

            Mail::to($email)->send(new AuthCodeEmail($code));
        });

        return response()->json(['message' => 'Auth code sent']);
    }

    public function resendAuthCode(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);
        $email = $validatedData['email'];

        // check user with email exists
        User::where('email', $email)->firstOrFail();

        // remove existing auth code
        $authCode = AuthCode::where('email', $email)->first();
        if ($authCode) {
            $authCode->delete();
        }

        // create and send auth code
        $code = $this->generateCode(6);

        $expirationTime = now()->addMinutes(50);

        $authCode = new AuthCode;
        $authCode->email = $email;
        $authCode->code = $code;
        $authCode->expiration_time = $expirationTime;
        $authCode->save();

        Mail::to($email)->send(new AuthCodeEmail($code));

        return response()->json(['message' => 'Auth code sent']);
    }

    public function loginCode(Request $request)
    {
        $validatedData = $request->validate([
            'code' => ['required', 'max:6'],
        ]);

        $authCode = AuthCode::where('code', $validatedData['code'])->first();

        if (!$authCode || $authCode->expiration_time < now()) {
            return response()->json(['message' => 'Code not found or expired'], 401);
        }

        $user = User::where('email', $authCode->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 401);
        }

        Auth::login($user);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => [
                'accessToken' => $token,
                'tokenType' => 'Bearer',
                'user' => new UserResource($user->loadMissing(['topicsOfDisinterest', 'coins']))
            ]
        ]);
    }

    public function me(Request $request)
    {
        return response()->json([
            'data' => new UserResource($request->user()->loadMissing(['topicsOfDisinterest', 'coins']))
        ], 200);
    }

    public function deleteLoggedUser()
    {
        $user = User::findOrFail(auth()->user()->id);;

        $user->delete();

        return response()->json([
                'message' => 'User deleted successfully.'
            ], 200);
    }

    public function updateUser(UpdateUserRequest $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        $user->update($request->except(['topicsOfDisinterest']));

        if ($request->has('topicsOfDisinterest')) {
            $user->topicsOfDisinterest()->sync($request->topicsOfDisinterest);
        }

        return response()->json([
            'data' => new UserResource($user->loadMissing(['topicsOfDisinterest', 'coins']))
        ], 200);
    }

    public function changePassword(Request $request, User $user)
    {
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
        ]);


        #Match The Old Password
        if(!Hash::check($request->oldPassword, auth()->user()->password)){
            return response()->json([
                'message' => 'The old password does not match.'
            ], 400);
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->newPassword)
        ]);

        return response()->json([
                'message' => 'Password changed successfully.'
            ], 200);
    }

    private function generateCode($keyLength) {
        $key = "";
        for ($x = 1; $x <= $keyLength; $x++) {
            // Set each digit
            $key .= random_int(0, 9);
        }
        return $key;
    }
}
