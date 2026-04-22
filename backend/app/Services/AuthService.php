<?php

namespace App\Services;

use App\Dto\Auth\RegisterDto;
use App\Models\User;
use App\Repository\AuthRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
}
