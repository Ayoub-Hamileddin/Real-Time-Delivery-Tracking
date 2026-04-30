<?php

namespace App\Services;

use App\Dto\Auth\LoginDto;
use App\Dto\Auth\RegisterDto;
use App\Helper\ApiResponse;
use App\Http\Resources\UserRessource;
use App\Models\User;
use App\Repository\AuthRepository;
use Backend\App\Helper\AuthHelper;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class AuthService
{
    private AuthRepository $authRepository;
    /**
     * Create a new class instance.
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }


    public function authRegister(RegisterDto $dto){

       $dto->password = Hash::make($dto->password);

       return DB::transaction(function () use ($dto){

       $user = $this->authRepository->createUser([
                "full_name" => $dto->full_name,
                "phone_number" => $dto->phone_number,
                "email" => $dto->email,
                "password" => $dto->password,
                "role" => $dto->role,
                "address" => $dto->address,
            ]);

            if ($dto->role == "CLIENT") {
                $this->authRepository->createClient($user,$dto->address);
            }
            if ($dto->role == "DRIVER") {
                $this->authRepository->createDriver($user,$dto->vehicle_type);
            }
            // send email verification
            $user->sendEmailVerificationNotification();
            return $user;
       });
    }

    public function authLogin($dto){

        $user = $this->authRepository->findUserByEmail($dto->email);
        // checking user credentials
        AuthHelper::checkUserCredentials($user,$dto);

        $response = Http::asForm()->post(config("services.passport.login_endpoints"), [
            'grant_type' => 'password',
            'client_id' => config("services.passport.client_id"),
            'client_secret' => config("services.passport.client_secret"),
            'username' => $dto->email,
            'password' => $dto->password,
            'scope' => $user["role"] == "CLIENT" ? "manage-orders" : "deliver-orders",
        ]);

         $data = $response->json();

         return [
            "access_token" => $data["access_token"],
            "refresh_token" => $data["refresh_token"],
            "expires_in" => $data["expires_in"],
            "user"   => new UserRessource($user)
         ];
    }

    public function authLogout($request){

        $user = $request->user();

        foreach ($user->tokens as $token) {
            $this->authRepository->revokedToken($token);
        }
    }

    public function verifiedEmail($request){
        $request->fulfill();
    }


    public function resendEmail($request){
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            throw new Exception("Email already verified");
        }

        $user->sendEmailVerificationNotification();

    }

    public function forgetPasswordLink($dto){
        $status = Password::sendResetLink($dto->email);

        if ($status!==Password::ResetLinkSent) {
            throw new Exception("Error in reset Link",$status);
        }
    }

    public function resetPassword($dto){
        $status = Password::reset(

            [
                'email' => $dto->email,
                'token' => $dto->token,
                'password' => $dto->password,
                'password_confirmation' => $dto->password_confirmation // Darouri khass t-koun!
            ],

            function(User $user , string $password ){
                $this->authRepository->resetPasswordUser($user,$password);
            }

        );

        if ($status!==Password::PasswordReset) {
            throw new Exception("error while reseting password");
        }
    }

}
