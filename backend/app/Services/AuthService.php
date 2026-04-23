<?php

namespace App\Services;

use App\Dto\Auth\RegisterDto;
use App\Http\Resources\UserRessource;
use App\Models\User;
use App\Repository\AuthRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

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
            return $user;
       });
    }

    public function authLogin($dto){

        $user = $this->authRepository->findUserByEmail($dto->email);

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
}
