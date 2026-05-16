<?php

namespace App\Repository;

use App\Models\Client;
use App\Models\Driver;
use App\Models\User;
use Date;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function createUser(array $data){
        return User::create($data);
    }
    public function createClient($user,$address){
        return Client::create([
            "user_id"=> $user->id,
            "address"=> $address,
        ]);
    }
    public function createDriver($user,$vehicle_type){
        return Driver::create([
            "user_id" => $user->id,
            "vehicle_type" => $vehicle_type
        ]);
    }

    public function findUserByEmail($email){
        return User::where("email",$email)->first();
    }

    public function revokedToken($token){
        $token->revoke();

        DB::table('oauth_refresh_tokens')
            ->where("access_token_id",$token->id)
            ->update(['revoked' => true]);

    }

    public function emailVerified($user){
        User::where("id",$user->id)
        ->updated(["email_verified_at",date('Y-m-d H:i:s')]);
    }

    public function resetPasswordUser(User $user,string $password){
        $user->forceFill([
                    "password" => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
    }
}


