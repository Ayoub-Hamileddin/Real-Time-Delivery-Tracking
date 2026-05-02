<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = Role::firstOrCreate(["name" => "client"]);
        $driver = Role::firstOrCreate(["name" => "driver"]);

        Permission::firstOrCreate(["name" => "manage-orders"]);
        Permission::firstOrCreate(["name" => "deliver-orders"]);

        $client->givePermissionTo("manage-orders");
        $driver->givePermissionTo("deliver-orders");
    }
}
